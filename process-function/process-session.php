<?php
// truyền tham số vào function
 function saveUserInfo($username, $fullName){
	// Set session variables
	 $_SESSION['user']["username"] = $username;
	 $_SESSION['user']["fullName"] = $fullName;
	
 }
?>