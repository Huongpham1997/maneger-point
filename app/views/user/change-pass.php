<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
require_once '../app/extend/header.php';
use common\models\User; ?>
    <div class="content">
        <div class="container">
            <div class="cr-page-link">
                <a href="?url=home/index">Trang chủ</a>
                <span>/</span>
                <a href="#">Cập nhật tài khoản tài khoản <?= $_SESSION['user']['username'] ?></a>
            </div>
        </div>
        <div class="container">
            <div class="main-cm-1">
                <?php include('../app/extend/left-menu.php'); ?>
                <div class="right-cn">
                    <div class="box-login-page">
                        <div class="form-login">
                            <?php
                                if (!empty($data['resultMessageProcess'])) {
                                    echo $data['resultMessageProcess'];
                                } // đẩy ra data dc truyen tu controller
                            ?>
                            <p style="color: red">
                            <?php
                                if (!empty($data['resultMessage'])) {
                                    echo $data['resultMessage'];
                                } // đẩy ra data dc truyen tu controller
                            ?>
                            </p>
                            <form method="post" action="?url=user/changePass">
                                <input type="password" name="oldPass" class="form-control" placeholder="Mật khẩu cũ" required><br>
                                <input type="password" name="newPass" class="form-control" placeholder="Mật khẩu mới" required><br>
                                <input type="password" name="confirmPass" class="form-control" placeholder="Xác nhận mật khẩu" required><br>
                                <input type="submit" name="smChangePass" class="btn bg-success" value="Đổi mật khẩu">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/extend/footer.php'; ?>