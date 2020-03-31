<?php
namespace Config\Alexis;

use Exception;
use App\src\controller\FrontController;
use App\src\controller\ErrorController;
use App\src\controller\BackController;

class Router{
    private $frontController;
    private $backController;
    private $errorController;
    private $request;

    public function __construct() {
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
        $this->request = new Request();
    }
    public function run(){
        $route = $this->request->getGet()->get('route');
        try{
            if ($route != NULL){
                switch($route){
                    case 'contact':
                        $this->frontController->contact();
                        break;
                    case 'login':
                        $this->frontController->login($this->request->getPost());
                        break;
                    case 'register':
                        $this->frontController->register($this->request->getPost());
                        break;
                    case 'profile':
                        $this->backController->profile();
                        break;
                    case 'setting':
                        $this->backController->setting();
                        break;
                    case 'home':
                        $this->frontController->home();
                        break;
                    default:
                        $this->errorController->errorNotFound();
                        break;
                }
            }else{
                $this->frontController->home();
            }
        }catch(Exception $e){
            $this->errorController->errorServer();
        }
    }
}
