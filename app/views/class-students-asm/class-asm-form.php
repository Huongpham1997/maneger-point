<?php
// Import file import.php//
require_once '../app/extend/header.php';
require_once '../app/views/home/menu.php';
?>
<div class="container">
    <p style="color: red;text-align: center">
        <?php
        if (!empty($data['resultMessageProcess'])) {
            echo $data['resultMessageProcess'];
        } // đẩy ra data dc truyen tu controller
        ?>
    </p>
    <?php if(!empty($data['data'])){ 
        while ($row = $data['data']->fetch_assoc()) {
        ?>
        <form action="?url=managerClass/addClassStudents" method="post">
            <button onclick="goBack()" class="btn btn-success">Trở về</button><br><br>
            <input class="form-control" required name="class_name" type="text" placeholder="Tên lớp" value=""><br>
            <div>
                <select class="form-control" name="point_id" >
                <?php
                if(!empty($data['dataPoint'])){ 
                    $i = 1;
                    while ($row = $data['dataPoint']->fetch_assoc()) {
                ?>
                <option value="<?= $row['id'] ?>">Điểm <?=$row['point_name'] ?> </option>
                <?php } 
            }
                ?>
            </select>
            </div>
            <input class="form-control" required name="student_id" type="text" placeholder="Tên học sinh" ><br>
            <input class="form-control" required name="birthday" type="text" placeholder="Ngày sinh"><br>
            <input class="form-control" required name="point" type="text" placeholder="Nhập Điểm"><br>
            <input class="btn btn-submit" type="submit" name="submit" value="Thêm điểm">
        </form>
    <?php } ?>
    
    <script type="text/javascript">
        
        function goBack() {
          window.history.back();
        }
    </script>
</div>