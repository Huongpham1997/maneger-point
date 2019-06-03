<?php require_once '../app/views/home/menu.php'; ?>
    <div class="content">
        <div class="container">
            <div class="cr-page-link">
                <a href="?url=home/index">Trang chủ</a>
                <span>/</span>
                <a href="#">Quản lý giáo viên</a>
            </div>
        </div>
        <div class="container">
            <div class="main-cm-1">
                <div class="creat-cp">
                    <a href="?url=teacher/addTeacher" class="bt-common-1">Thêm mới giáo viên</a>
                </div>
                <div class="col-md-12">
                    <h3 class="cp-name">Danh sách giáo viên</h3>
                    <?php
                    if (!empty($data['resultMessageProcess'])) {
                        echo $data['resultMessageProcess'];
                    } // đẩy ra data dc truyen tu controller
                    ?>
                    <style>
                        table, th, td {
                            border: 1px solid black;
                            border-collapse: collapse;
                        }
                    </style>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên giáo viên</th>
                                <th>Địa chỉ</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>Lĩnh vực chuyên môn</th>
                                <th>Chủ nhiệm lớp</th>
                                <th colspan="3" style="text-align:center;">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <p style="color: red">
                                <?php
                                if (!empty($data['resultMessage'])) {
                                    echo $data['resultMessage'];
                                } // đẩy ra data dc truyen tu controller
                                ?>
                            </p>
                            <?php
                            if (!empty($data['data'])) {
                                // echo "<pre>";print_r($data['data']);die();
                                $i = 1;
                                while ($row = $data['data']->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['name_teacher'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= $row['date_of_birth'] ?></td>
                                        <td><?= $row['sex'] ?></td>
                                        <td><?= $row['ability'] ?></td>
                                        <td><?= $row['class_teacher'] ?></td>
                                        <td>
                                            <a href="#" onclick="updateSelected(<?= $row['id'] ?>)">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" onclick="deleteSelected(<?= $row['id'] ?>">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?url=teacher/detailTeacher&id=<?= $row['id'] ?>">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
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

                        // function dưới đây để gọi xóa giáo viên
                        function deleteSelected(id, name_teacher) {
                            if (confirm('Bạn có chắc chắn xóa giáo viên ' + name_teacher + '?')) {
                                $.post("?url=teacher/deleteTeacher", {
                                    'id': id
                                }).done(function (data) {
                                    alert(data['message']);
                                    location.reload();
                                });
                            }
                        }

                        // function dưới đây để gọi sang update lại giáo viên
                        function updateSelected(id) {
                            location.href = "?url=teacher/update&id=" + id;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php require_once '../app/extend/footer.php'; ?>