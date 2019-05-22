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
    <form method="post" id="form_input_point" action="?url=managerPoint/addPointStudents&class_id=<?= $_GET['class_id'] ?>">
        <div class="col-md-3">
            <select class="form-control" name="point_id">
                <?php
                if(!empty($data['dataPoint'])){ 
                    $i = 1;
                    while ($row = $data['dataPoint']->fetch_assoc()) {
                        ?>
                        <option value="<?= $row['id'] ?>">Điểm <?=$row['point_name'] ?> </option>
                    <?php } 
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control" name="subject_id">
                <?php
                if(!empty($data['dataSubject'])){ 
                    $i = 1;
                    while ($row = $data['dataSubject']->fetch_assoc()) {
                        ?>
                        <option value="<?= $row['id'] ?>">Môn <?=$row['subject_title'] ?> </option>
                    <?php } 
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input2" data-link-format="yyyy/mm/dd">
                <input name="date_test" class="form-control" size="16" type="text" readonly>
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="col-md-3">
            <input type="text" placeholder="Số lần kiểm tra" name="frequency" class="form-control" required="true">
        </div>
        <table  class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên học sinh</th>
                    <th>Địa chỉ</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Nhập điểm</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($data['data'])) {
        // echo "<pre>";print_r($data['data']);die();
                    $i = 1;
                    while ($row = $data['data']->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['name_student'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['sex'] ?></td>
                            <td><?= $row['birthday'] ?></td>
                            <td>
                                <input required="true" id="id_input_point" class="form-control" type="text" name="point_<?= $row['id'] ?>" placeholder="Nhập điểm tại đây">
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <input type="submit" name="insert_point" class="btn btn-success" value="Thêm điểm">
    </form>
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
    $('#form_input_point').submit(
        function ()
        {
            if (CheckIsNumeric($('#id_input_point').val()) == true ) {
                return true; // return false to cancel form action
            }else{
                alert('Điểm của học sinh phải là kiểu số, Vui lòng nhập lại!');
                return false;
            }
            return false;
    });
    function CheckIsNumeric(input)
    {
        return (input - 0) == input && (''+input).trim().length > 0  ;
    }
</script>    