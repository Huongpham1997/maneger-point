<?php


class user extends AuthController
{
    public function detail(){
        $model = $this->model('Users');
        $model->id = $_SESSION['user']['id'];
        $result = $model->getUser();
        if ($result['success']) {
            // nếu có dữ liệu trả về
            $this->view('user/detail', ['data' => $result['data']]);
        } else {
            // nếu không có dữ liệu trả về
            $this->view('home/error', ['resultMessage' => $result['message']]);
        }
    }

    public function changePass(){
        if(!empty($_POST['smChangePass'])){
            $model = $this->model('Users');
            $model->id = $_SESSION['user']['id'];
            $model->oldPass = $_POST['oldPass'];
            $model->newPass = $_POST['newPass'];
            $model->confirmPass = $_POST['confirmPass'];
            $result = $model->updatePass();
            if($result['success']){
                $user = $model->getUser();
                $this->view('user/detail',[
                    'resultMessage' => $result['message'],
                    'data' => $user['data']
                ]);
            }
            $this->view('user/change-pass',['resultMessage' => $result['message']]);
        }
        $this->view('user/change-pass');
    }
}