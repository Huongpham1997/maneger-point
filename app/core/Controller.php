<?php
class Controller
{
    function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
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
        die;
    }
}