<?php
// Import file import.php//
require_once '../app/extend/header.php';
require_once '../app/views/home/menu.php';
?>
<div class="container">
    <p style="color: red;text-align: center">
        <?php
        if (!empty($data['resultMessageAdd'])) {
            echo $data['resultMessageAdd'];
        } // chỗ này là đẩy ra data dc truyen tu controller
        ?>
    </p>
    <?php if(!empty($data['data'])){ 
        while ($row = $data['data']->fetch_assoc()) {
        ?>
        <form action="?url=classStudent/update&id=<?= $row['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="class_name" type="text" placeholder="Tên lớp" value="<?= $row['class_name']?$row['class_name']:'' ?>"><br>
            <input class="form-control" required name="total_student" type="text" placeholder="Tổng số học sinh" value="<?= $row['total_student']?$row['total_student']:'' ?>">
            <br>
            <input class="form-control" required name="year" type="text" placeholder="Niên khóa" value="<?= $row['year']?$row['year']:'' ?>" ><br>
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên chủ nhiệm" value="<?= $row['name_teacher']?$row['name_teacher']:'' ?>"><br>
            <input class="btn btn-success" type="submit" name="submit_edit_class" value="Cập nhật lớp">
        </form>
    <?php }}else{ ?>
        <form action="?url=classStudent/addClass" method="post">
            <input class="form-control" required name="class_name" type="text" placeholder="Tên lớp" value=""><br>
            <input class="form-control" required name="total_student" type="text" placeholder="Tổng số học sinh">
            <br>
            <input class="form-control" required name="year" type="text" placeholder="Niên khóa"><br>
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên chủ nhiệm"><br>
            <input class="btn btn-success" type="submit" name="submit_class" value="Thêm mới lớp">
        </form>
    <?php } ?>
</div>