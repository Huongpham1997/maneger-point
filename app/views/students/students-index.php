<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<a href="?url=students/addStudents&class_id=<?= $data['class_id'] ?>" class="btn btn-success">Thêm mới học sinh</a>
<br>
<?php
if (!empty($data['resultMessageAdd'])) {
    echo $data['resultMessageAdd'];
} // đẩy ra data dc truyen tu controller
?>
<table class="table">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên học sinh</th>
			<th>Địa chỉ</th>
			<th>Giới tính</th>
			<th>Ngày sinh</th>
			<th>Trạng thái</th>
			<th>Phụ huynh</th>
			<th>Hành động</th>
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
						<a href="#" onclick="updateSelected(<?= $row['id'] ?>,<?= $data['class_id'] ?>)" > <i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['name_student']."'" ?>)"><i class="glyphicon glyphicon-trash"></i></a>
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
</body>
</html>