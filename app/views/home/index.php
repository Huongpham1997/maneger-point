<?php require_once '../app/views/home/menu.php'; ?>
<?php require_once '../app/extend/Constant.php'; ?>
    <div class="content">
        <div class="main-cm-2">
            <div class="container">
                <div class="left-content">
                    <div class="cr-page-link">
                        <a href="?url=home/index">Trang chủ</a>
                        <span>/</span>
                        <a href="#">Tin tức</a>
                    </div>
                    <div class="m-content">
                        <div class="list-news-block">

                            <?php if(!empty($data['data'])){
                                while ($row = $data['data']->data->fetch_assoc()) {
                                    ?>
                                    <div class="list-new-1">
                                        <div class="thumb-common">
                                            <img class="blank-img" src="/statics/img/blank.gif">
                                            <a href="?url=news/detail&id=<?= $row['id'] ?>">
                                                <img class="thumb-cm" src="/statics/images/images_news/<?= $row['image'] ?>">
                                            </a>
                                        </div>
                                        <div class="left-list">
                                            <h3><a href="?url=news/detail&id=<?= $row['id'] ?>"><?= Constant::substr($row['title'],50) ?></a></h3>
                                            <span class="time-up"><?= date('d/m/Y H:m:s', $row['created_date']) ?></span>
                                            <p><?= Constant::substr($row['short_description'],150) ?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } ?>
                            <?= $data['data']->htmlPages ?>
                        </div>
                    </div>
                </div>
                <div class="right-content">
                    <div class="creat-cp">
                        <a href="?url=news/create" class="bt-common-1">Thêm tin mới</a>
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
                                            <a href="?url=news/detail&id=<?= $row['id'] ?>"><img class="thumb-cm" src="/statics/images/images_news/<?= $row['image'] ?>"></a>
                                        </div>
                                        <div class="l-i-rl">
                                            <h4><a href="?url=news/detail&id=<?= $row['id'] ?>"><?= Constant::substr($row['title'],50) ?></a></h4>
                                            <p><?= Constant::substr($row['short_description'],70) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }else{
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
<?php require_once '../app/extend/footer.php'; ?>