<?php 
	$id = $_GET['id'];
	$connect = mysqli_connect("localhost","root", "") or die("sever disconnect");
	mysqli_select_db($connect, "quanlidiem");

	$sql = "DELETE FROM hocsinh WHERE id='".$id."'";
	mysqli_query($connect,$sql);
	header("location:danhsach.php");
 ?>