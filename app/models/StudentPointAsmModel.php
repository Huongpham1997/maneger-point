<?php
class StudentPointAsmModel extends Controller {
    public $id;
    public $point_name;
    public $name_student;
    public $point;
    public $test_time;
    public $frequency;
    public $average;
    public $result;
    public function getListPointStudents(){
    	$sql = "SELECT `student_point_asm`.`id`, `point`.`point_name`, `student`.`name_student`, `student_point_asm`.`point`,`student_point_asm`.`test_time`, `student_point_asm`.`frequency`
                FROM `student_point_asm`
                INNER JOIN `point` 
                ON `student_point_asm`.`id` = `point`.`id`
                INNER JOIN `student` 
                ON `student_point_asm`.`id` = `student`.`id`";
        // var_dump($sql); die();
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
        $sql = "INSERT INTO `student_point_asm` (`point_name`, `name_student`, `point`, `test_time`, `frequency`) VALUES ('{$this->point_name}','{$this->name_student}','{$this->point}','{$this->test_time}','{$this->frequency}')";
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
    public function editPointStudents()
    {
        $sql = "UPDATE `student_point_asm` SET `point_name`='{$this->point_name}',`name_student`='{$this->name_student}',`point`= '{$this->point}',`test_time`= '{$this->test_time}',`frequency`= '{$this->frequency}' WHERE id='{$this->id}'";
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