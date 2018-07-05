<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
<a href="classStudent/addClass" class="btn btn-success">Thêm lớp điểm</a>
<br>
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
		<?php
		if(empty($data['data'])){ ?>
			<p style="color: red">
				<?= $data['resultMessage']; // chỗ này là đẩy ra data dc truyen tu controller ?>
			</p>
			<?php 
		}else{
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
					<td><?= $row['statust'] ?></td>
					<td><?= $row['parents'] ?></td>
					<td>
						<a href="#" onclick="updateSelected(<?= $row['ID'] ?>)"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#" onclick="deleteSelected(<?= $row['ID'] ?>)"><i class="glyphicon glyphicon-trash"></i></a>
					</td>
				</tr>
				<?php
			}
		}
	?>
</tbody>
</table>
</body>
</html>