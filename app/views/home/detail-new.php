<?php require_once '../app/views/home/menu.php'; ?>
<?php require_once '../app/extend/Constant.php'; ?>
<?php if (!empty($data['data'])) {
    while ($row = $data['data']->fetch_assoc()) {
        ?>
        <div class="content">
            <div class="main-cm-2">
                <div class="container">
                    <div class="left-content">
                        <div class="cr-page-link">
                            <a href="?url=home/index">Trang chủ</a>
                            <span>/</span>
                            <a href="#">Tin tức</a>
                            <span>/</span>
                            <a href="#"><?= $row['title'] ?></a>
                        </div>
                        <div class="m-content">
                            <?php if (!empty($data['message'])) {
                                ?>
                                <div class="alert alert-success">
                                    <?= $data['message'] ?>
                                </div>
                                <?php
                            } ?>

                            <h1><?= $row['title'] ?></h1>
                            <div class="fb-share-button" data-href="<?= $_SERVER['REQUEST_URI'] ?>"
                                 data-layout="button" data-size="small" data-mobile-iframe="true">
                                <a class="fb-xfbml-parse-ignore" target="_blank"
                                   href="https://www.facebook.com/sharer/sharer.php?u=<?= $_SERVER['REQUEST_URI'] ?>;src=sdkpreparse">
                                    Chia sẻ</a>
                            </div>
                            <br><br>
                            <p class="des-dt"><?= $row['short_description'] ?></p>
                            <div class="content-dt">
                                <?= preg_replace('/(\<img[^>]+)(style\=\"[^\"]+\")([^>]+)(>)/', '${1}${3}${4}', $row['description']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="creat-cp">
                            <?php if ($row['create_by'] == $_SESSION['user']['id']) {
                                ?>
                                <a href="?url=news/update&id=<?= $row['id'] ?>" class="bt-common-1">Sửa thông tin</a>
                                <?php
                            } else {
                                ?>
                                <a href="?url=news/create" class="bt-common-1">Thêm tin mới</a>
                                <?php
                            } ?>
                        </div>
                        <div class="block-related block-cm-2">
                            <h3>Có thể bạn quan tâm</h3>
                            <div class="list-related">
                                <?php
                                if (!empty($data['dataRelated'])) {
                                    while ($row = $data['dataRelated']->fetch_assoc()) {
                                        ?>
                                        <div class="l-related">
                                            <div class="thumb-common">
                                                <img class="blank-img" src="/statics/img/blank.gif">
                                                <a href="?url=news/detail&id=<?= $row['id'] ?>"><img class="thumb-cm"
                                                                                                     src="/statics/images/<?= $row['image'] ?>"></a>
                                            </div>
                                            <div class="l-i-rl">
                                                <h4>
                                                    <a href="?url=news/detail&id=<?= $row['id'] ?>"><?= Constant::substr($row['title'], 50) ?></a>
                                                </h4>
                                                <p><?= Constant::substr($row['short_description'], 70) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="l-related">
                                        <div class="thumb-common">
                                            <img class="blank-img" src="/statics/img/blank.gif">
                                        </div>
                                        <div class="l-i-rl">
                                            <h4>Đang cập nhật </h4>
                                        </div>
                                    </div>
                                    <?php

                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    <?php }
} ?>
<?php require_once '../app/extend/footer.php'; ?>