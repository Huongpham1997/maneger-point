<?php require_once '../app/views/home/menu.php'; ?>
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
                                    <a href="?url=teacher/update&id=<?= $row['id'] ?>" class="bt-edit"><i class="fa fa-pencil">
                                    </i></a>
                                    <?php
                                    if (!empty($row['image'])) {
                                        ?>
                                        <img src="/statics/images/images_teacher/<?= $row['image'] ?>"><br>
                                        <?php
                                    } else {
                                        ?>
                                        <img src="/statics/img/avt_df.png"><br>
                                        <?php
                                    }
                                    ?>
                                    <h4><?= $row['name_teacher'] ?></h4>
                                </div>
                            </div>

                            <div class="right-cn">
                                <div class="text-center">
                                        <?php
                                        if (!empty($row['image'])) {
                                            ?>
                                            <img height="150" src="/statics/images/images_teacher/<?= $row['image'] ?>">
                                            <?php
                                        } else {
                                            ?>
                                            <img height="150" src="/statics/img/avt_df.png">
                                            <?php
                                        }
                                        ?>
                                    </div><br><br>
                                <?php if (!empty($data['message'])) { ?>
                                    <div class="alert alert-success">
                                        <?= $data['message'] ?>
                                    </div>
                                <?php } ?>


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
                                    <span class="b-span"><?= !empty($row['class_teacher']) ? $row['class_teacher'] : "" ?></span>
                                </div>
                                <div class="block-cm-left">
                                    <span class="t-span">Giới tính</span><br>
                                    <span class="b-span"><?= $row['sex'] ?></span>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
<?php require_once '../app/extend/footer.php'; ?>