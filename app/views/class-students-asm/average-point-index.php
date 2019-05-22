
<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
		<li class="breadcrumb-item"><a href="?url=classStudent/index">Quản lý lớp</a></li>
		<li class="breadcrumb-item action"><a href="#"> Tính điểm trung bình học kì cho lớp</a></li>
	</ol>
</nav>
<div class="col-md-12">
	<div class="col-md-6">
		<form  action="?url=classStudent/AvegareOfClassByStudent&class_id=<?= $_GET['class_id'] ?>" method="post">
			<div class="col-md-8"> 
				<select id="subjectId" class="form-control" name="subject_id">
					<?php
					if(!empty($data['dataSubject'])){ 
						$i = 1;
						while ($row = $data['dataSubject']->fetch_assoc()) {
							?>
							<option value="<?= $row['id'] ?>">Môn học <?=$row['subject_title'] ?> </option>
						<?php } 
					}
					?>
				</select>
			</div>
			<input class=" btn btn-success" type="submit" name="PointByClassStudentOfSubject" value="Tính điểm trung bình học kì" >
		</form>
	</div>
	<div class="col-md-10" >
		<br>
		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	<table class="table" align="center">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên học sinh</th>
				<th>Điểm</th>
				<th>Loại điểm</th>
				<th>Thời gian kiểm tra</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($data['data'])){
					// echo "<pre>";print_r($data['data']);die();
				$i = 1;
				while ($row = $data['data']->fetch_assoc()) {
					?>
					<tr>
						<td><?= $i++ ?></td>
						<td><?= $row['name_student'] ?></td>
						<td><?= $row['point'] ?></td>
						<td><?= $row['point_name'] ?></td>
						<td><?= date('d/m/Y',$row['test_time']) ?></td>
					</tr>
					<?php
				}
			}
			else{  
			}
			?>
		</tbody>
	</table>

</div>
<!-- <script type="text/javascript">
	$(document).ready(function(){
		var subjectTitle = $('#subjectId option:selected').text();		
	    $('#replace_subject_title').text(subjectTitle);
	  	$("#subjectId").change(function(){
			var subjectTitle = $('#subjectId option:selected').text();
	    	$('#replace_subject_title').text(subjectTitle);
	  	});
	});
	
</script> -->
</div>
</body>
</html>