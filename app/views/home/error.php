<?php require_once '../app/views/home/menu.php'; ?>
<div class="content">
    <div class="container">
        <div class="cr-page-link">
            <a href="?url=home/index">Trang chủ</a></li>
            <span>/</span>
            <a href="#">Thông báo lỗi</a>
        </div>
    </div>
    <div class="container">
        <div class="main-cm-1">
            <div class="creat-cp">
                <div class="alert alert-danger">
                    <?= !empty($data['message'])?$data['message']:'Đã có lỗi xảy ra' ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <br>
                    <h4>Vui lòng thực hiện lại hoặc liên hệ quản trị viên để được hỗ trợ </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/extend/footer.php'; ?>
