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
            <!-- <a class="navbar-brand" href="#" class="glyphicon glyphicon-home">Trang chủ</a> -->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="?url=home/index"><i class="glyphicon glyphicon-home"></i> Trang chủ</a>
                </li>
                <li><a href="?url=teacher/index"><i class="glyphicon glyphicon-list-alt"></i> Quản lý giáo viên</a></li>
                <li><a href="?url=classStudent/index"><i class="glyphicon glyphicon-education"></i> Quản lý các lớp</a></li>
                <li><a href="?url=managersubject/index"><i class="glyphicon glyphicon-th-list"></i> Quản lý các môn</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"> <i class="glyphicon glyphicon-tags"></i> Quản lý khối <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $con = new Controller();
                        $con = $con->model('Connect');
                        $sql = "SELECT * FROM `class`"; 
                        $result = $con->getConnect($sql); // thực hiện truy vấn
                        if ($result->num_rows > 0) { // có dữ liệu trả về
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <li><a href="?url=students/index&class_id=<?= $row['id'] ?>"><?= $row['class_name'] ?></a></li>
                                <?php
                            }
                        } else {
                            echo "Chưa có dữ liệu";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
           
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Xin chào <?= !empty($_SESSION['user']['fullName'])?$_SESSION['user']['fullName']:'' ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?url=user/detail"> Xem thông tin</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="?url=user/changePass"> Thay đổi mật khẩu</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="?url=home/logout"> Thoát</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="top-nav header">
    <div class="container">
        <a class="navbar-brand logo" href="/statics/img/logo.png" height="50"></a>

        <a class="ic-mn-mb hidden-mn" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
           aria-controls="collapseExample">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </a>
        <div class="top-lead hidden-xs hidden-sm">
            <?php if (isset($leadDonor) && !empty($leadDonor)) {
                /** @var $leadDonor \common\models\LeadDonor */
                ?>
                <a href="<?= Url::toRoute(['donor/view', 'id' => $leadDonor->id]) ?>" class="logo-cp"><img
                            src="<?= $leadDonor->getImageLink() ?>"></a>
                <h5>
                    <?= $leadDonor->name ?><br>
                    <span>Đơn vị bảo trợ</span>
                </h5>
            <?php } else { ?>
                <a href="<?= Url::toRoute(['donor/view', 'id' => 1]) ?>" class="logo-cp"><img
                            src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/img/logo-cp.png"></a>
                <h5>
                    Tập đoàn VNPT<br>
                    <span>Đơn vị tài trợ CNTT</span>
                </h5>
            <?php } ?>
        </div>
    </div>
</div>
<div class="menu-mb hidden-mn">
    <div class="collapse" id="collapseExample">
        <div class="in-mn-mb">
            <div class="f-search">
                <form action="">
                    <input type="text" name="keyword" onfocus="this.select();" placeholder="Tìm kiếm xã, dự án..."
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
                <li><a href="?url=managersubject/index">Quản lý các môn</a></li>
                <li><a href="#">Nội quy</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
            <?php
            if (Yii::$app->user->isGuest) {
                ?>
                <a href="<?= Url::toRoute(['site/login']) ?>" class="sign-in">Đăng nhập</a>
                <!--                <a href="--><? //= Url::toRoute(['site/signup']) ?><!--" class="sign-up">Đăng ký</a>-->
                <a onclick="showPop();" class="sign-up">Đăng ký</a>
                <?php
            } else {
                ?>
                <div class="bb-login-ok">
                    <a data-toggle="collapse" href="#collapse-user" aria-expanded="false"
                       aria-controls="collapseExample">
                        Xin chào
                        <?php
                        if (empty(Yii::$app->user->identity->fullname)) {
                            echo Yii::$app->user->identity->username;
                        } else {
                            echo Yii::$app->user->identity->fullname;
                        }
                        ?>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="collapse-user">
                        <ul>
                            <li><a href="<?= Url::toRoute(['user/my-page', 'id' => Yii::$app->user->identity->id]) ?>">Cá
                                    nhân</a></li>
                            <li>
                                <a href="<?= Url::toRoute(['user/change-my-password', 'id' => Yii::$app->user->identity->id]) ?>">Đổi
                                    mật khẩu</a></li>
                            <li><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" data-method="post">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<nav class="bottom-nav hidden-xs hidden-sm">
    <div class="container">
        <ul class="menu-web">
            <li class="active"><a href="<?= Url::toRoute(['site/index']) ?>"><i class="fa fa-home hidden-md"></i>Trang
                    chủ</a>
            </li>
            <li><a href="<?= Url::toRoute(['news/index']) ?>">Tin tức</a></li>
            <li><a href="<?= Url::toRoute(['campaign/list-campaign']) ?>">Chương trình phát triển</a></li>
            <li><a href="<?= Url::toRoute(['experience/index']) ?>">Kinh nghiệm</a></li>
            <li><a href="<?= Url::toRoute(['site/rules']) ?>">Nội quy</a></li>
            <!--            <li><a href="http://diendan.xavungcao.vivas.vn">Diễn Đàn</a></li>-->
            <li><a href="<?= Url::toRoute(['site/contact']) ?>">Liên hệ</a></li>
            <div class="right-nav hidden-sm hidden-xs">

                <div class="f-search">
                    <?php $form = ActiveForm::begin([
                        'action' => Url::toRoute('site/search'),
                        'method' => 'GET'
                    ]); ?>
                    <input type="text" name="keyword" onfocus="this.select();" placeholder="Tìm kiếm xã, dự án..."
                           value="<?= isset($_COOKIE['keyword']) && !empty($_COOKIE['keyword']) ? $_COOKIE['keyword'] : ''; ?>">
                    <input type="hidden" name="search"
                           value="<?php echo str_replace(".php", "", "$_SERVER[REQUEST_URI]"); ?>">
                    <i class="fa fa-search"></i>
                    <?php ActiveForm::end(); ?>
                </div>
                <?php
                if (Yii::$app->user->isGuest) { ?>
                    <a href="<?= Url::toRoute(['site/login']) ?>" class="sign-in">Đăng nhập</a>
                    <a onclick="showPop();" class="sign-up">Đăng ký</a>
                    <?php
                } else {
                    ?>
                    <div class="hello-us dropdown hidden-sm hidden-xs">
                        <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Xin chào
                            <?php
                            if (empty(Yii::$app->user->identity->fullname)) {
                                echo Yii::$app->user->identity->username;
                            } else {
                                echo Yii::$app->user->identity->fullname;
                            }
                            ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="<?= Url::toRoute(['user/my-page', 'id' => Yii::$app->user->identity->id]) ?>">Cá
                                    nhân</a></li>
                            <li>
                                <a href="<?= Url::toRoute(['user/change-my-password', 'id' => Yii::$app->user->identity->id]) ?>">Đổi
                                    mật khẩu</a></li>
                            <li><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" data-method="post">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
        </ul>
    </div><!-- /.container -->
</nav><!-- /.navbar -->