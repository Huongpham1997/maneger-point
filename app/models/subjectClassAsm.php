<?php

class subjectClassAsm extends Controller
{
    public $id;
    public $subject_id;
    public $teacher_id;
    public $result;
    public $class_id;
    public $isNewRecord;

    public function getListSubjectClass()
    {
        $sql = "SELECT  `subject_class_asm`.`id`,`subject`.`subject_title`,`teacher`.`name_teacher`
        FROM `subject_class_asm`
        INNER JOIN `subject`
        ON `subject`.`id` = `subject_class_asm`.`subject_id`
        INNER JOIN `teacher`
        ON `teacher`.`id` = `subject_class_asm`.`teacher_id`
        WHERE `subject_class_asm`.`class_id` = $this->class_id

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

    public function addSubjectClass()
    {
        $conModel = $this->model('Connect');
        $sql1 = "INSERT INTO `subject_class_asm` (`subject_id`, `teacher_id`, `class_id`) VALUES ('{$this->subject_id}', '{$this->teacher_id}','{$this->class_id}')";
        $result = $conModel->getConnect($sql1); 
        if ($result === true) {
           return ['success' => true, 'message' => 'Thêm mới môn học thành công!'];
       } else {
        return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function editSubjectClass()
    {
        $sql = "UPDATE `subject_class_asm` SET `subject_id`='{$this->subject_id}',`teacher_id`='{$this->teacher_id}',`class_id`='{$this->class_id}' WHERE id='{$this->id}'";

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
        // cách gọi vào model connect từ model
        $sql = "SELECT `id`,`subject_title` 
            FROM `subject` 
            WHERE `id` 
            NOT IN 
            (
                  SELECT `subject_id`
                    FROM `subject_class_asm`
                    WHERE `class_id` = '{$this->class_id}'
                )
            ";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống !'];
        }
    }
    public function getSubjecEditDropdownlist(){
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
    public function getSubjectClassById(){
        $sql = "SELECT * FROM `subject_class_asm` WHERE `id`=".$this->id;
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

    public function deleteSubjectClass()
    {
        $sql = "DELETE FROM  `subject_class_asm` WHERE  `id` = ".$this->id;
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