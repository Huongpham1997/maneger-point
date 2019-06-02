<?php
class Controller
{
    function __construct()
    {
        if (!empty($_SESSION['user'])) {
            // Trường hợp đã đăng nhập
            $this->view('home/login');
        } else {
            // chưa đăng nhập
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