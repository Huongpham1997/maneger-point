<?php

class home extends Controller
{

    public function index()
    {
        if (empty($_SESSION['user'])) {
            $this->view('home/form-login');
        }
        $model = $this->model('NewsModel');
        $model->limit = !empty($_GET['limit'])?$_GET['limit']:10;
        $model->page = !empty($_GET['page'])?$_GET['page']:1;
        $rsNews = $model->findNews();
        $rsRelated = $model->findRelated();
        $this->view('home/index', [
            'data' => !empty($rsNews['data']) ? $rsNews['data'] : '',
            'dataRelated' => !empty($rsRelated['data']) ? $rsRelated['data'] : ''
        ]);
    }

    public function login()
    {
        $processLogin = $this->model('Users');
        if (!empty($_POST['submit']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
            $processLogin->user_name = $_POST['user'];
            $processLogin->password = $_POST['pass'];
            $resultLogin = $processLogin->login();
            if ($resultLogin['success']) {
                $model = $this->model('NewsModel');
                $model->limit = !empty($_GET['limit'])?$_GET['limit']:10;
                $model->page = !empty($_GET['page'])?$_GET['page']:1;
                $rsNews = $model->findNews();
                $rsRelated = $model->findRelated();
                $this->view('home/index', [
                    'resultMessage' => $resultLogin['message'],
                    'data' => !empty($rsNews['data']) ? $rsNews['data'] : '',
                    'dataRelated' => !empty($rsRelated['data']) ? $rsRelated['data'] : ''
                ]);
            }
            $this->view('home/form-login', ['resultMessage' => $resultLogin['message']]);
        }
        $this->view('home/form-login', ['resultMessage' => 'Vui lòng điền thông tin đăng nhập']);
    }

    public function logout()
    {
        $exit = $this->model('Users');
        if ($exit->processLogout()) {
            // cách đầy data ra ngoài view hiển thị resultMessage bên ngoài view sẽ nhận dc là $data['resultMessage']
            $this->view('home/form-login', ['resultMessage' => $exit->result]);
        }
    }

    public function signUp()
    {
        $processSignUp = $this->model('Users');
        $resultSignUp = $processSignUp->processSignUp();
        if ($resultSignUp['success']) {
            $this->view('home/form-login', ['resultMessage' => $resultSignUp['message']]);
        }
        $this->view('home/sign-up', ['resultMessage' => $resultSignUp['message']]);
    }
}

?>