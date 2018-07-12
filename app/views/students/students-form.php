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
        <form action="?url=students/update&id=<?= $row['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="name_student" type="text" placeholder="Tên học sinh" value="<?= $row['name_student']?$row['name_student']:'' ?>"><br>
            <input class="form-control" required name="address" type="text" placeholder="Địa chỉ" value="<?= $row['address']?$row['address']:'' ?>"><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính" value="<?= $row['sex']?$row['sex']:'' ?>" ><br>
            <input class="form-control" required name="birthday" type="text" placeholder="Ngày - tháng - năm sinh" value="<?= $row['birthday']?$row['birthday']:'' ?>"><br>
            <input class="form-control" required name="status" type="text" placeholder="Trạng thái tài khoản" value="<?= $row['status']?$row['status']:'' ?>"><br>
            <input class="form-control" required name="parents" type="text" placeholder="Tên phụ huynh" value="<?= $row['parents']?$row['parents']:'' ?>"><br>
            <input class="btn btn-success" type="submit" name="submit_students" value="Cập nhật học sinh">
        </form>
    <?php }}else{ ?>
        <form action="?url=students/addStudents" method="post">
            <input class="form-control" required name="name_student" type="text" placeholder="Tên học sinh" value=""><br>
            <input class="form-control" required name="address" type="text" placeholder="Địa chỉ"><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính"><br>
            <input class="form-control" required name="birthday" type="text" placeholder="Ngày - tháng - năm sinh"><br>
            <input class="form-control" required name="status" type="text" placeholder="Trạng thái tài khoản"><br>
            <input class="form-control" required name="parents" type="text" placeholder="Tên phụ huynh"><br>
            <input class="btn btn-success" type="submit" name="submit_students" value="Thêm mới học sinh">
        </form>
    <?php } ?>
    
</div>