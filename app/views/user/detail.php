<?php require_once '../app/views/home/menu.php'; ?>

    <div class="content">
        <div class="container">
            <div class="cr-page-link">
                <a href="?url=home/index">Trang chủ</a></li>
                <span>/</span>
                <a href="#">Xem thông tin chi tiết tài khoản <?= $_SESSION['user']['username'] ?></a>
            </div>
        </div>
        <div class="container">
            <?php
            if (!empty($data['data'])) {
            while ($row = $data['data']->fetch_assoc()) {
            ?>
            <div class="main-cm-1">

                <div class="left-cn hidden-xs hidden-sm">
                    <div class="block-cm-left top-cn-left">
                        <a href="#" class="bt-edit"><i class="fa fa-pencil"></i></a>
                        <img src="/statics/img/avt_df.png"><br>
                        <h4><?= $row['username'] ?></h4>
                        <p><?= $row['fullName'] ?></p>
                    </div>
                </div>
                <div class="right-cn">
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
                    <div class="block-cm-left">
                        <span class="t-span">UserName</span><br>
                        <span class="b-span"><?= $row['username'] ?></span>
                    </div>
                    <div class="block-cm-left">
                        <span class="t-span">Họ và Tên</span><br>
                        <span class="b-span"><?= $row['fullName'] ?></span>
                    </div>
                    <div class="block-cm-left">
                        <span class="t-span">Mô tả</span><br>
                        <span class="b-span"><?= $row['role'] == 1 ? "SUPPER ADMIN " : "GIÁO VIÊN" ?></span>
                    </div>
                    <?php
                    if ($row['role'] == 2) {
                        ?>
                        <div class="block-cm-left">
                            <span class="t-span">Mô tả</span><br>
                            <span class="b-span">
                                <?= $row['teacher_id'] ?> xem chi tiết tài khoản
                                        <a href="?url=teacher/detailTeacher&id=<?= $row['teacher_id'] ?>">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a>
                                </span>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php
        }
        }
        ?>
    </div>
<?php require_once '../app/extend/footer.php'; ?>