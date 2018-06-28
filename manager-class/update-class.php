<?php

?>
<?php include('../extend/header.php'); ?>
<body>
  <?php
  include('../menu.php');
  include('../connect.php');
  ?>
  <div class="container">
    <form action="process-class.php" method="post">
      <?php
      if ($_GET['id']) {
        $sql = "SELECT * FROM class WHERE  ID = " . $_GET['id'];
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <div class="row">
              <div class="col-md-2">
                <label>Tên lớp: </label>
              </div>
              <div class="col-md-10">
                <input class="form-control" required value="<?= $row['class_name'] ? $row['class_name'] : '' ?>"
                name="class_name" type="text" placeholder="Tên lớp"><br>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <label>Tổng số học sinh</label>
              </div>
              <div class="col-md-10">
               <input class="form-control" required
               value="<?= $row['total_student'] ? $row['total_student'] : '' ?>" name="total_student"
               type="text"
               placeholder="Tổng số học sinh"><br>
             </div>
           </div>
           <div class="row">
            <div class="col-md-2">
              <label>Niên khóa</label>
            </div>
            <div class="col-md-10">
             <input class="form-control" required name="year" value="<?= $row['year'] ? $row['year'] : '' ?>"
             type="text" placeholder="Niên khóa"><br>
           </div>
         </div>
         <input type="hidden" name="id_class" value="<?= $row['ID']?$row['ID']:'' ?>">
         <div class="row">
          <div class="col-md-2">
            <label>Giáo viên chủ nhiệm</label>
          </div>
          <div class="col-md-10">

            <input class="form-control" required name="name_teacher"
            value="<?= $row['name_teacher'] ? $row['name_teacher'] : '' ?>" type="text"
            placeholder="Tên giáo viên chủ nhiệm">
            <br>
          </div>
        </div>
        <input class="btn btn-success" type="submit" name="submit_class_update" value="Cập nhật lớp">
        <?php
      }
    }
  }
  ?>
</form>
</div>
</body>