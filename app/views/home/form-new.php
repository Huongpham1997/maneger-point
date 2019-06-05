<?php require_once '../app/views/home/menu.php'; ?>
    <div class="content">
        <div class="container">
            <div class="cr-page-link">
                <a href="?url=home/index">Trang chủ</a>
                <span>/</span>
                <a href="#">Thêm mới tin tức</a>
            </div>
        </div>
        <div class="container">
            <div class="main-cm-1">
                <?php include('../app/extend/left-menu.php'); ?>
                <div class="right-cn">
                        <div class="form-login">
                            <?php if (!empty($data['resultMessageProcess'])) { ?>
                                <div class="alert alert-danger">
                                    <?= $data['resultMessageProcess'] ?>
                                </div>
                            <?php }
                            if (!empty($data['data'])) {
                                while ($row = $data['data']->fetch_assoc()) {
                                    ?>
                                    <div class="text-center">
                                        <?php
                                        if (!empty($row['image'])) {
                                            ?>
                                            <img height="150" src="/statics/images/images_news/<?= $row['image'] ?>">
                                            <?php
                                        } else {
                                            ?>
                                            <img height="150" src="/statics/img/avt_df.png">
                                            <?php
                                        }
                                        ?>
                                    </div><br><br>
                                    <form action="?url=news/update&id=<?= $row['id'] ?>"
                                          method="post" enctype='multipart/form-data'>
                                        <input class="form-control" required name="title" type="text" placeholder="Tiêu đề bài viết" value="<?= $row['title'] ?>"><br>
                                        <input class="form-control" name="short_description" type="text" placeholder="Mô tả ngắn" value="<?= $row['short_description'] ?>"><br>
                                        <div>
                                            <script type="text/javascript">
                                                var oFCKeditor = new FCKeditor('description');
                                                oFCKeditor.BasePath	= "statics/fckeditor/" ;
                                                oFCKeditor.Height	= 400 ;
                                                oFCKeditor.width	= 800 ;
                                                oFCKeditor.Value	= '<?= $row['description'] ?>';
                                                oFCKeditor.Config["Entermode"] = "br";
                                                oFCKeditor.Create() ;
                                            </script>
                                        </div>
                                        <input name="image" type="file"><br>
                                        <input class="btn btn-success" type="submit"
                                               name="submit_create_news" value="Cập nhật tin tức">
                                    </form>
                                <?php }
                            } else { ?>
                                <form action="?url=news/create" method="post" enctype='multipart/form-data'>
                                    <button onclick="goBack()" class="btn btn-success">Trở về
                                    </button>
                                    <br><br>
                                    <input class="form-control" required name="title" type="text" placeholder="Tiêu đề bài viết" value=""><br>
									<input class="form-control" name="short_description" type="text" placeholder="Mô tả ngắn" value=""><br>
									<div>
										<script type="text/javascript">
											var oFCKeditor = new FCKeditor('description');
											oFCKeditor.BasePath	= "fckeditor/" ;
											oFCKeditor.Height	= 400 ;
											oFCKeditor.width	= 800 ;
											oFCKeditor.Value	= 'Nội dung bài viết';
											oFCKeditor.Config["Entermode"] = "br";
											oFCKeditor.Create() ;
										</script>
									</div>
                                    <input name="image" type="file"><br>
                                    <input class="btn btn-success" type="submit" name="submit_create_news" value="Thêm mới bài viết">
                                </form>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once '../app/extend/footer.php'; ?>