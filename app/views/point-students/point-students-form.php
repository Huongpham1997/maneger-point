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
        <form action="?url=studentsPointAsm/update&id=<?= $row['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="point_name" type="text" placeholder="Tên điểm" value="<?= $row['point_name']?$row['point_name']:'' ?>"><br>
            <input class="form-control" required name="name_student" type="text" placeholder="Tên học sinh" value="<?= $row['name_student']?$row['name_student']:'' ?>"><br>
            <input class="form-control" required name="point" type="text" placeholder="Điểm" value="<?= $row['point']?$row['point']:'' ?>" ><br>
            <input class="form-control" required name="test_time" type="text" placeholder="Thời gian kiểm tra" value="<?= $row['test_time']?$row['test_time']:'' ?>" ><br>
            <input class="form-control" required name="frequency" type="text" placeholder="Số bài kiểm tra" value="<?= $row['frequency']?$row['frequency']:'' ?>" ><br>
            <input class="btn btn-success" type="submit" name="submit_point_students" value="Cập nhật điểm cho học sinh">
        </form>
    <?php }}else{ ?>
        <form action="?url=studentsPointAsm/addPointStudents" method="post">
            <input class="form-control" required name="point_name" type="text" placeholder="Tên điểm" value=""><br>
            <input class="form-control" required name="name_student" type="text" placeholder="Tên học sinh"><br>
            <input class="form-control" required name="point" type="text" placeholder="Điểm"><br><input class="form-control" required name="test_time" type="text" placeholder="Thời gian kiểm tra"><br>
            <input class="form-control" required name="frequency" type="text" placeholder="Số bài kiểm tra"><br>
            <input class="btn btn-success" type="submit" name="submit_point_students" value="Thêm mới điểm cho học sinh">
        </form>
    <?php } ?>
</div>