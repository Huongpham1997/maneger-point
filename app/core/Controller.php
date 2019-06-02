<?php
class Controller
{
    function __construct()
    {
        session_start();
        if (empty($_SESSION['user'])) {
            $this->view('home/form-login');
        }
    }

    public function model($model)
    {
        // call to file model
        require_once '../app/models/' . $model . '.php';
        // return object
        return new $model;
    }

    public function view($view, $data = [])
    {
        // call to file model
        require_once '../app/views/' . $view . '.php';
    }
}