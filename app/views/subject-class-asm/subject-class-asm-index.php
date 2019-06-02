<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?url=home/index">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="?url=classStudent/index">Quản lý lớp</a></li>
    <li class="breadcrumb-item action"><a href="#">Quản lý môn học</a></li>
  </ol>
</nav>
<div class="col-md-12">
    <a href="?url=subjectClass/addSubjectClass&class_id=<?= $data['class_id'] ?>" class="btn btn-success">Thêm mới môn học</a>
<br>
<?php
if (!empty($data['resultMessageAdd'])) {
    echo $data['resultMessageAdd'];
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
            <th>Mã môn học</th>
            <th>Tên môn học</th>
            <th>Tên giáo viên</th>
            <th colspan="2" style="text-align:center;">Hành động</th>
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
                    <td><?= $row['subject_title'] ?></td>
                    <td><?= $row['name_teacher'] ?></td>
                    <td>
                        <a href="#" onclick="updateSelected(<?= $row['id'] ?>,<?= $_GET['class_id'] ?>)" > <i class="glyphicon glyphicon-edit"></i> Sửa</a>
                    </td>
                    <td>
                        <a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['subject_title']."'" ?>)"> <i class="glyphicon glyphicon-trash"></i> Xóa</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<script>
    // function dưới đây để gọi xóa môn học 
    function deleteSelected(id,subject_title) {
        if (confirm('Bạn có chắc chắn xóa môn học ' + subject_title + '?')) {
            $.post("?url=subjectClass/delete", {
                'id': id
            }).done(function (data) {
                alert(data['message']);
                location.reload();
            });
        }
    }

    // function dưới đây để gọi sang update lại môn học
    function updateSelected(id,class_id) {
        location.href="?url=subjectClass/update&id="+id+"&class_id="+class_id;
    }
</script>
</div>
</body>
</html>