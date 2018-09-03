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
        <form action="?url=students/update&id=<?= $row['id'] ?>&class_id=<?= $_GET['class_id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="name_student" type="text" placeholder="Tên học sinh" value="<?= $row['name_student']?$row['name_student']:'' ?>"><br>
            <input class="form-control" required name="address" type="text" placeholder="Địa chỉ" value="<?= $row['address']?$row['address']:'' ?>"><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính" value="<?= $row['sex']?$row['sex']:'' ?>" ><br>
            <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input2" data-link-format="yyyy/mm/dd">
                <input name="birthday" class="form-control" size="16" type="text" value="<?= $row['birthday']?$row['birthday']:'' ?>" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div><br>
            <input class="form-control" required name="status" type="text" placeholder="Trạng thái tài khoản" value="<?= $row['status']?$row['status']:'' ?>"><br>
            <input class="form-control" required name="parents" type="text" placeholder="Tên phụ huynh" value="<?= $row['parents']?$row['parents']:'' ?>"><br>
            <input type="hidden" name="class_id" value="<?= $data['class_id'] ?>">
            <input class="btn btn-success" type="submit" name="submit_students" value="Cập nhật học sinh">
        </form>
    <?php }}else{ ?>
        <form action="?url=students/addStudents&class_id=<?= $data['class_id'] ?>" method="post">
            <input class="form-control" required name="name_student" type="text" placeholder="Tên học sinh" value=""><br>
            <input class="form-control" required name="address" type="text" placeholder="Địa chỉ"><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính"><br>
            <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input2" data-link-format="yyyy/mm/dd">
                <input name="birthday" class="form-control" size="16" type="text" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div><br>
            <input class="form-control" required name="status" type="text" placeholder="Trạng thái tài khoản"><br>
            <input class="form-control" required name="parents" type="text" placeholder="Tên phụ huynh"><br>
            <input type="hidden" name="class_id" value="<?= $data['class_id'] ?>">
            <input class="btn btn-success" type="submit" name="submit_students" value="Thêm mới học sinh">
        </form>
    <?php } ?>
    
</div>
<script>
    $('.form_date').datetimepicker({
        language:  'vi',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>  