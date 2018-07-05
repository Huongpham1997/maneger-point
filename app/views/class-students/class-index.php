<?php
// Import file import.php
//
require_once '../app/views/home/menu.php';
?>
<a href="classStudent/addClass" class="btn btn-success">Thêm lớp mới</a>
<br>
<?php
if (!empty($data['resultMessageAdd'])) {
    echo $data['resultMessageAdd'];
} // chỗ này là đẩy ra data dc truyen tu controller
?>
<table class="table">
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên lớp</th>
        <th>Số học sinh</th>
        <th>Niên khóa</th>
        <th>Thầy/Cô chủ nhiệm</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    <p style="color: red">
        <?php
        if (!empty($data['resultMessage'])) {
            echo $data['resultMessage'];
        } // chỗ này là đẩy ra data dc truyen tu controller
        ?>
    </p>
    <?php
    if (!empty($data['data'])) {
        // echo "<pre>";print_r($data['data']);die();
        $i = 1;
        while ($row = $data['data']->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['class_name'] ?></td>
                <td><?= $row['total_student'] ?></td>
                <td><?= $row['year'] ?></td>
                <td><?= $row['name_teacher'] ?></td>
                <td>
                    <a href="#" onclick="updateSelected(<?= $row['ID'] ?>)"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" onclick="deleteSelected(<?= $row['ID'] ?>)"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
</body>
</html>