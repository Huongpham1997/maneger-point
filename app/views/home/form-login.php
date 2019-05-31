<?php
// Import file import.php
require_once '../app/extend/header.php';
?>

<div class="container">
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar" class="responsive"><img src="/manager-point/app/statics/images/avatar.png" id="avatar" style="
    width:  100%;"></div>
        <div class="form-box">
            <form action="?url=home/login" method="post">
                <input name="user" type="text" placeholder="Nhập tên đăng nhập">
                <input name="pass" type="password" placeholder="Nhập mật khẩu">
                <?php if (!empty ($data['resultMessage'])) { ?>
                    <br>
                    <br>
                    <p style="color: red">
                        <?= $data['resultMessage']; // đẩy ra data dc truyen tu controller ?>
                    </p>
                    <br>
                <?php } ?>
                <input type="submit" name="submit" value="Đăng nhập">
            </form>
        </div>
    </div>
</div>