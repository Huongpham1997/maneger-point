<?php
// khi nào anh bảo truyền tham số vào function thì ntn
 function saveUserInfo($username, $fullName){ // viết bên này ntn thì bên kia truyền đúng như thếtusername trước fullname sau
	// Set session variables
     session_start();
	 $_SESSION['user']["username"] = $username;
	 $_SESSION['user']["fullName"] = $fullName;
	
 }
?>