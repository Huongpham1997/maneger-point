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
        <form action="?url=teacher/update&id=<?= $row['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên" value="<?= $row['name_teacher']?$row['name_teacher']:'' ?>"><br>
            <input class="form-control" required name="position" type="text" placeholder="Vị trí" value="<?= $row['position']?$row['position']:'' ?>"><br>
            <input class="form-control" required name="class_teacher" type="text" placeholder="Chủ nhiệm lớp" value="<?= $row['class_teacher']?$row['class_teacher']:'' ?>" ><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính" value="<?= $row['sex']?$row['sex']:'' ?>" ><br>
            <input class="btn btn-success" type="submit" name="submit_teacher" value="Cập nhật giáo viên">
        </form>
    <?php }}else{ ?>
        <form action="?url=teacher/addTeacher" method="post">
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên" value=""><br>
            <input class="form-control" required name="position" type="text" placeholder="Vị trí"><br>
            <input class="form-control" required name="class_teacher" type="text" placeholder="Chủ nhiệm lớp"><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính"><br>
            <input class="btn btn-success" type="submit" name="submit_teacher" value="Thêm mới giáo viên">
        </form>
    <?php } ?>
    
</div>