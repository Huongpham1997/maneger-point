<?php
class PointModel extends Controller {
	public $id;
	public $user_name;
	public $password;
	public $fullname;
	public $result;
	public function saveUserInfo($username, $fullName){ // viết bên này ntn thì bên kia truyền đúng như thếtusername trước fullname sau
	// Set session variables
		
		$_SESSION['user']["username"] = $username;
		$_SESSION['user']["fullName"] = $fullName;
	}

	public function login(){
    	// chuyen ten dang nhap thanh chu thuong
		$this->user_name = strtolower($this->user_name);
		if($this->user_name == '' ){
			return $this->result="chua nhap tai khoan";
		}
		if($this->password == ''){
			return $this->result = "chua nhap mat khau";
		}
		$this->password = md5($this->password);
		$sql = "SELECT * FROM `login` WHERE `user`='".$this->user_name."' and `password`='".$this->password;
		$result = $con->query(sql);
		if ($result->num_rows > 0){
			$this->saveUserInfo($row['user'], $row['fullName']);
			return $this->result = "dang nhap thanh cong";
		}
		else{
			return $this->result = "Tài khoản hoặc mật khẩu bị sai ";
		}
	}
	public function processLogout(){
		unset($_SESSION['user']); 
	 	session_destroy();
	 	$this->result = "Đăng xuất thành công ";
	 	return true; 
	}
}