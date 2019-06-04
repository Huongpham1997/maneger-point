<?php require_once '../app/views/home/menu.php'; ?>
<div class="content">
    <div class="container">
        <div class="cr-page-link">
            <a href="?url=home/index">Trang chủ</a>
            <span>/</span>
            <a href="#">Quản lý lớp học</a>
        </div>
    </div>
    <div class="container">
        <div class="main-cm-1">
            <div class="creat-cp">
                <a href="?url=classStudent/addClass" class="bt-common-1">Thêm mới lớp học</a>
            </div>
            <div class="col-md-12">
                    <h3 class="cp-name">Danh sách các lớp</h3>
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
                                <th>Tên lớp học</th>
                                <th>Số học sinh</th>
                                <th>Niên khóa</th>
                                <th>Thầy/Cô chủ nhiệm</th>
                                <th colspan="6" style="text-align:center;">Hành động</th>
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
                                while ($row = $data['data']->data->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row['class_name'] ?></td>
                                        <td><?= $row['total_student'] ?></td>
                                        <td><?= $row['year'] ?></td>
                                        <td><?= $row['name_teacher'] ?></td>
                                        <td>
                                            <a href="#" onclick="updateSelected(<?= $row['id'] ?>)" > <i class="glyphicon glyphicon-edit"></i> Sửa</a>
                                        </td>
                                        <td>
                                            <a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['class_name']."'" ?>)"> <i class="glyphicon glyphicon-trash"></i> Xóa</a>
                                        </td>
                                        <td>
                                            <a href="?url=students/index&class_id=<?= $row['id'] ?>"> <i class="glyphicon glyphicon-eye-open"></i> QL Học sinh</a>
                                        </td>
                                        <td>
                                            <a href="?url=managerPoint/index&class_id=<?= $row['id'] ?>"> <i class="glyphicon glyphicon-list-alt"></i> QL Điểm</a>
                                        </td>
                                        <td>
                                            <a href="?url=subjectClass/index&class_id=<?= $row['id'] ?>"> <i class="glyphicon glyphicon-book"></i> QL Môn</a>
                                        </td>
                                        <td>
                                            <a href="?url=classStudent/index1&class_id=<?= $row['id'] ?>" class="btn btn-success"> Tính điểm TBM</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation">
                        <?= $data['data']->htmlPages ?>
                    </nav>
                </div>
                <script>
                    // function dưới đây để gọi xóa lớp
                    function deleteSelected(id,class_name) {
                        if (confirm('Bạn có chắc chắn xóa lớp ' + class_name + '?')) {
                            $.post("?url=classStudent/deleteClass", {
                                'id': id
                            }).done(function (data) {
                                alert(data['message']);
                                location.reload();
                            });
                        }
                    }

                    // function dưới đây để gọi sang update lại lớp
                    function updateSelected(id) {
                        location.href="?url=classStudent/update&id="+id;
                    }

                    function goBack() {
                        window.history.back();
                    }

                    // function check(){
                    //     // gửi lên control để xử lí thay đổi điểm
                    // $.post("?url=classStudent/AvegareOfSubjectByStudent",
                    // ).done(function(data) {
                    //     alert("Học sinh chưa đủ điểm để tính");
                    //     location.reload();
                    // });
                    //     // alert("Học sinh chưa đủ điểm để tính");
                    // }
                </script>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php require_once '../app/extend/footer.php'; ?>
