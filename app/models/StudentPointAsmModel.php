<?php
class StudentPointAsmModel extends Controller {
    public $id;
    public $class_id;
    public $point_id;
    public $subject_id;
    public $student_id;
    public $point;
    public $test_time;
    public $frequency;
    public $average;
    public $result;
    
    public function getListPointStudents(){
        $time_start = strtotime($this->test_time. '00:00:00');
        $time_end = strtotime($this->test_time.' 23:59:59');
    	$sql = "SELECT `student_point_asm`.`id`, `point`.`point_name`,`subject`.`subject_title`, `student`.`name_student`, `student_point_asm`.`point`,`student_point_asm`.`test_time`, `student_point_asm`.`frequency`
                FROM `student_point_asm`
                INNER JOIN `point` 
                ON `student_point_asm`.`point_id` = `point`.`id`
                INNER JOIN `subject` 
                ON `student_point_asm`.`subject_id` = `subject`.`id`
                INNER JOIN `student` 
                ON `student_point_asm`.`student_id` = `student`.`id`
                INNER JOIN `class_students`
                ON `student_point_asm`.`student_id` = `class_students`.`student_id`
                WHERE `student_point_asm`.`point_id` = $this->point_id 
                AND (`class_students`.`class_id` = $this->class_id
                AND  (`student_point_asm`.`test_time` BETWEEN $time_start AND $time_end)) ";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
        // trả kết quả cho controller
            return ['success' => true,'data' => $result];
        }
        else{
            return ['success'=>false, 'message' => "Chưa có dữ liệu"];
        }	
    }

    public function addPointStudent(){
        $sql = "INSERT INTO `student_point_asm` (`point_id`, `subject_id`, `student_id`, `point`, `test_time`, `frequency`) VALUES ('{$this->point_id}','{$this->subject_id}','{$this->student_id}','{$this->point}','{$this->test_time}','{$this->frequency}')";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm mới điểm cho học sinh thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
    
    public function edit()
    {
        $sql = "UPDATE `student_point_asm` SET `point`= '{$this->point}' WHERE id='{$this->id}'";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        
        if ($result === true) {
            return ['success' => true, 'message' => 'Cập nhật điểm cho học sinh thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
    public function getPointStudentById(){
        $sql = "SELECT * FROM `student_point_asm` WHERE `id`=".$this->id;
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
    public function deletePointStudents()
    {
        $sql = "DELETE FROM  `student_point_asm` WHERE  `id` = ".$this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Xóa điểm của học sinh thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
}