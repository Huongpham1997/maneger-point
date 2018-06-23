<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý điểm học sinh</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<?php include('extend/head.php'); ?>
	<?php include('connect.php'); ?>
</head>
<body>
	<!-- Dùng sesion để kiểm tra nếu đăng nhập rồi thì hiện menu nếu chưa đăng nhập chỉ hiện form đăng kí -->
	<?php 
		if(!empty($_SESSION['user'])){ // Trường hợp đã đăng nhập
			include('menu.php'); 
		}else{ // chưa đăng nhập
			include('login/form-login.php');
		}
	 ?>
</body>
</html>