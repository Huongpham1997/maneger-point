<!-- heder -->
<?php
	require_once '../app/extend/header.php';
?>
<!-- <div class="row">
	<div class="col-lh-12 col-md-12 col-sm-12 col-xs-12">
		<form name="frmchangepass" method="POST">
			<h3> ĐỔI MẬT KHẨU</h3>
			<div class="from-group">
				<label>Tài khoản</label>
				<input type="text" name="taikhoan" value="<?php echo $_SESION['user']; ?>" class="from-control" disabled="true">
			</div>
			<div class="from-group">
				<label>Mật khẩu cũ</label>
				<input type="password" name="matkhaucu" value="" class="from-control">
			</div>
			<div class="from-group">
				<label>Mật khẩu mới</label>
				<input type="password" name="matkhaumoi" value="" class="from-control">
			</div>
			<div class="from-group">
				<label>Xác nhận mật khẩu mới</label>
				<input type="password" name="matkhaumoilan2" value="" class="from-control">
			</div>
			<input type="submit" name="submit" value="Đổi mật khẩu" class="btn btn-primary">
		</form>
	</div>
</div> -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">Đổi mật khẩu</h3>
            <form method="POST" onsubmit="return false;" id="formChangePass">
                <div class="form-group">
                    <label for="user_signin">Mật khẩu cũ</label>
                    <input type="password" class="form-control" id="old_pass">
                </div>
                <div class="form-group">
                    <label for="user_signin">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="new_pass">
                </div>
                <div class="form-group">
                    <label for="user_signin">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" id="re_new_pass">
                </div>
                <a href="index.php" class="btn btn-default">
                    <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                </a>
                <button class="btn btn-primary" id="submit_change_pass">
                    <span class="glyphicon glyphicon-ok"></span> Thay đổi
                </button>
                <br><br>
                <div class="alert alert-danger hidden"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
	// Bắt đầu khi click vào nút Thay đổi
$('#submit_change_pass').on('click', function() {
    // Gán các giá trị trong form tạo note vào các biến
    $old_pass = $('#old_pass').val();
    $new_pass = $('#new_pass').val();
    $re_new_pass = $('#re_new_pass').val();
 
    // Nếu một trong các biến này rỗng
    if ($old_pass == '' || $old_pass == '' || $re_new_pass == '')
    {
        $('#formChangePass .alert').removeClass('hidden');
        $('#formChangePass .alert').html('Vui lòng điền đầy đủ thông tin bên trên.');
    }
    // Ngược lại
    else
    {
        // Thực thi gửi dữ liệu bằng Ajax
        $.ajax({
            url : 'change-pass.php', // Đường dẫn file nhận dữ liệu
            type : 'POST', // Phương thức gửi dữ liệu
            // Các dữ liệu
            data : {
                old_pass : $old_pass,
                new_pass : $new_pass,
                re_new_pass : $re_new_pass
            // Thực thi khi gửi dữ liệu thành công
            }, success : function(data) {
                $('#formChangePass .alert').removeClass('hidden');
                $('#formChangePass .alert').html(data);
            }
        });
    }
});
</script>
<?php require_once '../app/extend/footer.php'; ?>
