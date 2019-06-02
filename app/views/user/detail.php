<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?url=home/index">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="#">Xem thông tin chi tiết tài
                khoản <?= $_SESSION['user']['username'] ?></a></li>
    </ol>
</nav>
<div class="col-md-12">
    <br>
    <?php
    if (!empty($data['resultMessageProcess'])) {
        echo $data['resultMessageProcess'];
    } // đẩy ra data dc truyen tu controller
    ?>
    <p class="text-center text-danger">
        <?php
        if (!empty($data['resultMessage'])) {
            echo $data['resultMessage'];
        } // đẩy ra data dc truyen tu controller
        ?>
    </p>
    <?php
    if (!empty($data['data'])) {
        while ($row = $data['data']->fetch_assoc()) {
            ?>
            <div class="col-md-12">
                <div class="col-md-4 text-right">Tên đăng nhâp</div>
                <div class="col-md-8 text-left"><?= $row['username'] ?></div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 text-right">Họ và tên</div>
                <div class="col-md-8 text-left"><?= $row['fullName'] ?></div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 text-right">Mô tả</div>
                <div class="col-md-8 text-left"><?= $row['role'] == 1 ? "SUPPER ADMIN " : "GIÁO VIÊN" ?></div>
            </div>
            <?php
            if ($row['role'] == 2) {
                ?>
                <div class="col-md-12">
                    <div class="col-md-4 text-right">Mã giáo viên</div>
                    <div class="col-md-8 text-left">
                        <?= $row['teacher_id'] ?> xem chi tiết tài khoản
                        <a href="?url=teacher/detailTeacher&id=<?= $row['teacher_id'] ?>">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
</div>
</body>
</html>