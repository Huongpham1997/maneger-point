<?php
include('../connect.php');
if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    // Kiểm tra dữ liệu có null không
    if ($user == "") {
        echo "<script>alert('Chưa nhập tài khoản.')</script>";
        include('../index.php');
    } else if ($pass == "") {
        echo "<script>alert('Chưa nhập mật khẩu.')</script>";
        include('../index.php');
    } else {
        $sql = "SELECT * FROM `login` WHERE `user`='$user' and `password`='$pass'";
        // Em phải biết cách debug dữ liệu lệnh quen thuôc echo"<pre>";print_r($data);die(); để xem dữ liệu ntn
        $result = $con->query($sql); // thực hiện truy vấn
        if ($result->num_rows > 0) { // có dữ liệu trả về
            // echo "<script>alert('Chào mừng $user đăng nhập thành công !')</script>";
            while ($row = $result->fetch_assoc()) {
                include('../process-function/process-session.php');
                saveUserInfo($row['user'], $row['fullName']);
                // cái lúc này nó có session rồi thì cho nó quay lại trang chủ
                echo "<script>window.location.href ='../index.php';
						alert('Đăng nhập thành công.');</script>";
            }
        } else {
            echo "<script>alert('Tài khoản và mật khẩu bị sai.')</script>";
            include('../index.php');
        }
    }
}
?>