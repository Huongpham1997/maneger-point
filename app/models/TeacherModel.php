<?php
class TeacherModel extends Controller {
    public $id;
    public $nameteacher;
    public $position;
    public $class_teacher;
    public $sex;
    public $result;
    public function getListTeacher(){
    	$sql = "SELECT * FROM `teacher`";
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
    public function addTeacher(){
        $sql = "INSERT INTO `teacher` (`nameteacher`, `position`,,`class_teacher;` `sex`) VALUES ('{$this->nameteacher}','{$this->position}','{$this->class_teacher}','{$this->sex}')";
            // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm mới giáo viên thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
    public function editTeacher()
    {
        $sql = "UPDATE `teacher` SET `nameteacher`='{$this->nameteacher}',`position`='{$this->position}',`class_teacher`='{$this->class_teacher}',`sex`= '{$this->sex}' WHERE id='{$this->id}'";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Cập nhật giáo viên thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function getTeacherById(){
        $sql = "SELECT * FROM `teacher` WHERE `id`=".$this->id;
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
    public function deleteTeacher()
    {
        $sql = "DELETE FROM  `teacher` WHERE  `id` = ".$this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Xóa giáo viên thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
}
?>