<?php
?>
<div class="left-cn hidden-xs hidden-sm">
    <div class="block-cm-left top-cn-left">
        <img src="/statics/img/avt_df.png"><br>
        <h4><?= $_SESSION['user']['username'] ?></h4>
        <h4><?= $_SESSION['user']['fullName'] ?></h4>
    </div>
    <div class="block-cm-left">
        <h5><b>Truy cập nhanh</b></h5>
    </div>
    <div class="block-cm-left">
        <span class="t-span"><a href="?url=teacher/index"> <i class="glyphicon glyphicon-play"></i> Quản lý giáo viên</a></span><br>
    </div>
    <div class="block-cm-left">
        <span class="t-span"><a href="?url=classStudent/index"> <i class="glyphicon glyphicon-play"></i> Quản lý lớp</a></span><br>
    </div>
    <div class="block-cm-left">
        <span class="t-span"><a href="?url=managerPoint/index&class_id=<?= $_GET['class_id'] ?>"> <i class="glyphicon glyphicon-play"></i> Quản lí điểm</a></span><br>
    </div>
    <div class="block-cm-left">
        <span class="t-span"><a href="?url=subjectClass/index&class_id=<?= $_GET['class_id'] ?>"> <i class="glyphicon glyphicon-play"></i> Quản lý môn</a></span><br>
    </div>
    <div class="block-cm-left">
        <span class="t-span"><a href="?url=students/index&class_id=<?= $_GET['id'] ?>""> <i class="glyphicon glyphicon-play"></i> Quản lý học sinh</a></span><br>
    </div>
    <div class="block-cm-left">
        <span class="t-span"><a href="?url=user/detail"> <i class="glyphicon glyphicon-play"></i> Quản lí tài khoản</a></span><br>
    </div>
    

</div>
