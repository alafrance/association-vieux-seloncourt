<?php

namespace App\src\model;

class User{
    private $id;
    private $name;
    private $email;
    private $password;
    private $dateCreated;
    private $role;
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
         $this->name = $name;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
         return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getDateCreated(){
         return $this->dateCreated;
    }

    public function setDateCreated($dateCreated){
        $this->dateCreated = $dateCreated;
    }
    public function getRole(){
        return $this->role;
    }
    public function setRole($role){
        $this->role = $role;
    }
}
