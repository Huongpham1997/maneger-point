<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<br>
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
            <th>Mã lớp học</th>
            <div>
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
            <th>Tên học sinh</th>
            <th>Ngày sinh</th>
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
                <td><?= $row['class_name'] ?></td>
                <td><?= $row['total_student'] ?></td>
                <td><?= $row['year'] ?></td>
                <td><?= $row['name_teacher'] ?></td>
                <td>
                    <a href="#" onclick="updateSelected(<?= $row['id'] ?>)"><i class="glyphicon glyphicon-edit"></i> Sửa</a>
                </td>
                <td>
                    <a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['class_name']."'" ?>)"><i class="glyphicon glyphicon-trash"></i> Xóa</a>
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
    // function dưới đây để gọi xóa lớp
    function deleteSelected(id,class_name) {
        if (confirm('Bạn có chắc chắn xóa lớp ' + class_name + '?')) {
            $.post("?url=classStudent/deleteClass", {
                'id': id
            }).done(function (data) {
                alert(data['message']);
                location.reload();
            });
        }
    }

    // function dưới đây để gọi sang update lại lớp
    function updateSelected(id) {
        location.href="?url=classStudent/update&id="+id;
    }
</script>
</body>
</html>