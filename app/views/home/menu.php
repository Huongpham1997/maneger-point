<?php require_once '../app/extend/header.php'; ?>
<div class="top-nav header">
    <div class="container">
        <a class="navbar-brand logo" href="?url=home/index">
            <img src="/statics/img/anh.png" height="50">
        </a>
        <a class="ic-mn-mb hidden-mn" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
           aria-controls="collapseExample">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </a>
        <div class="top-lead hidden-xs hidden-sm">
            <a href="#" class="logo-cp">
                <img src="/statics/img/icon-right.jpg"></a>
            <h5>
                <span>Khoa Công Nghệ Thông Tin</span>
                <br>
                <span>Đơn vị tài trợ CNTT</span>
            </h5>
        </div>
    </div>
</div>
<div class="menu-mb hidden-mn">
    <div class="collapse" id="collapseExample">
        <div class="in-mn-mb">
            <div class="f-search">
                <form action="">
                    <input type="text" name="keyword" onfocus="this.select();" placeholder="Tìm kiếm tin tức..."
                           value="<?= isset($_COOKIE['keyword']) && !empty($_COOKIE['keyword']) ? $_COOKIE['keyword'] : ''; ?>">
                    <input type="hidden" name="search"
                           value="<?php echo str_replace(".php", "", "$_SERVER[REQUEST_URI]"); ?>">
                    <i class="fa fa-search"></i>
                </form>
            </div>

            <ul class="menu-web">
                <li class="active"><a href="?url=home/index">Trang chủ</a></li>
                <li><a href="?url=teacher/index">Quản lý giáo viên</a></li>
                <li><a href="?url=classStudent/index">Quản lý các lớp</a></li>
                <li><a href="#">Nội quy</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
            <div class="bb-login-ok">
                <a data-toggle="collapse" href="#collapse-user" aria-expanded="false" aria-controls="collapseExample">
                    Xin chào <?= !empty($_SESSION['user']['fullName'])?$_SESSION['user']['fullName']:'' ?>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="collapse-user">
                    <ul>
                        <li><a href="?url=user/detail"> Xem thông tin</a></li>
                        <li><a href="?url=user/changePass"> Thay đổi mật khẩu</a></li>
                        <li><a href="?url=home/logout"> Thoát</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="bottom-nav hidden-xs hidden-sm">
    <div class="container">
        <ul class="menu-web">
            <li class="active"><a href="?url=home/index">Trang chủ</a></li>
            <li><a href="?url=teacher/index">Quản lý giáo viên</a></li>
            <li><a href="?url=classStudent/index">Quản lý các lớp</a></li>
            <li><a href="#">Nội quy</a></li>
            <li><a href="#">Liên hệ</a></li>

            <div class="right-nav hidden-sm hidden-xs">
                <div class="f-search">
                    <form action="">
                        <input type="text" name="keyword" onfocus="this.select();" placeholder="Tìm kiếm tin tức..."
                               value="<?= isset($_COOKIE['keyword']) && !empty($_COOKIE['keyword']) ? $_COOKIE['keyword'] : ''; ?>">
                        <input type="hidden" name="search"
                               value="<?php echo str_replace(".php", "", "$_SERVER[REQUEST_URI]"); ?>">
                        <i class="fa fa-search"></i>
                    </form>
                </div>

                <div class="hello-us dropdown hidden-sm hidden-xs">
                    <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xin chào <?= !empty($_SESSION['user']['fullName'])?$_SESSION['user']['fullName']:'' ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href="?url=user/detail"> Xem thông tin</a></li>
                        <li><a href="?url=user/changePass"> Thay đổi mật khẩu</a></li>
                        <li><a href="?url=home/logout"> Thoát</a></li>
                    </ul>
                </div>
            </div>
        </ul>
    </div><!-- /.container -->
</nav><!-- /.navbar -->