<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 6/14/2018
 * Time: 2:02 PM
 */
include('../connect.php');
if (!empty($_POST['submit_class'])) {
    $class_name = $_POST['class_name'];
    $total_student = (int)$_POST['total_student'];
    $year = $_POST['year'];
    $name_teacher = $_POST['name_teacher'];

//    echo "<pre>";print_r($total_student);die();
    if(!is_int($total_student)){
        echo "<script>alert('Lỗi! Tổng số học sinh phải là kiểu số.');javascript:history.go(-1)</script>";
    }
    $sql1 = "INSERT INTO `class` (`class_name`, `total_student`, `year`, `name_teacher`) VALUES ('{$class_name}','{$total_student}','{$year}','{$name_teacher}')";

    if($con->query($sql1) === true){
        echo "<script>window.location.href ='class-index.php';alert('Thêm thành công.');</script>";
    } else {
        echo "Error: " . $sql1 . "<br>" . $con->error;die();
    }
}

if(!empty($_POST['submit_class_update'])) {
    $class_name = $_POST['class_name'];
    $total_student = (int)$_POST['total_student'];
    $year = $_POST['year'];
    $name_teacher = $_POST['name_teacher'];
    $ID = $_POST['id_class'];
    //var_dump($ID);die();

    if (!is_int($total_student)) {
        echo "<script>alert('Lỗi! Tổng số học sinh phải là kiểu số.');javascript:history.go(-1)</script>";
    }
    $sql1 = "UPDATE `class` SET `class_name`='{$class_name}',`total_student`='{$total_student}',`year`='{$year}',`name_teacher`= '{$name_teacher}' WHERE ID='{$ID}'";
    if ($con->query($sql1) === true) {
        echo " <script>window.location.href ='class-index.php';alert('Sửa thành công.');</script>";
    } else {
        echo "Error :" . $sql1 . "br" . $con->error;die();
    }

    // viết lệnh update ở đây  rồi xem giống ở bên insert bên trên 
}

