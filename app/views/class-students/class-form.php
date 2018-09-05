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
        <form action="?url=classStudent/update&id=<?= $row['id'] ?>" method="post" id="form_input_class">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="class_name" type="text" placeholder="Tên lớp" value="<?= $row['class_name']?$row['class_name']:'' ?>"><br>
            <input class="form-control" required name="total_student" type="text" id="id_total_student" placeholder="Tổng số học sinh" value="<?= $row['total_student']?$row['total_student']:'' ?>">
            <br>
            <input class="form-control" required name="year" type="text" placeholder="Niên khóa" value="<?= $row['year']?$row['year']:'' ?>" ><br>
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên chủ nhiệm" value="<?= $row['name_teacher']?$row['name_teacher']:'' ?>"><br>
            <input class="btn btn-success" type="submit" name="submit_edit_class" value="Cập nhật lớp">
        </form>
    <?php }}else{ ?>
        <form action="?url=classStudent/addClass" method="post" id="form_input_class">
            <input class="form-control" required name="class_name" type="text" placeholder="Tên lớp" value=""><br>
            <input class="form-control" required name="total_student" type="text" id="id_total_student" placeholder="Tổng số học sinh">
            <br>
            <input class="form-control" required name="year" type="text" placeholder="Niên khóa"><br>
            <input class="form-control" required name="name_teacher" type="text" placeholder="Tên giáo viên chủ nhiệm"><br>
            <input class="btn btn-success" type="submit" name="submit_class" value="Thêm mới lớp">
        </form>
    <?php } ?>
</div>
<script type="text/javascript">
    $('#form_input_class').submit(
        function ()
        {
            if (CheckIsNumeric($('#id_total_student').val()) == true ) {
                return true; // return false to cancel form action
            }else{
                alert('Tổng số học sinh phải là kiểu số, Vui lòng nhập lại!');
                
                return false;
            }
            return false;
    });

    function CheckIsNumeric(input)
    {
        return (input - 0) == input && (''+input).trim().length > 0;
    }
</script>