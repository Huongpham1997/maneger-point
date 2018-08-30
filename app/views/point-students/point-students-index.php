<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
<form action="?url=managerPoint/index&class_id=<?= $_GET['class_id'] ?>" method="post">
	<div class="row">
		<div class="col-md-3">
			<select class="form-control" name="point_id">
				<?php
				if(!empty($data['dataPoint'])){ 
					$i = 1;
					while ($row = $data['dataPoint']->fetch_assoc()) {
						?>
						<option value="<?= $row['id'] ?>">Điểm <?=$row['point_name'] ?> </option>
					<?php } 
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<select class="form-control" name="subject_id">
				<?php
				if(!empty($data['dataSubject'])){ 
					$i = 1;
					while ($row = $data['dataSubject']->fetch_assoc()) {
						?>
						<option value="<?= $row['id'] ?>">Môn <?=$row['subject_title'] ?> </option>
					<?php } 
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input2" data-link-format="yyyy/mm/dd">
				<input name="date_test" class="form-control" size="16" type="text" value="<?= $row['test_time']?$row['test_time']:''?>" readonly>
				<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			</div>
		</div>
		<div class="col-md-3">
			<input class="btn btn-success" type="submit" name="submit_search" value="Tìm kiếm">
		</div>
	</div>
</form>
<br>
<a href="?url=managerPoint/addPointStudents&class_id=<?= $_GET['class_id'] ?>" class="btn btn-success">Thêm điểm mới</a><br>
<br>
<p style="color:red">
	<?php
	if (!empty($data['resultMessageAdd'])) {
		echo $data['resultMessageAdd'].'<br>';
} // chỗ này là đẩy ra data dc truyen tu controller
if (!empty($data['data'])) {
	?>
</p>
<table class="table">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên điểm</th>
			<th>Tên môn học</th>
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
	    if(!empty($data['data'])){ 
	    	$i = 1;
	    	while ($row = $data['data']->fetch_assoc()) {
	    		?>
	    		<tr>
	    			<td><?= $i++ ?></td>
	    			<td id ="point_name_<?= $row['id'] ?>"><?= $row['point_name'] ?></td>
	    			<td id ="subject_title_<?= $row['id'] ?>"><?= $row['subject_title'] ?></td>
	    			<td id ="name_student_<?= $row['id'] ?>"><?= $row['name_student'] ?></td>
	    			<td id ="point_<?= $row['id'] ?>"><?= $row['point'] ?></td>
	    			<td id ="test_time_<?= $row['id'] ?>"><?= date('d/m/Y',$row['test_time']) ?></td>
	    			<td><?= $row['frequency'] ?></td>
	    			<td>
	    				<a href="#" onclick="updateSelectedByModal(<?= $row['id'] ?>,<?= $_GET['class_id'] ?>)"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
	    				<a href="#" onclick="deleteSelectedPointStudent(<?= $row['id'] ?>, <?= "'".$row['name_student']."'" ?>)"><i class="glyphicon glyphicon-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
	    			</td>
	    		</tr>
	    		<?php
	    	}
	    }
	    ?>
	</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Cập nhật điểm</h4>
			</div>
			<div class="modal-body" >
				<div class="row">
					<div class="col-md-3">
						<b>Họ và tên</b> <br><br>
						<span id="display_name_student"></span>
						<input type="hidden" id="id_asm">
					</div>
					<div class="col-md-3">
						<b>Loại điểm</b> <br><br>
						<span id="display_point_name"></span>
					</div>
					<div class="col-md-3">
						<b>Môn học</b> <br><br>
						<span id="display_subject_student"></span>
					</div>
					<div class="col-md-3">
						<b>Điểm</b><br><br>
						<input id="display_point_student" type="text" class="form-control" >      		
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary" onclick="updatePointModal()">Lưu</button>
			</div>
		</div>
	</div>
</div>
<?php
}else{
	echo "Không có dữ liệu";
}
?>
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
    // function dưới đây để gọi xóa lớp
    function deleteSelectedPointStudent(id,name_student) {
    	if (confirm('Bạn có chắc chắn xóa điểm của học sinh '  + name_student + '?')) {
    		$.post("?url=managerPoint/deletePointStudents", {
    			'id': id
    		}).done(function (data) {
    			alert(data['message']);
    			location.reload();
    		});
    	}
    }

    // function dưới đây để gọi sang update lại lớp
    function updateSelectedByModal(id,class_id) {
    	var nameStudent  =  $("#name_student_"+id).text();
    	var pointStudent = $("#point_"+id).text();
    	var namePoint  = $("#point_name_"+id).text();
    	var subject = $("#subject_title_"+id).text();

    	$("#display_name_student").text(nameStudent);
    	$("#display_point_student").val(pointStudent);
    	$("#display_point_name").text(namePoint);
    	$("#display_subject_student").text(subject);
    	$("#id_asm").val(id); 	
    	$("#myModal").modal('show');
    }

    function updatePointModal(){
    	var pointStudent = $("#display_point_student").val();
    	var id = $("#id_asm").val();

    	// gui len controller de xu ly thay doi diem 
    	$.post("?url=managerPoint/updatePointById",{
    		'id':id,
    		'point' : pointStudent
    	}).done(function(data) {
    		alert(data);
    		location.reload();
    	});
    }
    function averagePoint(){
    	$.post("?url=managerPoint/averagePointStudents", {
    			'id': id
    		}).done(function (data) {
    			alert(data['message']);
    			location.reload();
    		});
    }
</script>
</body>
</html>
