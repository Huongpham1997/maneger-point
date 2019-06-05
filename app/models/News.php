<?php

class News extends Controller
{
    public $id;
    public $title;
    public $title_asci;
    public $image;
    public $short_description;
    public $description;
    public $create_by;
    public $created_date;
    public $updated_date;
    public $approved_date;
    public $status;

    public function getListPoint()
    {
        $sql = "SELECT * FROM `point`";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            // trả kết quả cho controller
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Chưa có dữ liệu"];
        }
    }

    public function addPoint()
    {

        $sql = "INSERT INTO `point` (`point_name`, `level`, `statust`) VALUES ('{$this->point_name}','{$this->level}','{$this->statust}')";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm mới loại điểm thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function editPoint()
    {
        $sql = "UPDATE `point` SET `point_name`='{$this->point_name}',`level`='{$this->level}',`statust`= '{$this->statust}' WHERE id='{$this->id}'";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Cập nhật loại điểm thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function getPoinById()
    {
        $sql = "SELECT * FROM `point` WHERE `id`=" . $this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function getPointDropdownlist()
    {
        $sql = "SELECT `id`,`point_name` FROM `point`";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống !'];
        }
    }

    public function deletePoint()
    {
        $sql = "DELETE FROM  `point` WHERE  `id` = " . $this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Xóa loại điểm thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
}

?>