<?php
require_once '../app/extend/header.php';
?>
<div class="container">
  <div class="sign-up-box">
    <!-- <div class="row" class="col-md-12"> -->
    <div class="col-md-6 sign-up-center" >
      <h3>ĐĂNG KÍ</h3>
      <p style="color: red"> Vui lòng điền đầy đủ thông tin để đăng kí</p>
      <form action="?url=home/signUp" method="post">
        <div class="form-goup">
          <label>Họ và tên</label>
          <input type="text" name="name" placeholder="Điền họ và tên" class="form-control" required>
        </div>
        <div class="form-goup">
          <label>Tên đăng nhập</label>
          <input type="text" name="user" placeholder="Điền tên đăng nhập" class="form-control" required>
        </div>
        <div class="form-goup">
          <label>Mật khẩu</label>
          <input type="password" name="pass" placeholder="Điền mật khẩu" class="form-control" required>
        </div>
        <?php if (!empty ($data['resultMessage'])) { ?>
                    <br>
                    <p style="color: red">
                        <?= $data['resultMessage']; // đẩy ra data dc truyen tu controller ?>
                    </p>
                    <br>
                <?php } ?>
        <br>
        <input type="submit" name="submit" value="Đăng kí" class="btn btn-success">
        <hr>
        <p>
          Đã có tài khoản <a href="?url=home/login"> Đăng nhập</a>
        </p>
      </form>
    </div>
  <!-- </div> -->
  </div>
</div>

