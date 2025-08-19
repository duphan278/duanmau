<?php

class HomeController
{
    public $courses;
    

    public function index() 
    {
        require_once PATH_VIEW . 'main.php';
    }
}