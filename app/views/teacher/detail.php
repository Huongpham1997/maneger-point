<?php
// Import file import.php//
require_once '../app/views/home/menu.php';
?>
<div class="content">
    <div class="container">
        <div class="cr-page-link">
            <a href="?url=home/index">Trang chủ</a></li>
            <span>/</span>
            <a href="?url=teacher/index">Quản lí giáo viên</a>
            <span>/</span>
            <a href="#">Xem thông tin cá nhân giáo viên</a>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
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
                    }
                    ?>
                </p>
                <?php
                if (!empty($data['data'])) {
                    while ($row = $data['data']->fetch_assoc()) {
                        ?>
                        <div class="main-cm-1">

                            <div class="left-cn hidden-xs hidden-sm">
                                <div class="block-cm-left top-cn-left">
                                    <a href="#" class="bt-edit"><i class="fa fa-pencil"></i></a>
                                    <img src="/statics/img/avt_df.png"><br>
                                    <h4><?= $row['name_teacher'] ?></h4>
                                </div>
                            </div>
                            <div class="right-cn">
                                <div class="block-cm-left">
                                    <span class="t-span">Họ và tên</span><br>
                                    <span class="b-span"><?= $row['name_teacher'] ?></span>
                                </div>
                                <div class="block-cm-left">
                                    <span class="t-span">Địa chỉ</span><br>
                                    <span class="b-span"><?= $row['address'] ?></span>
                                </div>
                                <div class="block-cm-left">
                                    <span class="t-span">Ngày sinh</span><br>
                                    <span class="b-span"><?= $row['date_of_birth'] ?></span>
                                </div>
                                <div class="block-cm-left">
                                    <span class="t-span">Chuyên môn</span><br>
                                    <span class="b-span"><?= $row['ability'] ?></span>
                                </div>
                                <div class="block-cm-left">
                                    <span class="t-span">Chủ nhiệm lớp</span><br>
                                    <span class="b-span"><?= !empty($row['class_teacher'])?$row['class_teacher']:"" ?></span>
                                </div>
                                <div class="block-cm-left">
                                    <span class="t-span">Giới tính</span><br>
                                    <span class="b-span"><?= $row['sex'] ?></span>              
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php require_once '../app/extend/footer.php'; ?>