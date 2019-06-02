<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?url=home/index">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="#">Quản lý giáo viên</a></li>
    </ol>
</nav>
<div class="col-md-12">
    <a href="?url=teacher/addTeacher" class="btn btn-success">Thêm mới giáo viên</a>
    <br>
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
            <th>Mã giáo viên</th>
            <th>Tên giáo viên</th>
            <th>Địa chỉ</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Lĩnh vực chuyên môn</th>
            <th>Chủ nhiệm lớp</th>
            <th colspan="3" style="text-align:center;">Hành động</th>
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
                    <td><?= $row['name_teacher'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['date_of_birth'] ?></td>
                    <td><?= $row['sex'] ?></td>
                    <td><?= $row['ability'] ?></td>
                    <td><?= $row['class_teacher'] ?></td>
                    <td>
                        <a href="#" onclick="updateSelected(<?= $row['id'] ?>)"><i class="glyphicon glyphicon-edit"></i>
                            Sửa</a>
                    </td>
                    <td>
                        <a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'" . $row['name_teacher'] . "'" ?>)"><i
                                    class="glyphicon glyphicon-trash"></i> Xóa</a>
                    </td>
                    <td>
                        <a href="?url=teacher/detailTeacher&id=<?= $row['id'] ?>>"><i
                                    class="glyphicon glyphicon-eye-open"></i> Xóa</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>

    <script>
        $('.form_date').datetimepicker({
            language: 'vi',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });

        // function dưới đây để gọi xóa giáo viên
        function deleteSelected(id, name_teacher) {
            if (confirm('Bạn có chắc chắn xóa giáo viên ' + name_teacher + '?')) {
                $.post("?url=teacher/deleteTeacher", {
                    'id': id
                }).done(function (data) {
                    alert(data['message']);
                    location.reload();
                });
            }
        }

        // function dưới đây để gọi sang update lại giáo viên
        function updateSelected(id) {
            location.href = "?url=teacher/update&id=" + id;
        }
    </script>
</div>
</body>
</html>