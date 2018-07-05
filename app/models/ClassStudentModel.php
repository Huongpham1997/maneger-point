<?php

class ClassStudentModel extends Controller
{
    public $id;
    public $class_name;
    public $total_student;
    public $year;
    public $name_teacher;
    public $result;

    public function getListClass()
    {
        $sql = "SELECT * FROM `class`";
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

    public function addClassStudent()
    {
        if (!is_int($this->total_student)) {
            return ['success' => false, 'message' => 'Tổng số học sinh phải là kiểu số, Vui lòng nhập lại!'];
        }
        // Kiểm tra lại sql
        $sql = "INSERT INTO `class` (
                    `class_name`='{$this->class_name}', 
                    `total_student`='{$this->total_student}', 
                    `year`='{$this->year}', 
                    `name_teacher`='{$this->name_teacher}')";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm lớp học thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function editClassStudent()
    {

    }

    public function deleteClassStudent()
    {

    }
}
