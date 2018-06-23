<?php
/**
 * Created by PhpStorm.
 * User: TuanPV
 * Date: 6/14/2018
 * Time: 4:13 PM
 */
include ('../connect.php');
if($_POST['id']){
    $sql = "DELETE FROM  `class` WHERE  `ID` = ".$_POST['id'];
    if($con->query($sql) === true){
        echo 'Xóa thành công.';
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;die();
    }
}
