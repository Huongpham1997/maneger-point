<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
<form 
	action="?url=....&id=<?= $row['id'] ?>" method="post">
	<input type="hidden" name="id" value="<?= $row['id'] ?>">
	<input class="form-control" required name="point_name" type="text" placeholder="Mức điểm" value="<?= $row['point_name']?$row['point_name']:'' ?>"><br>
	<input class="form-control" required name="test_time" type="text" placeholder="Thời gian kiểm tra" value="<?= $row['test_time']?$row['test_time']:'' ?>"><br>
	<input class="btn btn-success" type="submit" name="submit_search" value="Tìm kiếm">
</form>
<br>
<a href="studentsPointAsm/addPointStudents" class="btn btn-success">Thêm điểm mới</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-success">Tìm kiếm</a>
<br>
<?php
if (!empty($data['resultMessageAdd'])) {
	echo $data['resultMessageAdd'];
} // chỗ này là đẩy ra data dc truyen tu controller
if (!empty($data['data'])) {
?>
<table class="table">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên điểm</th>
			<th>Tên học sinh</th>
			<th>Điểm</th>
			<th>Thời gian kiểm tra</th>
			<th>Số bài kiểm tra</th>
			<!-- <th>Điểm trung bình trung học kì</th> -->
		</tr>
	</thead>
	<tbody>
		<p style="color: red">
			<?php
			if (!empty($data['resultMessage'])) {
				echo $data['resultMessage'];
	        } // chỗ này là đẩy ra data dc truyen tu controller
	        ?>
	    </p>
	<?php
	if(empty($data['data'])){ 
	   	$i = 1;
	    while ($row = $data['data']->fetch_assoc()) {
	    	?>
	    		<tr>
	    			<td><?= $i++ ?></td>
	    			<td><?= $row['point_name'] ?></td>
	    			<td><?= $row['name_student'] ?></td>
	    			<td><?= $row['point'] ?></td>
	    			<td><?= $row['test_time'] ?></td>
	    			<td><?= $row['frequency'] ?></td>
	    			<td>
	    				<a href="#" onclick="updateSelected(<?= $row['id'] ?>>)"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
	    				<a href="#" onclick="deleteSelected(<?= $row['id'] ?>)"><i class="glyphicon glyphicon-trash"></i></a>
	    			</td>
	    		</tr>
	    		<?php
	    	}
		}
	?>
	</tbody>
</table>
<script>
    // function dưới đây để gọi xóa lớp
    function deleteSelected(id,name_student) {
    	if (confirm('Bạn có chắc chắn xóa điểm của học sinh ' + name_student + '?')) {
    		$.post("?url=studentsPointAsm/deletePointStudents", {
    			'id': id
    		}).done(function (data) {
    			alert(data['message']);
    			location.reload();
    		});
    	}
    }

    // function dưới đây để gọi sang update lại lớp
    function updateSelected(id) {
    	location.href="?url=studentsPointAsm/update&id="+id;
    }
</script>
</body>
</html>
<?php
	}
	else{

	}
?>
