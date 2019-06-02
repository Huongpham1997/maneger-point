<?php
//
class LoginModel extends Controller
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

    public function saveUserInfo($username, $fullName)
    { 
        // Set session variables
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
//        $this->password = md5($this->password);
        $sql = "SELECT * FROM `login` WHERE `user`='{$this->user_name}' and `password`='{$this->password}'";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);

        if (!$result) {
            $message = $this->result = "Tài khoản hoặc mật khẩu bị sai";
            return ['success' => false, 'message' => $message];
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->saveUserInfo($row['user'], $row['fullName']);
            }
            $message =  $this->result = "Đăng nhập thành công";
            return ['success' => true, 'message' => $message];
        } else {
            $message =  $this->result = "Tài khoản hoặc mật khẩu bị sai";
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
        $this->user= strtolower($this->user);
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];
        $sql = "SELECT * FROM `login` WHERE `user` = '$user'";
        $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => false, 'message' => 'Tài khoản đã tồn tại !'];
        }
        else{
            $sql1 = "INSERT INTO `login` (`user`, `password`, `fullName`) VALUES ('$user', '$pass','$name')";
            $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
            $result = $conModel->getConnect($sql1);
            if ($result === true) {
                return ['success' => true, 'message' => 'Đăng kí thành công! Vui lòng đăng nhập để tiếp tục'];
                $this->saveUserInfo($row['user'], $row['fullName']);
            } else {
                return ['success' => false, 'message' => 'Tài khoản đã tồn tại'];
            }
        }
    }
}