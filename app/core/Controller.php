<?php

class Controller
{
    function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

//        if (!empty($_SESSION['user'])) {
            // Save to logs
//            $logModel = $this->model('Logs');
//            $logModel->user_id = $_SESSION['user']['id'];
//            $logModel->ip = !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";
//            $logModel->action = $_GET['url'];
//            $logModel->description = "Người dùng có userID: ".$_SESSION['user']['id']." thực hiện request: " . json_encode($_GET['url']) . " với các params request GET: " . json_encode($_GET) . " params request POST: " . json_encode($_POST);
//            $logModel->created_date = time();
//            $logModel->addLog();
//        }
    }

    public function model($model)
    {
        try {
            // call to file model
            require_once '../app/models/' . $model . '.php';
            // return object
            return new $model;
        } catch (Exception $ex) {
            var_dump($ex);
            die();
        }
    }

    public function view($view, $data = [])
    {
        // call to file model
        require_once '../app/views/' . $view . '.php';
        die;
    }
}