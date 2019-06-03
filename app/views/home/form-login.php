<?php
// Import file import.php
require_once '../app/extend/header.php';
?>
<div class="content">
    <div class="container">
        <div class="box-login-page">
            <div class="form-login">
                <div class="text-center">
                    <img style="width: 200px" src="/statics/img/avt_df.png" alt="Đăng nhập trang quản trị">
                </div>
                <br><br>
                <form action="?url=home/login" method="post">
                    <h3 class="text-center">Đăng Nhập</h3>

                    <input class="form-control" name="user" type="text" placeholder="Nhập tên đăng nhập">

                    <input class="form-control" name="pass" type="password" placeholder="Nhập mật khẩu">

                    <?php if (!empty ($data['resultMessage'])) { ?>
                        <p style="color: red">
                            <?= $data['resultMessage']; // đẩy ra data dc truyen tu controller     ?>
                        </p>
                    <?php } ?>
                    
                    <div class="line-bt">
                        <input type="submit" name="submit" value="Đăng nhập" class="bt-common-1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/extend/footer.php'; ?>