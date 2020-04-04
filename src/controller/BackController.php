<?php

namespace App\src\controller;
namespace App\src\controller;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;
use Config\Alexis\Parameter;


class BackController extends Controller{
    private function checkLoggedIn(){
        if (!($this->session->get('name'))){
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
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
    public function profile(){
        if ($this->checkLoggedIn()){
            if ($this->checkAdmin()){
                $articles = $this->articleDAO->getArticles();
                $comments = $this->commentDAO->getFlagComments();
                $users = $this->userDAO->getUsers();
                return $this->view->render('profile', [
                    'articles' => $articles,
                    'comments' => $comments,
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
            header('Location: ../public/index.php');
//            $this->cookie->remove('pseudo');
//            $this->cookie->remove('password');
        }
    }
    public function modifyParameter(Parameter $post, $param){
        if ($this->checkLoggedIn()){
            //Formulaire envoyé
            if ($post->get('submit')){
                // Gestion erreur
                $errors = $this->validation->validate($post, 'User');

                // Si envoie de mot de passe
                if (!($post->get('newPassword') && $post->get('newPassword2') && $post->get('oldPassword'))){
                    // Erreur possible mot de passe confirmation
                    if ($post->get('newPassword') != $post->get('newPassword2')){
                        $errors['passwordEgal'] = '<p class="alert alert-danger center">Les deux mots de passe ne correspondent pas</p>';
                    }
                    // Erreur Ancien mot de passe
                    if (!$this->userDAO->isPasswordValid($this->session->get('email'), $post->get('oldPassword'))){
                        $errors['passwordIsValid'] = '<p class="alert alert-danger center">L\'ancien mot de passe est faux</p>';
                    }
                }

                if (!($post->get('email'))){
                    // Erreur Email déja existant
                    if (!$this->userDAO->isExistEmail($post->get('email'))){
                        $errors['alreadyExist'] = '<p class="alert alert-danger center">Ce mail est déja pris</p>';
                    }
                }

                // Aucune erreur
                if (!$errors){
                    switch($param){
                        case 'name':
                            $this->userDAO->modifyName($post, $this->session->get('id'));
                            $this->session->set('name', $post->get('name'));
                            break;
                        case 'password':
                            $this->userDAO->modifyPassword($post, $this->session->get('id'));
                            break;
                        case 'email':
                            $this->userDAO->modifyEmail($post, $this->session->get('id'));
                            $this->session->set('email', $post->get('email'));
                            break;
                    }
                    $this->session->set('modify', 'Votre modification a bien été enregistré');
                    header('Location: ../public/index.php?route=profile');
                }
                return $this->view->render('settings/update', [
                    'errors' => $errors,
                    'post' => $post,
                    'param' => $param
                ]);
            }
            // Affichage de page classique
            return $this->view->render('settings/update', [
                'param' => $param
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
    public function addArticle(Parameter $post){
        if ($this->checkAuthor()){
            $categories = $this->articleDAO->getCategories();
            if ($post->get('submit')){
                $errors = $this->validation->validate($post, 'Article');
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
    public function editArticle(Parameter $post){
        if ($this->checkAdmin() || $this->checkAuthor()){
            if ($post->get('submit')){

            }
            $categories = $this->articleDAO->getCategories();
            return $this->view->render('administration/editArticle', [
                'categories' => $categories
            ], 'article');
        }
    }
    public function deleteArticle(Parameter $post, $idArticle){
        if ($post->get('submit')){
            if($post->get('deleteAccount') == 'yes'){
                $this->articleDAO->deleteArticle($idArticle);
                $this->session->set('delete_article', 'L\'article a bien été supprimé');
            }
            header('Location: index.php?route=profile');
        }
        if ($this->checkAuthor()){
            return $this->view->render('administration/deleteArticle', [], 'article');
        }
    }
    public function unflagComment($id){
        if ($this->checkAdmin()){
            return 0;
        }
    }
    public function deleteComment($id){
        return 0;

    }
    public function upload_image($name){

    }
}