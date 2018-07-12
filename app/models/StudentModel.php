<?php
class StudentModel extends Controller {
    public $id;
    public $name_student;
    public $address;
    public $sex;
    public $birthday;
    public $status;
    public $parents;
    public function getListStudents(){
    	$sql = "SELECT * FROM `student`";
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
    public function addStudent(){
        $sql = "INSERT INTO `student` (`name_student`, `address`, `sex`, `birthday`, `status`, `parents`) VALUES ('{$this->name_student}','{$this->address}','{$this->sex}','{$this->birthday}','{$this->status}','{$this->parents}')";
            // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm mới học sinh thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
    public function editStudents()
    {
        $sql = "UPDATE `student` SET `name_student`='{$this->name_student}',`address`='{$this->address}',`sex`= '{$this->sex}',`birthday`= '{$this->birthday}',`status`= '{$this->status}',`parents`= '{$this->parents}' WHERE id='{$this->id}'";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Cập nhật học sinh thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function getStudentById(){
        $sql = "SELECT * FROM `student` WHERE `id`=".$this->id;
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
    public function deleteStudents()
    {
        $sql = "DELETE FROM  `student` WHERE  `id` = ".$this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Xóa học sinh thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
}
?>