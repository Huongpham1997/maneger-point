<?php
// Import file import.php//
//
require_once '../app/views/home/menu.php';
?>
<div class="col-md-12">
        <a href="?url=classStudent/addClass" class="btn btn-success">Thêm mới lớp</a>
        <br>
        <?php
        if (!empty($data['resultMessageAdd'])) {
            echo $data['resultMessageAdd'];
    } // đẩy ra data dc truyen tu controller
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>Mã lớp học</th>
                <th>Tên lớp học</th>
                <th>Số học sinh</th>
                <th>Niên khóa</th>
                <th>Thầy/Cô chủ nhiệm</th>
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
                        <td><?= $row['class_name'] ?></td>
                        <td><?= $row['total_student'] ?></td>
                        <td><?= $row['year'] ?></td>
                        <td><?= $row['name_teacher'] ?></td>
                        <td>
                            <a href="#" onclick="updateSelected(<?= $row['id'] ?>)" > <i class="glyphicon glyphicon-edit"></i> Sửa</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['class_name']."'" ?>)"> <i class="glyphicon glyphicon-trash"></i> Xóa</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="?url=students/index&class_id=<?= $row['id'] ?>"> <i class="glyphicon glyphicon-eye-open"></i> Học sinh</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="?url=managerPoint/index&class_id=<?= $row['id'] ?>"> <i class="glyphicon glyphicon-list-alt"></i> Điểm</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="?url=subjectClass/index&class_id=<?= $row['id'] ?>"> <i class="glyphicon glyphicon-book"></i> Môn</a>
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
</div>
</body>
</html>