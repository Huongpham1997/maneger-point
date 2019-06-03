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
            <a href="?url=subjectClass/index&class_id=<?= $_GET['class_id'] ?>">Quản lí môn học</a>
            <span>/</span>
            <a href="#">Thêm mới môn học</a>
        </div>
    </div>
    <div class="container">
        <div class="main-cm-1">
            <div class="col-md-12">
                <div class="container">
                    <p style="color: red;text-align: center">
                        <?php
                        if (!empty($data['resultMessageProcess'])) {
                            echo $data['resultMessageProcess'];
                        } // đẩy ra data dc truyen tu controller
                        ?>
                    </p>
                    <?php if(!empty($data['data'])){ 
                        ?>
                        <form action="?url=subjectClass/update&id=<?= $_GET['id'] ?>&class_id=<?= $_GET['class_id'] ?>" method="post">
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <select class="form-control" name="teacher_id">
                                    <?php
                                    if(!empty($data['dataTeacher'])){ 
                                        $i = 1;
                                        while ($row = $data['dataTeacher']->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['id'] ?>">Giáo viên <?=$row['name_teacher'] ?> </option>
                                        <?php } 
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="class_id" value="<?= $data['class_id'] ?>">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input class="btn btn-success" type="submit" name="submit_edit_subject" value="Cập nhật môn học">
                        </form>
                    <?php } else { ?>
                       <form action="?url=subjectClass/addSubjectClass&class_id=<?= $_GET['class_id'] ?>" method="post">
                             <button onclick="goBack()" class="btn btn-success">Trở về</button><br><br>
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <select class="form-control" name="teacher_id">
                                    <?php
                                    if(!empty($data['dataTeacher'])){ 
                                        $i = 1;
                                        while ($row = $data['dataTeacher']->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['id'] ?>">Giáo viên <?=$row['name_teacher'] ?> </option>
                                        <?php } 
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="class_id" value="<?= $_GET['class_id'] ?>">
                            <input class="btn btn-success" type="submit" name="submit_add_subject" value="Thêm môn học">
                        </form>
                    <?php } ?>

                    <script type="text/javascript">
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