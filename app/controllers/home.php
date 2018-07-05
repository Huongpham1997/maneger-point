<?php

class home extends Controller
{

    public function index()
    {
        if (!empty($_SESSION['user'])) { // Trường hợp đã đăng nhập
            $this->view('home/menu');
        } else { // chưa đăng nhập
            $this->view('home/form-login');
        }
    }

    public function login()
    {
        $processLogin = $this->model('LoginModel');
        if (!empty($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
            $processLogin->user_name = $_POST['user'];
            $processLogin->password = $_POST['pass'];
            $resultLogin = $processLogin->login();
            if ($resultLogin['success']) {
                $this->view('home/menu', ['resultMessage' => $resultLogin['message']]);
            } else {
                $this->view('home/form-login', ['resultMessage' => $resultLogin['message']]);
            }
        } else {
            $this->view('home/form-login', ['resultMessage' => 'Vui lòng điền thông tin đăng nhập']);
        }

    }

    public function logout()
    {
        $exit = $this->model('LoginModel');
        if ($exit->processLogout()) {
            // cách đầy data ra ngoài view hiển thị resultMessage bên ngoài view sẽ nhận dc là $data['resultMessage']
            $this->view('home/form-login', ['resultMessage' => $exit->result]);
        }
    }
}