<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
<div class="col-md-12">
	<a href="point/addPoint" class="btn btn-success">Thêm mới điểm</a>
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
			<th>Tên điểm</th>
			<th>Mức nhân</th>
			<th>Trạng thái</th>
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
					<td><?= $row['point_name'] ?></td>
					<td><?= $row['level'] ?></td>
					<td><?= $row['statust'] ?></td>
					<td>
						<a href="#" onclick="updateSelected(<?= $row['id'] ?>)"><i class="glyphicon glyphicon-edit"></i> Sửa</a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['point_name']."'" ?>)"><i class="glyphicon glyphicon-trash"></i> Xóa</a>
					</td>
				</tr>
				<?php
			}
		}
	?>
</tbody>
</table>
</div>
<script>
    // function dưới đây để gọi xóa điểm
    function deleteSelected(id,point_name) {
        if (confirm('Bạn có chắc chắn xóa loại điểm ' + point_name + '?')) {
            $.post("?url=point/deletePoint", {
                'id': id
            }).done(function (data) {
                alert(data['message']);
                location.reload();
            });
        }
    }

    // function dưới đây để gọi sang update lại điểm
    function updateSelected(id) {
        location.href="?url=point/update&id="+id;
    }
</script>
</body>
</html>