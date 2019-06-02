<?php

//
class Users extends Controller
{
    public $id;
    public $user_name;
    public $password;
    public $fullname;
    public $name;
    public $email;
    public $user;
    public $pass;
    public $add;
    public $result;
    public $newPass;
    public $oldPass;
    public $confirmPass;

    public function saveUserInfo($id, $username, $fullName)
    {
        // Set session variableslogin
        $_SESSION['user']["id"] = $id;
        $_SESSION['user']["username"] = $username;
        $_SESSION['user']["fullName"] = $fullName;
    }

    public function login()
    {
        // chuyển tên đăng nhập thành chữ thường
        $this->user_name = strtolower($this->user_name);
        if ($this->user_name == '') {
            return $this->result = " Bạn chưa nhập tài khoản";
        }
        if ($this->password == '') {
            return $this->result = "Bạn chưa nhập mật khẩu";
        }

        $this->password = md5($this->password);
        $result = $this->getModelUser();

        if (!$result) {
            $message = $this->result = "Tài khoản hoặc mật khẩu bị sai";
            return ['success' => false, 'message' => $message];
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->saveUserInfo($row['id'], $row['username'], $row['fullName']);
            }
            $message = $this->result = "Đăng nhập thành công";
            return ['success' => true, 'message' => $message];
        } else {
            $message = $this->result = "Tài khoản hoặc mật khẩu bị sai";
            return ['success' => false, 'message' => $message];
        }
    }

    public function processLogout()
    {
        unset($_SESSION['user']);
        session_destroy();
        $this->result = "Đăng xuất thành công ";
        return true;
    }

    public function processSignUp()
    {
        $this->user = strtolower($this->user);
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];
        $sql = "SELECT * FROM `user` WHERE `username` = '$user'";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => false, 'message' => 'Tài khoản đã tồn tại !'];
        } else {
            $sql1 = "INSERT INTO `user` (`username`, `password`, `fullName`) VALUES ('$user', '$pass','$name')";
            $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
            $result = $conModel->getConnect($sql1);
            if ($result === true) {
                return ['success' => true, 'message' => 'Đăng kí thành công! Vui lòng đăng nhập để tiếp tục'];
                $this->saveUserInfo($row['id'], $row['username'], $row['fullName']);
            } else {
                return ['success' => false, 'message' => 'Tài khoản đã tồn tại'];
            }
        }
    }

    public function getUser()
    {
        $sql = "SELECT * FROM `user` WHERE `id` = " . $this->id;
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            // trả kết quả cho controller
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Chưa có dữ liệu"];
        }
    }

    public function updatePass()
    {
        // validate
        if ($this->oldPass == '') {
            return ['success' => false, 'message' => 'Bạn chưa nhập mật khẩu cũ'];
        }
        if ($this->newPass == '') {
            return ['success' => false, 'message' => 'Bạn chưa nhập mật khẩu mới'];
        }
        if ($this->confirmPass == '') {
            return ['success' => false, 'message' => 'Bạn chưa xác nhận mật khẩu'];
        }
        if ($this->newPass !== $this->confirmPass) {
            return ['success' => false, 'message' => 'Xác nhận mật khẩu không đúng'];
        }

        $this->password = md5($this->oldPass);
        $this->newPass = md5($this->newPass);

        // validate oldPass
        $user = $this->getModelUser(true);
        if(!$user){
            return ['success' => false, 'message' => 'Mật khẩu cũ không đúng vui lòng kiểm tra lại'];
        }

        // update new pass
        $sql1 = "UPDATE `user` SET `password` = '{$this->newPass}' where `id` = " . $this->id;
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql1);
        if ($result === true) {
            return ['success' => true, 'message' => 'Đổi mật khẩu thành công'];
        } else {
            return ['success' => false, 'message' => 'Tài khoản đã tồn tại'];
        }
    }

    public function getModelUser($findByIdAndPass = false)
    {
        if(!$findByIdAndPass){
            $sql = "SELECT * FROM `user` WHERE `username`='{$this->user_name}' and `password`='{$this->password}'";
        }else{
            $sql = "SELECT * FROM `user` WHERE `id`='{$this->id}' and `password`='{$this->password}'";
        }
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql);

        if ($result) {
            return $result;
        }
        return null;
    }
}