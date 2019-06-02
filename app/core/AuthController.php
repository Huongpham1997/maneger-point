<?php


class AuthController extends Controller
{
    const ROLE_SUPPER_ADMIN = 1;
    const ROLE_TEACHER = 2;

    function __construct()
    {
        parent::__construct();
        if (empty($_SESSION['user'])) {
            $this->view('home/form-login');
        }

        // role
    }
}