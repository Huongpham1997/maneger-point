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
<div class="col-md-offset-3 col-md-6">
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
</body>
</html>