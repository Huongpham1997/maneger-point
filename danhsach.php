<meta charset="utf-8" />

<?php
//connect database
$connect = mysqli_connect("localhost","root", "") or die("sever disconnect");
mysqli_select_db($connect, "quanlidiem");

$sql = "SELECT * FROM hocsinh";

$query = mysqli_query($connect,$sql);

$data = array();

while($row = mysqli_fetch_assoc($query)) {
	$data[] = $row;
}
echo "<table border='1' width='1300'>";
echo "<tr>";
echo "<td> Họ tên</td>";
echo "<td> Địa chỉ</td>";
echo "<td> Giới tính</td>";
echo "<td> Ngày sinh</td>";
echo "<td> Trạng thái</td>";
echo "<td> Sửa</td>";
echo "<td> Xóa</td>";
echo "<tr>";
foreach ($data as $value) {
	echo "<tr>";
	echo "<td>".$value['tenhs']."</td>";
	echo "<td>".$value['diachi']."</td>";
	echo "<td>".$value['gioitinh']."</td>";
	echo "<td>".$value['ngaysinh']."</td>";
	if ($value['trangthai'] == true) {
		echo "<td> Tài khoản mở</td>";
	}
	else {
		echo "<td> Tài khoản bị khóa khóa</td>";
	}

	echo "<td><a href='sua.php?id=".$value['ID']."'>Sửa</a></td>";
	echo "<td><a href='xoa.php?id=".$value['ID']."'>Xóa</a></td>";
	echo "<tr>";
}
echo "</table>";
?>
