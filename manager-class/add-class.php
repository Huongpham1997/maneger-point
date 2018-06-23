<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 6/14/2018
 * Time: 1:57 PM
 */
?>
<?php include('../extend/header.php'); ?>
<body>
<?php include('../menu.php') ?>
<div class="container">
    <form action="process-class.php" method="post">
        <input class="form-control" required name="class_name" type="text" placeholder="Tên lớp"><br>
        <input class="form-control" required name="total_student" type="text" placeholder="Tổng số học sinh">
        <br>
        <input class="form-control" required name="year" type="text" placeholder="Niên khóa"><br>
        <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên chủ nhiệm"><br>
        <input class="btn btn-success" type="submit" name="submit_class" value="Thêm mới lớp">
    </form>
</div>
</body>