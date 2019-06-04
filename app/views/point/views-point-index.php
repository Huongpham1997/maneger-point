
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
			<a href="#"><?= empty($data['data']) ? 'Thêm mới điểm' : 'Cập nhật thông tin điểm' ?></a></li>
		</div>
	</div>
<div class="col-md-12">
<?php
if (!empty($data['resultMessageProcess'])) {
    echo $data['resultMessageProcess'];
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
			<th>Tên môn</th>
			<th>Thời gian kiểm tra</th>
			<th>Điểm</th>
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
	if(empty($data['data'])){ 
		$i = 1;
        while ($row = $data['data']->fetch_assoc()) {
        	?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $row['subject_title'] ?></td>
					<td><?= $row['point_name'] ?></td>
					<td><?= $row['point'] ?></td>
					<td>
						<a href="#" onclick="averaged(<?= $row['id'] ?>)"><i class="glyphicon glyphicon-option-horizontal"></i> Tính điểm</a>
					</td>
				</tr>
				<?php
			}
		}
	?>
</tbody>
</table>
<script type="text/javascript">
	function averaged(id,class_id,student_id)
	{
    	location.href="?url=viewPonit/index&id="+id+"&class_id"+class_id+"&student_id="+student_id;
	}
</script>
</div>
</body>
</html>
<?php require_once '../app/extend/footer.php'; ?>