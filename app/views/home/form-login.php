<?php
// Import file import.php
    require_once '../app/extend/header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lí điểm học sinh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <?php include('../app/views/home/menu.php'); ?>

</head>
<body>
    <div class="container">
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar" ></div>
        <div class="form-box">
            <?php if(!empty ($resultMessage)){print($resultMessage);} ?>
            <form action="/home/login" method="post">
                <input name="user" type="text" placeholder="username">
                <input name="pass" type="password" placeholder="password">
                <input type="submit" name="submit" value="Đăng nhập">
            </form>
        </div>
    </div>
</div>
</body>
</html>