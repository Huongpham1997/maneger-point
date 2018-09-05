<?php
class TeacherModel extends Controller {
    public $id;
    public $name_teacher;
    public $ability;
    public $address;
    public $date_of_birth;
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
        $sql = "INSERT INTO `teacher` (`name_teacher`,`address`,`date_of_birth`, `ability`,`class_teacher`,`sex`) VALUES ('{$this->name_teacher}','{$this->address}','{$this->date_of_birth}','{$this->ability}','{$this->class_teacher}','{$this->sex}')";
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
        $sql = "UPDATE `teacher` SET `name_teacher`='{$this->name_teacher}',`address`='{$this->address}',`date_of_birth`='{$this->date_of_birth}',`ability`='{$this->ability}',`class_teacher`='{$this->class_teacher}',`sex`= '{$this->sex}' WHERE id='{$this->id}'";
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
    public function getTeacherDropdownlist(){
        $sql = "SELECT `id`,`name_teacher` FROM `teacher`";
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