<?php
// Import file import.php//
require_once '../app/extend/header.php';
require_once '../app/views/home/menu.php';
?>
    <div class="content">
        <div class="container">
            <div class="cr-page-link">
                <a href="?url=home/index">Trang chủ</a>
                <span>/</span>
                <a href="?url=classStudent/index">Quản lí lớp học</a>
                <span>/</span>
                <a href="?url=managerPoint/index&class_id=<?= $_GET['class_id'] ?>">Quản lí điểm</a>
                <span>/</span>
                <a href="#"><?= empty($data['data']) ? 'Sửa điểm' : 'Thêm mới điểm' ?></a></li>
            </div>
        </div>
        <div class="container">
            <div class="main-cm-1">
                <?php include('../app/extend/left-menu.php'); ?>
                <div class="right-cn">
                    <!-- <div class="box-login-page">
                        <div class="form-login"> -->
                    <p style="color: red;text-align: center">
                        <?php
                        if (!empty($data['resultMessageProcess'])) {
                            echo $data['resultMessageProcess'];
                        } // đẩy ra data dc truyen tu controller
                        ?>
                    </p>
                    <form method="post" id="form_input_point"
                          action="?url=managerPoint/addPointStudents&class_id=<?= $_GET['class_id'] ?>">
                        <div class="col-md-3">
                            <select id="myDropDown" class="form-control" name="point_id">
                                <?php
                                if (!empty($data['dataPoint'])) {
                                    $i = 1;
                                    while ($row = $data['dataPoint']->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['id'] ?>">
                                            Điểm <?= $row['point_name'] ?> </option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="subject_id">
                                <?php
                                if (!empty($data['dataSubject'])) {
                                    $i = 1;
                                    while ($row = $data['dataSubject']->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['id'] ?>">
                                            Môn <?= $row['subject_title'] ?> </option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date form_date" data-date=""
                                 data-date-format="yyyy/mm/dd" data-link-field="dtp_input2"
                                 data-link-format="yyyy/mm/dd">
                                <input id="date_test" name="date_test" class="form-control"
                                       size="10" type="text" readonly required="true">
                                <span class="input-group-addon"><span
                                            class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span
                                            class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input id="hiddenWhenNeed" type="text" placeholder="Bài số" name="frequency" class="form-control">
                        </div>
                        <table class="table">
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
                                while ($row = $data['data']->data->fetch_assoc()) {
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
                        language: 'vi',
                        weekStart: 1,
                        todayBtn: 1,
                        autoclose: 1,
                        todayHighlight: 1,
                        startView: 2,
                        minView: 2,
                        forceParse: 0
                    });
                    $('#form_input_point').submit(
                        function () {
                            if (CheckIsNumeric($('#id_input_point').val()) == false) {
                                alert('Điểm của học sinh phải là kiểu số, Vui lòng nhập lại!');
                                return false; // return false to cancel form action
                            }
                            if ($('#date_test').val() == "") {
                                alert('Vui lòng nhập ngày kiểm tra');
                                return false;
                            }
                            return true;
                        });

                    function CheckIsNumeric(input) {
                        return (input - 0) == input && ('' + input).trim().length > 0;
                    }

                    $(document).ready(function() {
                        $('#myDropDown').change(function () {
                            inputValue = $(this).val();
                            if(inputValue == 4 || inputValue == 6){
                                $('#hiddenWhenNeed').hide('slow');
                            }else{
                                $('#hiddenWhenNeed').show('slow');
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
    </div>
    </div>
<?php require_once '../app/extend/footer.php'; ?>