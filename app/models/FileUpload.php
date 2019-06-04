<?php


class FileUpload extends Controller
{

    function uploadImage($sourceSave, $file)
    {
        print_r($file);
        $fileName = $file['name'];
        if (empty($fileName)) {
            return ['success' => false, 'message' => 'Hình ảnh không được để trống'];
        }
        $ext = "jpg,jpeg,gif,bmp,png,JPEG,JPG";
        $m = explode(".", $fileName);
        $imgExt = $m[count($m) - 1];
        $extArray = explode(",", $ext);
        if (!in_array($imgExt, $extArray)) {
            return ['success' => false, 'message' => 'Hình ảnh không hợp lệ các định dạng cho phép ' . $ext];
        }
        move_uploaded_file($file['tmp_name'], __DIR__ . $sourceSave);
        return ['success' => true, 'image' => time() . $_SESSION['user']['id'] . $imgExt];
    }

}