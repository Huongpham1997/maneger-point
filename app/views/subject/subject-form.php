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
        <form action="?url=managerSubject/update&id=<?= $row['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input class="form-control" required name="subject_title" type="text" placeholder="Tên môn học" value="<?= $row['subject_title']?$row['subject_title']:'' ?>"><br>
            <input class="btn btn-success" type="submit" name="submit_subject" value="Cập nhật môn học">
        </form>
    <?php }}else{ ?>
        <form action="?url=managerSubject/addSubject" method="post">
            <!-- <button onclick="goBack()" class="btn btn-success">Trở về</button><br><br> -->
            <input class="form-control" required name="subject_title" type="text" placeholder="Tên môn học"><br>
            <input class="btn btn-success" type="submit" name="submit_subject" value="Thêm mới môn học">
        </form>
    <?php } ?>
    
    <script type="text/javascript">
        function goBack() {
            window.history.Back();
        }
    </script>
</div>
<?php require_once '../app/extend/footer.php'; ?>