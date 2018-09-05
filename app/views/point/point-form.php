<?php
// Import file import.php//
require_once '../app/extend/header.php';
require_once '../app/views/home/menu.php';
?>
<div class="container">
    <p style="color: red;text-align: center">
        <?php
        if (!empty($data['resultMessageAdd'])) {
            echo $data['resultMessageAdd'];
        } // đẩy ra data dc truyen tu controller
        ?>
    </p>
    <?php if(!empty($data['data'])){ 
        while ($row = $data['data']->fetch_assoc()) {
        ?>
        <form action="?url=point/update&id=<?= $row['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="point_name" type="text" placeholder="Tên loại điểm" value="<?= $row['point_name']?$row['point_name']:'' ?>"><br>
            <input class="form-control" required name="level" type="text" placeholder="Mức nhân" value="<?= $row['level']?$row['level']:'' ?>"><br>
            <input class="form-control" required name="statust" type="text" placeholder="Trạng thái" value="<?= $row['statust']?$row['statust']:'' ?>" ><br>
            <input class="btn btn-success" type="submit" name="submit_point" value="Cập nhật loại điểm">
        </form>
    <?php }}else{ ?>
        <form action="?url=point/addPoint" method="post">
            <input class="form-control" required name="point_name" type="text" placeholder="Tên loại điểm" value=""><br>
            <input class="form-control" required name="level" type="text" placeholder="Mức nhân"><br>
            <input class="form-control" required name="statust" type="text" placeholder="Trạng thái"><br>
            <input class="btn btn-success" type="submit" name="submit_point" value="Thêm mới loại điểm">
        </form>
    <?php } ?>
    
</div>