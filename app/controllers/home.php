<?php
class home extends Controller
{

    public function index()
    {
      if(!empty($_SESSION['user'])){ // Trường hợp đã đăng nhập
            $this->view('home/menu');
        }else{ // chưa đăng nhập
            $this->view('home/form-login');
        }
    }

    public function login(){
    	$processLogin = $this->model('LoginModel');
    	if (isset($_POST['submit'])) {
		    $processLogin->user_name = $_POST['user'];
		    $processLogin->password  = $_POST['pass'];
    		if($processLogin->login()){
    			$this->view('home/menu');
    		}else{
    			$this->view('home/form-login');
    		}
		}else{
			$this->view('home/form-login');
		}

    }

    public function logout(){
    	die('aaaa');
    	$exit = $this->model('LoginModel');
    	if($exit->processLogout())
    	{
    		$this->view('home/form-login',[$resultMessage => $this->result]);
    	}
	}
}