<?php

class subjectModel extends Controller
{
    public $id;
    public $subject_title;
    public $result;
    public $class_id;
    public $isNewRecord;

    public function getListSubject()
    {
        $sql = "SELECT  `subject`.* FROM `subject`
            INNER JOIN `subject_students`
            ON `subject`.`id` = `subject_students`.`subject_id` 
            WHERE `subject_students`.`class_id` = $this->class_id
        ";
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
        $subject_id_inserted = $conModel->getConnect($sql, true);
        if ($subject_id_inserted) {
            $sql1 = "INSERT INTO `subject_students` (`subject_id`, `class_id`) VALUES ($subject_id_inserted,'{$this->class_id}')";
            $result = $conModel->getConnect($sql1); 
            if ($result === true) {
                return ['success' => true, 'message' => 'Thêm mới môn học thành công!'];
            } else {
                return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
            }
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

    public function getSubjectModal(){
        $sql = "SELECT `subject_title` FROM `subject` WHERE `id`=".$this->id;
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