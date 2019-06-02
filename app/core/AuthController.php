<?php


class AuthController extends Controller
{
    function __construct()
    {
        parent::__construct();
        if (empty($_SESSION['user'])) {
            $this->view('home/form-login');
        }
    }
}