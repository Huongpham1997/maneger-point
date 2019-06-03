<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<div class="content">
    <div class="container">
        <div class="cr-page-link">
            <a href="?url=home/index">Trang chủ</a>
            <span>/</span>
            <a href="?url=classStudent/index">Quản lý lớp</a>
            <span>/</span>
            <a href="">Quản lý học sinh</a>
        </div>
    </div>
    <div class="container">
        <div class="main-cm-1">
            <div class="creat-cp">
                <a href="?url=subjectClass/addSubjectClass&class_id=<?= $data['class_id'] ?>" class="btn btn-success">Thêm mới môn học</a>
            </div>
            <div class="col-md-12">
                <div class="col-md-12">
                    <h3 class="cp-name">Danh sách các học sinh</h3>
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
                                        <th>Mã môn học</th>
                                        <th>Tên môn học</th>
                                        <th>Tên giáo viên</th>
                                        <th colspan="2" style="text-align:center;">Hành động</th>
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
                                                <td><?= $row['subject_title'] ?></td>
                                                <td><?= $row['name_teacher'] ?></td>
                                                <td>
                                                    <a href="#" onclick="updateSelected(<?= $row['id'] ?>,<?= $_GET['class_id'] ?>)" > <i class="glyphicon glyphicon-edit"></i> Sửa</a>
                                                </td>
                                                <td>
                                                    <a href="#" onclick="deleteSelected(<?= $row['id'] ?>,<?= "'".$row['subject_title']."'" ?>)"> <i class="glyphicon glyphicon-trash"></i> Xóa</a>
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
                        // function dưới đây để gọi xóa môn học 
                        function deleteSelected(id,subject_title) {
                            if (confirm('Bạn có chắc chắn xóa môn học ' + subject_title + '?')) {
                                $.post("?url=subjectClass/delete", {
                                    'id': id
                                }).done(function (data) {
                                    alert(data['message']);
                                    location.reload();
                                });
                            }
                        }

                        // function dưới đây để gọi sang update lại môn học
                        function updateSelected(id,class_id) {
                            location.href="?url=subjectClass/update&id="+id+"&class_id="+class_id;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php require_once '../app/extend/footer.php'; ?>