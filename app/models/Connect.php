<?php

class Connect extends Controller
{
    public function getConnect($sql)
    {
        $con = mysqli_connect("localhost", "root", "");
        mysqli_select_db($con, "quanlidiem");
        mysqli_query($con, 'SET NAMES"UTF8"');

        if($sql){
            $result = $con->query($sql);
            return $result;
        }
        return null;
    }
}