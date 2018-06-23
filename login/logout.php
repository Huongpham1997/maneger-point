<?php 
    session_start();
	unset($_SESSION['user']); 
 	session_destroy(); 
 	echo "<script>window.location.href ='../index.php';
			alert('Đăng xuất thành công.');</script>";

 ?>