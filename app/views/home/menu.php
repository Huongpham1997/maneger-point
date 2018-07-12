<?php
 require_once '../app/extend/header.php'; ?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Trang chủ</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Quản lý giáo viên</a></li>
                <li><a href="?url=students/index">Quản lý học sinh</a></li>
                <li><a href="?url=classStudent/index">Quản lý các lớp</a></li>
                <li><a href="#">Quản lý điểm</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Quản lý khối <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        // cách gọi sql từ file view Chỗ này sửa thành theo MVC đi nhé không viết truy vấn ngoài file thế này 
                        $con = new Controller();
                        $con = $con->model('Connect');
                        $sql = "SELECT * FROM `class`"; // Tạo bảng class có các trường dữ liệu id, class_name, total_student, year, name_teacher
                        $result = $con->getConnect($sql); // thực hiện truy vấn
                        if ($result->num_rows > 0) { // có dữ liệu trả về
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <li><a href="#"><?= $row['class_name'] ?></a></li>
                                <?php
                            }
                        } else {
                            echo "Chưa có dữ liệu";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm">
                </div>
                <button type="submit" class="btn btn-default">Tìm kiếm</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Xin chào <?= !empty($_SESSION['user']['fullName'])?$_SESSION['user']['fullName']:'' ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Xem thông tin</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Thay đổi mật khẩu</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="?url=home/logout">Thoát</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>