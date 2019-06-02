<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?url=home/index">Trang chủ</a></li>
   <li class="breadcrumb-item"><a href="?url=classStudent/index">Quản lý lớp</a></li>
    <li class="breadcrumb-item action"><a href="#"> Học Sinh</a></li>
  </ol>
</nav>
<div class="col-md-12">
	<a href="?url=students/addStudents&class_id=<?= $data['class_id'] ?>" class="btn btn-success">Thêm mới học sinh</a>
<br>
<?php
if (!empty($data['resultMessageAdd'])) {
    echo $data['resultMessageAdd'];
} // đẩy ra data dc truyen tu controller
?>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
    </style>
	<table class="table">
	<thead>
		<tr>
			<th>Mã học sinh</th>
			<th>Tên học sinh</th>
			<th>Địa chỉ</th>
			<th>Giới tính</th>
			<th>Ngày sinh</th>
			<th>Trạng thái</th>
			<th>Phụ huynh</th>
			<th colspan="3" style="text-align:center;">Hành động</th>
		</tr>
	</thead>
	<tbody>
		<p style="color: red">
	        <?php
	        if (!empty($data['resultMessage'])) {
	            echo $data['resultMessage'];
	        } // đẩy ra data dc truyen tu controller
	        ?>
	    </p>
	<?php 
	if (!empty($data['data'])) {
        // echo "<pre>";print_r($data['data']);die();
        $i = 1;
        while ($row = $data['data']->fetch_assoc()) {
            ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $row['name_student'] ?></td>
					<td><?= $row['address'] ?></td>
					<td><?= $row['sex'] ?></td>
					<td><?= $row['birthday'] ?></td>
					<td><?= $row['status'] ?></td>
					<td><?= $row['parents'] ?></td>
					<td>
						<a href="#" onclick="updateSelected(<?= $row['id'] ?>,<?= $data['class_id'] ?>)" > <i class="glyphicon glyphicon-edit"></i> Sửa</a>
					</td>
					<td>
						<a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['name_student']."'" ?>)"><i class="glyphicon glyphicon-trash"></i> Xóa</a>
					</td>
					<td>
						<a href="?url=viewPoint/index&class_id=<?= $_GET['class_id'] ?>&student_id=<?= $row['id'] ?>" class="btn btn-success">Xem điểm</a> 
					</td>
				</tr>
				<?php
		}
	}
	?>
</tbody>
</table>
<script>
	$('.form_date').datetimepicker({
		language:  'vi',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
    // function dưới đây để gọi xóa học sinh 
    function deleteSelected(id,name_student) {
        if (confirm('Bạn có chắc chắn xóa học sinh ' + name_student + '?')) {
            $.post("?url=students/deleteStudents", {
                'id': id
            }).done(function (data) {
                alert(data['message']);
                location.reload();
            });
        }
    }

    // function dưới đây để gọi sang update lại học sinh
    function updateSelected(id,class_id) {
        location.href="?url=students/update&id="+id+"&class_id="+class_id;
    }

</script>

</div>
</body>
</html>