<?php

namespace Config\Alexis;

class Session{
    
    public function get($name){
        if (isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
    }
    public function set($name, $value){
        $_SESSION[$name] = $value;
    }
    public function show($name)
    {
        if(isset($_SESSION[$name]))
        {
            $key = $this->get($name);
            $this->remove($name);
            return $key;
        }
    }
    public function showAlert($name, $type)
    {
        if(isset($_SESSION[$name]))
        {
            $key = $this->get($name);
            $this->remove($name);
            if ($type === "success"){
                return '<p class="alert alert-success center">' . $key . '</p>';
            }else if($type === "error"){
                return '<p class="alert alert-danger center">' . $key . '</p>';
            }else if ($type == 'normal'){
                return '<p class="alert alert-info center">' . $key . '</p>';
            }
        }
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function start(){
        session_start();
    }
    public function stop()
    {
        session_destroy();
    }
}
