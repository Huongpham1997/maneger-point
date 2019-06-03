<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?url=home/index">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="#">Xem thông tin cá nhân giáo viên</a></li>
    </ol>
</nav>
<div class="col-md-12">
    <br>
    <?php
    if (!empty($data['resultMessageProcess'])) {
        echo $data['resultMessageProcess'];
    } // đẩy ra data dc truyen tu controller
    ?>
    <p style="color: red">
        <?php
        if (!empty($data['resultMessage'])) {
            echo $data['resultMessage'];
        }
        ?>
    </p>
    <?php
    if (!empty($data['data'])) {
        while ($row = $data['data']->fetch_assoc()) {
            ?>
            <div class="col-md-12">
                <div class="col-md-4 text-right"><b>Họ và tên</b></div>
                <div class="col-md-8 text-left"><?= $row['name_teacher'] ?></div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 text-right"><b>Địa chỉ</b></div>
                <div class="col-md-8 text-left"><?= $row['address'] ?></div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 text-right"><b>Ngày sinh</b></div>
                <div class="col-md-8 text-left"><?= $row['date_of_birth'] ?></div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 text-right"><b>Chuyên môn</b></div>
                <div class="col-md-8 text-left"><?= $row['ability'] ?></div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 text-right"><b>Giáo viên chủ nhiệm lớp</b></div>
                <div class="col-md-8 text-left"><?= !empty($row['class_teacher'])?$row['class_teacher']:"" ?></div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 text-right"><b>Giới tính</b></div>
                <div class="col-md-8 text-left"><?= $row['sex'] ?></div>
            </div>
            <?php
        }
    }
    ?>
</div>
</body>
</html>