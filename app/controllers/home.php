<?php

class home extends Controller
{

    public function index()
    {
        $this->view('home/index');
    }

    public function login()
    {
        $processLogin = $this->model('LoginModel');
        if (!empty($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
            $processLogin->user_name = $_POST['user'];
            $processLogin->password = $_POST['pass'];
            $resultLogin = $processLogin->login();
            if ($resultLogin['success']) {
                $this->view('home/index', ['resultMessage' => $resultLogin['message']]);
                return;
            }
            $this->view('home/form-login', ['resultMessage' => $resultLogin['message']]);
            return;
        }
        $this->view('home/form-login', ['resultMessage' => 'Vui lòng điền thông tin đăng nhập']);
        return;
    }

    public function logout()
    {
        $exit = $this->model('LoginModel');
        if ($exit->processLogout()) {
            // cách đầy data ra ngoài view hiển thị resultMessage bên ngoài view sẽ nhận dc là $data['resultMessage']
            $this->view('home/form-login', ['resultMessage' => $exit->result]);
        }
    }
    public function signUp()
    {
        $processSignUp = $this->model('LoginModel');
        $resultSignUp = $processSignUp->processSignUp();
        if ($resultSignUp['success']) {
            $this->view('home/form-login', ['resultMessage' => $resultSignUp['message']]);
            return;
        }
        $this->view('home/sign-up', ['resultMessage' => $resultSignUp['message']]);
        return;
    }
}
?>