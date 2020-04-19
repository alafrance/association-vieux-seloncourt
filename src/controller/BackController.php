<?php

namespace App\src\controller;
namespace App\src\controller;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use Config\Alexis\View;
use Config\Alexis\Parameter;


class BackController extends Controller{

    /* ------------------------ */
    /* ----- VERIF DROITS ----- */
    /* ------------------------ */

    private function checkLoggedIn(){
        if (!($this->session->get('name'))){
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
        }else{
            return true;
        }
    }
    private function checkAdmin(){
        if (!($this->session->get('role') == 'admin')){
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
        }else{
            return true;
        }
    }
    private function checkAuthor(){
        if (!($this->session->get('role') == 'author')){
            $this->session->set('not_author', 'Vous n\'avez pas le droit d\'accéder à cette page');
        }else{
            return true;
        }
    }

    /* ------------------------- */
    /* -------- Profil  -------- */
    /* ------------------------- */

    public function profile(){
        if ($this->checkLoggedIn()){
            if ($this->checkAdmin()){
                $articles = $this->articleDAO->getArticles();
                $comments = $this->commentDAO->getFlagComments();
                $categories = $this->articleDAO->getCategories();
                $users = $this->userDAO->getUsers();
                return $this->view->render('profile', [
                    'articles' => $articles,
                    'comments' => $comments,
                    'categories' => $categories,
                    'users' => $users
                ]);
            }
            if ($this->checkAuthor()){
                $articles = $this->articleDAO->getYoursArticles($this->session->get('id'));
                return $this->view->render('profile', [
                    'articles' => $articles
                ]);
            }
            return $this->view->render('profile');
        }
    }
    public function setting(){
        if ($this->checkLoggedIn()){
            return $this->view->render('settings/setting');
        }
    }
    public function logout(){
        if ($this->checkLoggedIn()){
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'À bientôt');
            header('Location: index.php');
//            $this->cookie->remove('pseudo');
//            $this->cookie->remove('password');
        }
    }
    public function updatePassword(Parameter $post){
        if ($this->checkAdmin()){
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'User');
                if ($post->get('newPassword') != $post->get('newPassword2')){
                    $errors['passwordEgal'] = '<p class="alert alert-danger center">Les deux mots de passe ne correspondent pas</p>';
                }
                if (!$this->userDAO->isPasswordValid($this->session->get('email'), $post->get('oldPassword'))){
                    $errors['passwordIsValid'] = '<p class="alert alert-danger center">L\'ancien mot de passe est faux</p>';
                }
                if (!($errors)){
                    $this->userDAO->modifyPassword($post, $this->session->get('id'));
                    $this->session->set('edit_password', 'Votre mot de passe a été modifié');
                    header('Location: index.php?route=profile');
                }
                return $this->view->render('settings/updatePassword', [
                    'errors' => $errors,
                    'post' => $post
                ]);
            }
            return $this->view->render('settings/updatePassword', [
                'post' => $post
            ]);
        }
    }
    public function updateName(Parameter $post){
        if ($this->checkAdmin()){
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'User');
                if (!($errors)){
                    $this->userDAO->modifyName($post, $this->session->get('id'));
                    $this->session->set('name', $post->get('name'));
                    $this->session->set('edit_name', 'Votre nom a été modifié');
                    header('Location: index.php?route=profile');
                }
                return $this->view->render('settings/updatePassword', [
                    'errors' => $errors,
                    'post' => $post
                ]);
            }
            return $this->view->render('settings/updateName', [
                'post' => $post
            ]);
        }
    }
    public function updateEmail(Parameter $post){
        if ($this->checkAdmin()){
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'User');
                if (!$this->userDAO->isExistEmail($post->get('email'))){
                    $errors['alreadyExist'] = '<p class="alert alert-danger center">Ce mail est déja pris</p>';
                }
                if (!($errors)){
                    $this->userDAO->modifyEmail($post, $this->session->get('id'));
                    $this->session->set('email', $post->get('email'));
                    $this->session->set('edit_email', 'Votre email a été modifié');
                    header('Location: index.php?route=profile');
                }
                return $this->view->render('settings/updatePassword', [
                    'errors' => $errors,
                    'post' => $post
                ]);
            }
            return $this->view->render('settings/updateEmail', [
                'post' => $post
            ]);
        }
    }
    public function deleteAccount(Parameter $post){
        if ($post->get('submit')){
            if ($post->get('deleteAccount') === 'yes'){
                $this->userDAO->deleteAccount($this->session->get('id'));
                $this->logout();
            }else{
                header('Location: index.php?route=profile');
            }
        }
        return $this->view->render('settings/update', [
            'param' => 'deleteAccount'
        ]);
    }
     /* ------------------------- */
    /* -------- ARTICLES  -------- */
    /* ------------------------- */
    public function addArticle(Parameter $post){
        if ($this->checkAuthor() || $this->checkAdmin()){
            $categories = $this->articleDAO->getCategories();
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'Article');
                if($this->validation->validate('image', 'Image')){
                    $errors['image'] = $this->validation->validate('image', 'Image');
                }
                if (!$errors){
                    $image_name = $this->articleDAO->nameDispo() . '.' . preg_split('#/#', $_FILES['image']['type'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[1] ;
                    move_uploaded_file($_FILES['image']['tmp_name'], 'img/articles/' . $image_name);
                    $this->articleDAO->addImage($image_name);
                    $this->articleDAO->addArticle($post, $this->session->get('id'), $this->articleDAO->lastIdImage());
                    $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                    header('Location: ../public/index.php?route=profile');
                }
                return $this->view->render('administration/addArticle', [
                    'categories' => $categories,
                    'errors' => $errors
                ], 'article');
            }
            return $this->view->render('administration/addArticle', [
                'categories' => $categories,
            ], 'article');
        }
    }
    

    public function editArticle(Parameter $post, $articleId){
        if ($this->checkLoggedIn()){
            if ($this->checkAuthor() || $this->checkAdmin()){
                if ($post->get('submit')){
                    $errors = $this->validation->validate($post, 'Article');
                    var_dump($errors);
                    if (!$errors){
                        $this->articleDAO->editArticle($post, $articleId);
                        $this->session->set('edit_article', 'L\'article a bien été mise à jour');
                        header('Location: ../public/index.php?route=profile');
                    }
                }
                $categories = $this->articleDAO->getCategories();
                $article = $this->articleDAO->getArticle($articleId);
                $categoryId = $this->articleDAO->getCategoryId($article->getCategory());
                return $this->view->render('administration/editArticle', [
                    'categories' => $categories,
                    'categoryId' => $categoryId,
                    'article' => $article,
                    'id' => $articleId
                ], 'article');
            }
        }
    }
    public function editImageArticle(Parameter $post, $articleId){
        if ($this->checkAuthor() || $this->checkAdmin()){
            $article = $this->articleDAO->getArticle($articleId);
            if ($post->get('submit')){
                $errors = $this->validation->validate('image', 'Image');
                if (!$errors){
                    $image_nameAll = $article->getImage();
                    $image_name = preg_split('#\.#', $image_nameAll, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[0] . '.' . preg_split('#/#', $_FILES['image']['type'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[1];
                    move_uploaded_file($_FILES['image']['tmp_name'], 'img/articles/' . $image_name);
                    $this->session->set('edit_image_article', 'L\'image a bien été modifié');
                    header('Location: ../public/index.php?route=profile');
                }
                return $this->view->render('administration/editImageArticle', [
                    'articleId' => $articleId,
                    'article' => $article,
                    'errors' => $errors
                ], 'article');
            }
            return $this->view->render('administration/editImageArticle', [
                'articleId' => $articleId,
                'article' => $article
            ], 'article');
        }
    }
    public function deleteArticle(Parameter $post, $idArticle){
        if ($this->checkAuthor() || $this->checkAdmin()){
            if ($post->get('submit')){
                if($post->get('deleteAccount') == 'yes'){
                    $article = $this->articleDAO->getArticle($idArticle);
                    unlink('img/articles/' . $article->getImage());
                    $this->articleDAO->deleteArticle($idArticle);
                    $this->session->set('delete_article', 'L\'article a bien été supprimé');
                }
                header('Location: index.php?route=profile');
            }
            return $this->view->render('administration/deleteArticle', ['idArticle' => $idArticle], 'article');
        }
    }
    /* ------------------------- */
    /* -------- COMMENT  -------- */
    /* ------------------------- */
    public function unflagComment($commentId){
        if ($this->checkAdmin()){
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');
            header('Location: index.php?route=profile');
        }
    }
    public function deleteComment($commentId){
        if ($this->checkAdmin()){
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('delete_article', 'Le commentaire a été supprimé');
            header('Location: index.php?route=profile');

        }
    }
    public function addComment($post, $articleId){
        if ($this->checkLoggedIn()){
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'Comment');
                if (!$errors){
                    $this->commentDAO->addComment($post, $articleId, $this->session->get('name'));
                    $this->session->set('add_comment', 'Le nouveau commentaire a bien été ajouté');
                    header('Location: ../public/index.php?route=article&id=' .  $articleId);
                }
                $article = $this->articleDAO->getArticle($articleId);
                $comments = $this->commentDAO->getCommentsFromArticle($articleId);
                return $this->view->render('article', [
                    'article' => $article,
                    'comments' => $comments,
                    'post' => $post,
                    'errors' => $errors,
                    'articleId' => $articleId
                ]);
            }
        }
    }
    /* ------------------------- */
    /* -------- EXPOSITION  -------- */
    /* ------------------------- */
    public function addExposition(Parameter $post){
        if ($this->checkAuthor() || $this->checkAdmin()){
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'Article');
                if($this->validation->validate('image', 'Image')){
                    $errors['image'] = $this->validation->validate('image', 'Image');
                }
                if (!$errors){
                    $image_name = $this->articleDAO->nameDispo() . '.' . preg_split('#/#', $_FILES['image']['type'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)[1] ;
                    move_uploaded_file($_FILES['image']['tmp_name'], 'img/articles/' . $image_name);
                    $this->articleDAO->addImage($image_name);
                    $this->articleDAO->addExposition($post, $this->session->get('id'), $this->articleDAO->lastIdImage());
                    $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                    header('Location: ../public/index.php?route=profile');
                }
                return $this->view->render('administration/addArticle', [
                    'errors' => $errors
                ], 'article');
            }
            return $this->view->render('administration/addExposition');
        }
    }
    /* ------------------------- */
    /* -------- ASSEMBLY  -------- */
    /* ------------------------- */
    public function addAssembly(Parameter $post){
        if ($this->checkAuthor() || $this->checkAdmin()){
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'Assembly');
                if (!$errors){
                    $time = $post->get('hours') . ':' . $post->get('minutes');
                    $this->articleDAO->addAssembly($post, $time);
                    $this->session->set('add_assembly', 'L\'assemblée générale a bien été modifié');
                    header('Location: index.php?route=profile');
                }
                return $this->view->render('administration/addAssembly', [
                    'post' => $post,
                    'errors' => $errors
                ], 'article');
            }
            return $this->view->render('administration/addAssembly', [], 'article');
        }
    }
    public function deleteAssembly(Parameter $post){
        if ($this->checkAuthor() || $this->checkAdmin()){
            if ($post->get('submit')){
                if($post->get('deleteAccount') == 'yes'){
                    $this->articleDAO->deleteAssembly();
                    $this->session->set('delete_assembly', 'Les informations de l\'Assemblée Générale ont bien été supprimés');
                }
                header('Location: index.php?route=profile');
            }
            return $this->view->render('administration/deleteAssembly');
        }
    }
    /* ------------------------- */
    /* -------- DROITS  -------- */
    /* ------------------------- */
    public function changeRight(Parameter $post, $userId){
        if ($this->checkAdmin()){
            if ($post->get('submit') && $post->get('right')){
                $this->userDAO->changeRight($post->get('right'), $userId);
                $this->session->set('change_right', 'Les droits ont été modifiés.');
                header('Location: index.php?route=profile');
            }
            $user = $this->userDAO->getUser($userId);
            return $this->view->render('administration/changeRight', [
                'user' => $user,
                'userId' => $userId
            ]);
        }
    }
    /* ------------------------- */
    /* -------- CATEGORY  -------- */
    /* ------------------------- */
    public function addCategory(Parameter $post){
        if ($post->get('submit') && $post->get('category')){
            $this->articleDAO->addCategory($post);
            $this->session->set('add_category', 'La catégorie' . $post->get('category') . 'a été ajouté');
        }
        header('Location: index.php?route=profile');
    }

    
}