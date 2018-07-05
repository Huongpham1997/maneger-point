<?php if(empty($_SESSION['user']['username'])){
            @ob_start();
            session_start();            
        } ?>
<!DOCTYPE html>
<html>
<head>

    <title>Quản lý điểm học sinh</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../app/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app/css/mycss.css">
    <script src="../app/js/jquery.min.js"></script>
    <script src="../app/js/bootstrap.min.js"></script>
    <script src="../app/js/myjs.js"></script>
</head>
<body>