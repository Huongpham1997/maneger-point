<?php


class FileUpload extends Controller
{
    function uploadImage($sourceSave, $file)
    {
        $fileName = $file['name'];
        if (empty($fileName)) {
            return ['success' => false, 'message' => 'Hình ảnh không được để trống'];
        }
        $ext = "jpg,jpeg,gif,bmp,png,JPEG,JPG,PNG";
        $m = explode(".", $fileName);
        $imgExt = $m[count($m) - 1];
        $extArray = explode(",", $ext);
        if (!in_array($imgExt, $extArray)) {
            print_r($imgExt);
            print_r($extArray);
            return ['success' => false, 'message' => 'Hình ảnh không hợp lệ các định dạng cho phép ' . $ext];
        }
        $new_name_file = time() . $_SESSION['user']['id'] . "." . $imgExt;
        move_uploaded_file($file['tmp_name'], __DIR__ . $sourceSave . $new_name_file);
        return ['success' => true, 'image' => $new_name_file];
    }
}