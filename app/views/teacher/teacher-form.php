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
                <a href="?url=teacher/index">Quản lý giáo viên</a>
                <span>/</span>
                <a href="#"><?= empty($data['data']) ? 'Thêm mới giáo viên' : 'Cập nhật thông tin giáo viên' ?></a></li>
            </div>
        </div>
        <div class="container">
            <div class="main-cm-1">
                <div class="left-cn hidden-xs hidden-sm">
                    <div class="block-cm-left top-cn-left">
                        <h4><?= $_SESSION['user']['username'] ?></h4>
                        <p>Đang thực hiện thêm mới giáo viên</p>
                    </div>
                    <div class="block-cm-left">
                        <h5><b>Truy cập nhanh</b></h5>
                    </div>
                    <div class="block-cm-left">
                        <span class="t-span"><a href="?url=teacher/index"> <i class="glyphicon glyphicon-play"></i> Quản lý giáo viên</a></span><br>
                    </div>
                </div>
                <div class="right-cn">
                    <div class="box-login-page">
                        <div class="form-login">
                            <p style="color: red;text-align: center">
                                <?php
                                if (!empty($data['resultMessageProcess'])) {
                                    echo $data['resultMessageProcess'];
                                } // đẩy ra data dc truyen tu controller
                                ?>
                            </p>
                            <?php if (!empty($data['data'])) {
                                while ($row = $data['data']->fetch_assoc()) {
                                    ?>
                                    <div class="col-md-12">
                                        <form action="?url=teacher/update&id=<?= $row['id'] ?>"
                                              method="post">
                                            <input type="hidden" name="id"
                                                   value="<?= $row['id'] ?>">
                                            <input class="form-control" required name="name_teacher"
                                                   type="text" placeholder="Tên giáo viên"
                                                   value="<?= $row['name_teacher'] ? $row['name_teacher'] : '' ?>"><br>
                                            <input class="form-control" required name="address"
                                                   type="text"
                                                   placeholder="Địa chỉ"
                                                   value="<?= $row['address'] ? $row['address'] : '' ?>"><br>
                                            <div class="input-group date form_date" data-date=""
                                                 data-date-format="yyyy/mm/dd"
                                                 data-link-field="dtp_input2"
                                                 data-link-format="yyyy/mm/dd">
                                                <input name="date_of_birth" class="form-control"
                                                       size="16"
                                                       type="text"
                                                       value="<?= $row['date_of_birth'] ? $row['date_of_birth'] : '' ?>"
                                                       readonly>
                                                <span class="input-group-addon"><span
                                                            class="glyphicon glyphicon-remove"></span></span>
                                                <span class="input-group-addon"><span
                                                            class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                            <br>
                                            <input class="form-control" required name="ability"
                                                   type="text"
                                                   placeholder="Lĩnh vực chuyên môn"
                                                   value="<?= $row['ability'] ? $row['ability'] : '' ?>"><br>
                                            <input class="form-control" required
                                                   name="class_teacher"
                                                   type="text" placeholder="Chủ nhiệm lớp"
                                                   value="<?= $row['class_teacher'] ? $row['class_teacher'] : '' ?>"><br>
                                            <input class="form-control" type="text"
                                                   placeholder="Giới tính"
                                                   value="<?= $row['sex'] ? $row['sex'] : '' ?>"><br>
                                            <input class="btn btn-success" type="submit"
                                                   name="submit_teacher" value="Cập nhật giáo viên">
                                        </form>
                                    </div>
                                <?php }
                            } else { ?>
                                <form action="?url=teacher/addTeacher" method="post">
                                    <button onclick="goBack()" class="btn btn-success">Trở về
                                    </button>
                                    <br><br>
                                    <input class="form-control" required name="name_teacher"
                                           type="text"
                                           placeholder="Tên giáo viên"
                                           value=""><br><input class="form-control" required
                                                               name="address"
                                                               type="text" placeholder="Địa chỉ"
                                                               value=""><br>
                                    <div class="input-group date form_date" data-date=""
                                         data-date-format="yyyy/mm/dd"
                                         data-link-field="dtp_input2" data-link-format="yyyy/mm/dd">
                                        <input name="date_of_birth" class="form-control" size="16"
                                               type="text" readonly>
                                        <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <br>
                                    <input class="form-control" required name="ability" type="text"
                                           placeholder="Lĩnh vực chuyên môn"><br>
                                    <input class="form-control" required name="class_teacher"
                                           type="text"
                                           placeholder="Chủ nhiệm lớp"><br>
                                    <input class="form-control" required id="checkUsenameTeacher"
                                           name="username" type="text"
                                           placeholder="Tên đăng nhập"><br>
                                    <input class="form-control" required name="password" type="text"
                                           placeholder="Mật khẩu đăng nhập"><br>
                                    <input class="form-control" required name="sex" type="text"
                                           placeholder="Giới tính"><br>
                                    <input class="btn btn-success" type="submit"
                                           name="submit_teacher"
                                           value="Thêm mới giáo viên">
                                </form>
                            <?php } ?>
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

                            function goBack() {
                                window.history.go(-1);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once '../app/extend/footer.php'; ?>