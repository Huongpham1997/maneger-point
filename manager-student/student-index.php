<?php include('../extend/header.php'); ?>
<body>
<a href="add-class.php">Thêm lớp</a>
<table class="table">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên học sinh</th>
        <th>Địa chỉ</th>
        <th>Giới tính</th>
        <th>Ngày sinh</th>
        <th>Trạng thái tài khoản</th>
      </tr>
    </thead>
    <tbody>
    	<?php
    	include('../connect.php'); 
    	$sql = "SELECT * FROM `hocsinh`"; // Tạo bảng class có các trường dữ liệu id, class_name, total_student, year, name_teacher
		$result = $con->query($sql); // thực hiện truy vấn
		if ($result->num_rows > 0) 
			{ // có dữ liệu trả về
				$i =1;
				while($row = $result->fetch_assoc()) 
				{ 
					?>
					<tr>
				        <td><?= $i++ ?></td>
				        <td><?= $row['tenhs'] ?></td>
				        <td><?= $row['diachi'] ?></td>
				        <td><?= $row['gioitinh'] ?></td>
				        <td><?= $row['ngaysinh'] ?></td>
				        <td><?= $row['trangthai'] ?></td>
				      </tr>
					<?php 
				}	
			}
			else 
			{
				?>
				<tr> Chưa có dữ liệu </tr>
				<?php 
			}
    	?>  
    </tbody>
  </table>
</body>