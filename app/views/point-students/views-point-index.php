
<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
<div class="content">
	<div class="container">
		<div class="cr-page-link">
			<a href="?url=home/index">Trang chủ</a>
			<span>/</span>
			<a href="?url=classStudent/index&class_id=<?= $_GET['class_id'] ?>">Quản lý lớp</a>
			<span>/</span>
			<a href="?url=students/index&class_id=<?= $_GET['class_id'] ?>">Quản lý học sinh</a>
			<span>/</span>
			<a href="#"><?= empty($data['data']) ? 'Thêm mới điểm' : 'Xem điểm của học sinh' ?></a></li>
		</div>
	</div>
	<div class="container">
		<div class="main-cm-1">
			<div class="col-md-12">
				<div class="col-md-12">
					<h3 class="cp-name">Danh sách điểm của học sinh</h3>
					<div class="col-md-12">
						<div class="col-md-6">
							<form  action="?url=viewPoint/index&class_id=<?= $_GET['class_id'] ?>&student_id=<?= $_GET['student_id'] ?> " method="post">
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
									<div class="col-md-4">
										<input class=" btn btn-success"class="form-control" type="submit" name="ViewPointByStudent" value="Xem điểm"><br>
									</div>
							</form>
						</div>
						<!-- <div class="col-md-6"> -->
							<!-- <button type="button" class="btn btn-success" onclick="avegare()">Tính điểm trung bình <span id="replace_subject_title" > -->
						<!-- 	</span></button>
						</div> -->
						<style>
					        table, th, td {
					        border: 1px solid black;
					        border-collapse: collapse;
					        }
					    </style>
					    <hr>
					    <hr>
					    <div class="table-responsive">
							<table class="table">
									<thead>
										<tr>
											<th>STT</th>
											<th>Thời gian kiểm tra</th>
											<th>Điểm</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(!empty($data['data'])){
											$i = 1;
											while ($row = $data['data']->data->fetch_assoc()) {
												?>
												<tr>
													<td><?= $i++ ?></td>
													<td><?= $row['point_name'] ?></td>
													<td><?= $row['point'] ?></td>
												</tr>
												<?php
											}
										}
										else{  
											?>
											<tr>
											<td colspan="3" >
												<p style="color: red">
													<?php
													if (!empty($data['resultMessage'])) {
														echo $data['resultMessage'];
										        } // đẩy ra data dc truyen tu controller
										        ?>
									   			</p>
									    </td>
									    </tr>
										    <?php
										}
										?>
									</tbody>
							</table>
						</div>
							<nav aria-label="Page navigation">
                        		<?= $data['data']->htmlPages ?>
                    		</nav>
					<script type="text/javascript">
						$(document).ready(function(){
							var subjectTitle = $('#subjectId option:selected').text();		
						    $('#replace_subject_title').text(subjectTitle);
						  	$("#subjectId").change(function(){
								var subjectTitle = $('#subjectId option:selected').text();
						    	$('#replace_subject_title').text(subjectTitle);
						  	});
						});
						function avegare() {
							//location.href="viewPoint/showAvegare";
							var subjectId = $('#subjectId').val();
							var classId = <?= $_GET['class_id'] ?>;
							// alert(classId);
							$.post("?url=viewPoint/showAvegare",{
					                'subjectId': subjectId ,
					                'classId': classId 
					            }).done(function (data) {
					                alert(data['message']);
					                location.reload();
					            });
						}
					</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php require_once '../app/extend/footer.php'; ?>