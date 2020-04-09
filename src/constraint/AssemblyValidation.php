<?php
namespace App\src\constraint;
use Config\Alexis\Parameter;
class AssemblyValidation extends Validation{
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
        if($name === 'place') {
            $error = $this->checkPlace($name, $value);
            $this->addError($name, $error);
        }
        else if ($name === 'content'){
            $error = $this->checkContent($name, $value);
            $this->addError($name, $error);
        }
        else if($name === 'date'){
            $error = $this->checkDate($name, $value);
            $this->addError($name, $error);
        }
        else if($name === 'hours'){
            $error = $this->checkHours($name, $value);
            $this->addError($name, $error);
        }
        else if($name === 'minutes'){
            $error = $this->checkMinutes($name, $value);
            $this->addError($name, $error);
        }

    }

    private function addError($name, $error){
        if ($error){
            $this->errors += [
               $name => $error
            ];
        }
    }
    public function checkDate($name, $value){
        if ($this->constraint->notBlank($name, $value)){
            return $this->constraint->notBlank('Date', $value);
        }
    }
    public function checkHours($name, $value){
        if ($this->constraint->isNumber($name, $value)){
            return $this->constraint->isNumber('heure', $value);
        }
        if ($this->constraint->isHours($name, $value)){
            return $this->constraint->isHours('heure', $value);
        }

    }
    public function checkMinutes($name, $value){
        if ($this->constraint->isNumber($name, $value)){
            return $this->constraint->isNumber('minute', $value);
        }
        if ($this->constraint->isMinutes($name, $value)){
            return $this->constraint->isMinutes('minute', $value);
        }

    }

    public function checkPlace($name, $value){
        if ($this->constraint->notBlank($name, $value)){
            return $this->constraint->notBlank('Lieu', $value);
        }
        if ($this->constraint->minLength($name, $value, '2')){
            return $this->constraint->minLength('Lieu', $value, '2');
        }
        if ($this->constraint->maxLength($name, $value, '255')){
            return $this->constraint->maxLength('Lieu', $value, '255');
        }
    }
    public function checkContent($name, $value){
        if ($this->constraint->maxLength($name, $value, '255')){
            return $this->constraint->maxLength('Informations', $value, '255');
        }

    }
}