<?php
// Import file import.php//
//
require_once '../app/views/home/menu.php';
?>
<a href="?url=managerSubject/addSubject" class="btn btn-success">Thêm mới môn học</a>
<br>
<?php
if (!empty($data['resultMessageAdd'])) {
    echo $data['resultMessageAdd'];
} // chỗ này là đẩy ra data dc truyen tu controller
?>
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên môn học</th>
            <th>Hành động</th>
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
    if (!empty($data['data'])) {
        // echo "<pre>";print_r($data['data']);die();
        $i = 1;
        while ($row = $data['data']->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['subject_title'] ?></td>
                <td>
                    <a href="#" onclick="updateSelected(<?= $row['id'] ?>) "> <i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['subject_title']."'" ?>)"> <i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</tbody>
</table>
<script>
    // function dưới đây để gọi xóa lớp
    function deleteSelected(id,subject_title) {
        if (confirm('Bạn có chắc chắn xóa môn học ' + subject_title + '?')) {
            $.post("?url=managerSubject/deleteSubject", {
                'id': id
            }).done(function (data) {
                alert(data['message']);
                location.reload();
            });
        }
    }

    // function dưới đây để gọi sang update lại lớp
    function updateSelected(id,class_id) {
        location.href="?url=managerSubject/update&id="+id;
    }
</script>
</body>
</html>