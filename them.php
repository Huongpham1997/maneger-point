<meta charset="utf-8" />

	<style type="text/css">
		label{
			float: left;
			width: 100px;
		}
		input{
			margin-bottom: 5px;
		}
		.error{
			color: red;
		}
	</style>
<?php

	$tenhs = $diachi = $gioitinh = $ngaysinh = $trangthai = "";
	if (isset($_POST['ok'])) {
		//kiểm tra họ tên
		if ($_POST['tenhs'] == "") {
			$errorTenhs = "Vui lòng nhập họ tên học sinh"; 
		} else {
			$tenhs = $_POST['tenhs'];
		}
		// kiểm tra địa chỉ
			if ($_POST['diachi'] == "") {
			$errorDiachi = "Vui lòng nhập địa chỉ của học sinh"; 
		} else {
			$diachi = $_POST['diachi'];
		}
		// kiểm tra giới tính
			if ($_POST['gioitinh'] == "") {
			$errorGioitinh = "Vui lòng nhập giới tính của học sinh"; 
		} else {
			$gioitinh = $_POST['gioitinh'];
		}
		// kiểm tra ngày sinh
			if ($_POST['ngaysinh'] == "") {
			$errorNgaysinh = "Vui lòng nhập ngày sinh của học sinh"; 
		} else {
			$ngaysinh = $_POST['ngaysinh'];
		}
		// kiểm tra trạng thái
		if (!isset($_POST['trangthai'])) {
			$errorTrangthai = "Vui lòng chọn trạng thái";
		}
		else {
			$trangthai = $_POST['trangthai'];
		}
		// thêm dữ liệu vào bảng
		if ($tenhs && $diachi && $gioitinh && $ngaysinh && $trangthai) {
			// kết nối csdl
			$connect = mysqli_connect("localhost","root", "") or die("Sever disconnect");
			mysqli_select_db($connect, "quanlidiem");
			$sql = "INSERT INTO hocsinh(tenhs,diachi,gioitinh,ngaysinh,trangthai) VALUES ('".$tenhs."','".$diachi."','".$gioitinh."','".$ngaysinh."','".$trangthai."')";
			mysqli_query($connect,$sql);
			echo "<h2>Thêm thành công</h2>";

		}
	}
?>
<form action="" method="post">
		<label>Họ và tên</label>
		<input type="text" name="tenhs" value="" />
		<span class='error'>
		<?php echo isset($errorTenhs) ? $errorTenhs : ""; ?>
		</span>
		<br/>
		<label>Địa chỉ</label>
		<input type="text" name="diachi" value="" />
		<span class='error'>
		<?php echo isset($errorDiachi) ? $errorDiachi : ""; ?>
		</span>
		<br/>
		<label>Giới tính</label>
		<input type="text" name="gioitinh" value="" />
		<span class='error'>
		<?php echo isset($errorGioitinh) ? $errorGioitinh : ""; ?>
		</span>
		<br/>
		<label>Ngày sinh</label>
		<input type="text" name="ngaysinh" value="" />
		<span class='error'>
		<?php echo isset($errorNgaysinh) ? $errorNgaysinh : ""; ?>
		</span>
		<br/>
		<label>Trạng thái</label>
		Mở<input type="radio" name="trangthai" value="true" />
		Đóng<input type="radio" name="trangthai" value="false" />
		<span class='error'>
		<?php echo isset($errorTrangthai) ? $errorTrangthai : ""; ?>
		</span>
		<br/>
		<label>&nbsp;</label>
		<input type="submit" name="ok" value="Thêm mới">
</form>