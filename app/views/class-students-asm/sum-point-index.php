<?php
// Import file import.php
require_once '../app/views/home/menu.php';
?>
    <div class="content">
        <div class="container">
            <div class="cr-page-link">
                <a href="?url=home/index">Trang chủ</a>
                <span>/</span>
                <a href="?url=classStudent/index">Quản lý lớp</a>
                <span>/</span>
                <a href="">Tính điểm trung bình môn cho cả lớp</a>
            </div>
        </div>
        <div class="container">
            <div class="main-cm-1">
                <div class="creat-cp">
                    <form method="get">
                        <input type="hidden" name="url" value="managerPoint/averageOfClassByStudent">
                        <input type="hidden" name="class_id" value="<?= $_GET['class_id'] ?>">
                        <div class="col-md-6">
                            <select id="subjectId" class="form-control" name="subject_id">
                                <?php
                                if (!empty($data['dataSubject'])) {
                                    $i = 1;
                                    while ($row = $data['dataSubject']->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['id'] ?>">Môn
                                            học <?= $row['subject_title'] ?> </option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <input class="btn btn-success" type="submit" name="PointByClassStudent"
                               value="Tính điểm trung bình môn">
                    </form>
                </div>
                <?php if(!empty($data['message'])){ ?>
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <?= $data['message'] ?>
                    </div>
                    <div class="col-md-12">
                        <br><br>
                        <div class="text-center">
                            <a href="<?= $data['link'] ?>"> Vui lòng click đây để xem điểm </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php require_once '../app/extend/footer.php'; ?>