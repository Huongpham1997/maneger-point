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
        } // đẩy ra data dc truyen tu controller
        ?>
    </p>
    <?php if(!empty($data['data'])){ 
        while ($row = $data['data']->fetch_assoc()) {
        ?>
        <form action="?url=teacher/update&id=<?= $row['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên" value="<?= $row['name_teacher']?$row['name_teacher']:'' ?>"><br>
            <input class="form-control" required name="address" type="text" placeholder="Địa chỉ" value="<?= $row['address']?$row['address']:'' ?>"><br>
            <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input2" data-link-format="yyyy/mm/dd">
                <input name="date_of_birth" class="form-control" size="16" type="text" value="<?= $row['date_of_birth']?$row['date_of_birth']:'' ?>" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div><br>
            <input class="form-control" required name="ability" type="text" placeholder="Trình độ chuyên môn" value="<?= $row['ability']?$row['ability']:'' ?>"><br>
            <input class="form-control" required name="class_teacher" type="text" placeholder="Chủ nhiệm lớp" value="<?= $row['class_teacher']?$row['class_teacher']:'' ?>" ><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính" value="<?= $row['sex']?$row['sex']:'' ?>" ><br>
            <input class="btn btn-success" type="submit" name="submit_teacher" value="Cập nhật giáo viên">
        </form>
    <?php }}else{ ?>
        <form action="?url=teacher/addTeacher" method="post">
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên" value=""><br><input class="form-control" required name="address" type="text" placeholder="Địa chỉ" value=""><br>
            <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input2" data-link-format="yyyy/mm/dd">
                <input name="date_of_birth" class="form-control" size="16" type="text" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div><br>
            <input class="form-control" required name="ability" type="text" placeholder="Trình độ chuyên môn"><br>
            <input class="form-control" required name="class_teacher" type="text" placeholder="Chủ nhiệm lớp"><br>
            <input class="form-control" required name="sex" type="text" placeholder="Giới tính"><br>
            <input class="btn btn-success" type="submit" name="submit_teacher" value="Thêm mới giáo viên">
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