<?php
// truyền tham số vào function
 function saveUserInfo($username, $fullName){
	// Set session variables
     session_start();
	 $_SESSION['user']["username"] = $username;
	 $_SESSION['user']["fullName"] = $fullName;
	
 }
?>