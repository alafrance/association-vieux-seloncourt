<?php

namespace App\src\controller;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;
use Config\Alexis\Parameter;

class FrontController extends Controller{
    public function home(){
        return $this->view->render('home');
    }
    public function contact(){
        return $this->view->render('contact');
    }
    public function articles(){
        $articles = $this->articleDAO->getArticles();
        return $this->view->render('articles', [
            'articles' => $articles
        ]);
    }
    public function article($id){
        $article = $this->articleDAO->getArticle($id);
        return $this->view->render('articles', [
            'article' => $article
        ]);
    }
    public function login(Parameter $post){
        if ($post->get('submit')){
            $result  = $this->userDAO->login($post);
        if ($result && $result['isPasswordValid']){
                if ($post->get('auto')){
                    $this->cookie->set('pseudo', $post->get('pseudo'));
                    $this->cookie->set('password', $result['result']['password']);
                }
                $this->session->set('login', 'Vous êtes connecté');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['role_name']);
                $this->session->set('name', $result['result']['name']);
                $this->session->set('email', $post->get('email'));
                header('Location: index.php?route=profile');
            }
            else{
                $this->session->set('error_login', 'Le pseudo ou le mot de passe est incorrect');
               return $this->view->render('login', [
                    'post' => $post
                   ]);
            }
        }else{
            return $this->view->render('login');
        }
    }
    public function register(Parameter $post){
        if ($post->get('submit')){
            $errors = $this->validation->validate($post, 'User');
            if($this->userDAO->checkEmail($post)) {
                $errors['email'] = $this->userDAO->checkEmail($post);
            }
            if ($post->get('password') != $post->get('password2')){
                $errors['password2'] = '<p class="alert alert-danger">Les deux mots de passe ne correspondent pas</p>';
            }
            if (!$errors){
                $this->userDAO->register($post);
                $this->session->set('register', 'Votre inscription a bien été effectué');
                $this->login($post);
                header('Location: index.php?route=profile');
            }
            return $this->view->render('register', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('register');
    }
}