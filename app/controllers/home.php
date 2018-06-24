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
}