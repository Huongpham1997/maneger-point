<?php include('../extend/header.php'); ?>
<script>
    // function dưới đây để gọi xóa lớp
    function deleteSelected(id) {
        if (confirm('Bạn có chắc chắn xóa?')) {
            $.post("delete.php", {
                'id': id
            }).done(function (data) {
                alert(data);
                location.reload();
            });
        }
    }

    // function dưới đây để gọi sang update lại lớp
    function updateSelected(id) {
        location.href="update-class.php?id="+id;
    }
</script>
<body>
<?php include('../menu.php') ?>
<br>
<a href="add-class.php" class="btn btn-success">Thêm lớp mới</a>
<br>
<table class="table">
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên lớp</th>
        <th>Số học sinh</th>
        <th>Niên khóa</th>
        <th>Thầy/Cô chủ nhiệm</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php
    include('../connect.php');
    $sql = "SELECT * FROM `class`"; // Tạo bảng class có các trường dữ liệu id, class_name, total_student, year, name_teacher
    $result = $con->query($sql); // thực hiện truy vấn
    if ($result->num_rows > 0) { // có dữ liệu trả về
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['class_name'] ?></td>
                <td><?= $row['total_student'] ?></td>
                <td><?= $row['year'] ?></td>
                <td><?= $row['name_teacher'] ?></td>
                <td>
                    <a href="#" onclick="updateSelected(<?= $row['ID'] ?>)"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" onclick="deleteSelected(<?= $row['ID'] ?>)"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td class="text-center" colspan="5" style="color: red">Chưa có dữ liệu</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>