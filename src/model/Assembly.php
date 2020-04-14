<?php
namespace App\src\model;
class Assembly{
    private $id;
    private $place;
    private $time;
    private $content;
    private $date;
    public function getId(){
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }public function getPlace(){
        return $this->place;
    }
    public function setPlace($place) {
        $this->place = $place;
    }public function getTime(){
        return $this->time;
    }
    public function setTime($time) {
        $this->time = $time;
    }
    public function getContent(){
        return $this->content;
    }
    public function setContent($content) {
        $this->content = $content;
    }
    public function getDate(){
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
    }
}