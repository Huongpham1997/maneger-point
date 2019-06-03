
<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
<div class="content">
	<div class="container">
		<div class="cr-page-link">
			<a href="?url=home/index">Trang chủ</a>
			<span>/</span>
			<a href="?url=classStudent/index">Quản lý lớp</a>
			<span>/</span>
			<a href="">Tính điểm trung bình môn cho cả lớp</a>
		</div>
	</div>
	<div class="container">
		<div class="main-cm-1">
			<div class="col-md-12">
				<div class="col-md-12">
					<br>
					<form  action="?url=classStudent/averageOfClassByStudent&class_id=<?= $_GET['class_id'] ?>" method="post">
						<div class="col-md-6"> 
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
						<input class=" btn btn-success" type="submit" name="PointByClassStudent" value="Tính điểm trung bình môn" >
					</form>
				</div>
				<div class="col-md-12">
                    <h3 class="cp-name">Danh sách các loại điểm</h3>
					<style>
						table, th, td {
							border: 1px solid black;
							border-collapse: collapse;
						}
					</style>
					<div class="table-responsive">
						<table class="table">
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
					<script type="text/javascript">
						$(document).ready(function(){
							var subjectTitle = $('#subjectId option:selected').text();		
						    $('#replace_subject_title').text(subjectTitle);
						  	$("#subjectId").change(function(){
								var subjectTitle = $('#subjectId option:selected').text();
						    	$('#replace_subject_title').text(subjectTitle);
						  	});
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php require_once '../app/extend/footer.php'; ?>