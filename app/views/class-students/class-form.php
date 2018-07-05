<?php
// Import file import.php
require_once '../app/extend/header.php';
?>
<div class="container">
    <p style="color: red;text-align: center">
        <?php
        if (!empty($data['resultMessageAdd'])) {
            echo $data['resultMessageAdd'];
        } // chỗ này là đẩy ra data dc truyen tu controller
        ?>
    </p>
    <form action="?url=classStudent/addClass" method="post">
        <input class="form-control" required name="class_name" type="text" placeholder="Tên lớp"><br>
        <input class="form-control" required name="total_student" type="text" placeholder="Tổng số học sinh">
        <br>
        <input class="form-control" required name="year" type="text" placeholder="Niên khóa"><br>
        <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên chủ nhiệm"><br>
        <input class="btn btn-success" type="submit" name="submit_class" value="Thêm mới lớp">
    </form>
</div>