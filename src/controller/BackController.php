<?php

namespace App\src\controller;
namespace App\src\controller;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;
use Config\Alexis\Parameter;


class BackController extends Controller{
    private function checkLoggedIn(){
        if (!($this->session->get('pseudo'))){
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        }else{
            return true;
        }
    }
    private function checkAdmin(){
        $this->checkLoggedIn();
        if (!($this->session->get('role') == 'admin')){
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        }else{
            return true;
        }
    }
    public function profile(){
        if ($this->checkLoggedIn()){
            return $this->view->render('profile');
        }
    }
    public function setting(){
        if ($this->checkLoggedIn()){
            return $this->view->render('settings/setting');
        }
    }
}