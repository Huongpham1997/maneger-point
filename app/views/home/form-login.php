<?php
// Import file import.php
require_once '../app/extend/header.php';
?>

<div class="container">

    <div class="login-container">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <form action="?url=home/login" method="post">
                <input name="user" type="text" placeholder="username">
                <input name="pass" type="password" placeholder="password">
                <?php if (!empty ($data['resultMessage'])) { ?>
                    <br>
                    <br>
                    <p style="color: red">
                        <?= $data['resultMessage']; // chỗ này là đẩy ra data dc truyen tu controller ?>
                    </p>
                    <br>
                <?php } ?>
                <input type="submit" name="submit" value="Đăng nhập">
            </form>
        </div>
    </div>
</div>