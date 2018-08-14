<?php

class subjectModel extends Controller
{
    public $id;
    public $subject_title;
    public $result;
    public $isNewRecord;

    public function getListSubject()
    {
        $sql = "SELECT * FROM `subject`";
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

    public function addSubjectStudent()
    {
        $sql = "INSERT INTO `subject` (`subject_title`) VALUES ('{$this->subject_title}')";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm môn học thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function editSubjectStudent()
    {
        $sql = "UPDATE `subject` SET `subject_title`='{$this->subject_title}' WHERE id='{$this->id}'";

        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        
        if ($result === true) {
            return ['success' => true, 'message' => 'Cập nhật môn học thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function getSubjectDropdownlist(){
        $sql = "SELECT `id`,`subject_title` FROM `subject`";
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
    public function getSubjectById(){
        $sql = "SELECT * FROM `subject` WHERE `id`=".$this->id;
        // echo "<prev>";print_r("$sql");die();
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

    public function deleteSubjectStudent()
    {
        $sql = "DELETE FROM  `subject` WHERE  `id` = ".$this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Xóa môn học thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }

    }
}
?>