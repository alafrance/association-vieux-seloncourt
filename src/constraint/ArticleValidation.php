<?php
namespace App\src\constraint;
use App\src\constraint\Validation;
use Config\Alexis\Parameter;
class ArticleValidation extends Validation {
    private $errors = [];
    private $constraint;
    public function __construct() {
        $this->constraint = new Constraint();
    }
    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }
        return $this->errors;
    }

    private function checkField($name, $value)
    {
        if($name === 'title') {
            $error = $this->checkTitle($name, $value);
            $this->addError($name, $error);
        }
        else if ($name === 'category'){
            $error = $this->checkCategory($name, $value);
            $this->addError($name, $error);
        }
        else if ($name === 'image') {
            $error = $this->checkImage($name, $value);
            $this->addError($name, $error);
        }
        else if($name === 'content'){
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        }

    }
    private function addError($name, $error) {
        if($error) {
            $this->errors += [
                $name => $error
            ];
        }
    }
    private function checkTitle($name, $value){
        if ($this->constraint->notBlank($name, $value)){
            return $this->constraint->notBlank('titre', $value) ;
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('titre', $value, 2);
        }
        if($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('titre', $value, 255);
        }
    }
    private function checkCategory($name, $value){
        if ($this->constraint->notBlank($name, $value)){
            return $this->constraint->notBlank('catégorie', $value) ;
        }
    }
    private function checkImage($name, $value){
        if ($this->constraint->notBlankImage($name)){
            return $this->constraint->notBlankImage($name);
        }
        if ($this->constraint->sizeImage($name)){
            return $this->constraint->sizeImage($name);
        }
        if ($this->constraint->notErrorImage($name)){
            return $this->constraint->notErrorImage($name);
        }
        if ($this->constraint->extensionAutorize($name)){
            return $this->constraint->extensionAutorize($name);
        }
    }
    private function checkContent($name, $value){
        if ($this->constraint->notBlank($name, $value)){
            return $this->constraint->notBlank('titre', $value) ;
        }
        if($this->constraint->minLength($name, $value, 2)) {
            return $this->constraint->minLength('titre', $value, 2);
        }
        if($this->constraint->maxLength($name, $value, 255)) {
            return $this->constraint->maxLength('titre', $value, 255);
        }
    }
}