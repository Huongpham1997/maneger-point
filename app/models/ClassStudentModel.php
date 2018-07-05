<?php
class ClassStudentModel extends Controller {
    public $id;
    public $class_name;
    public $total_student;
    public $year;
    public $name_teacher;
    public $result;
    
    public function getListClass(){
    	$sql = "SELECT * FROM `class`";
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
    public function addClassStudent()
    {
        if(!is_int($total_student)){
                echo "<script>alert('Lỗi! Tổng số học sinh phải là kiểu số.');javascript:history.go(-1)</script>";
            }
        $sql1 = "INSERT INTO `class` (`class_name`='{$this->class_name}', `total_student`='{$this->total_student}', `year`='{$this->year}', `name_teacher`='{$this->name_teacher}') VALUES ('{$class_name}'='{$this->class_name}','{$total_student}'='{$this->total_student}','{$year}'='{$this->year}','{$name_teacher}'='{$this->name_teacher}')";
            // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if($con->query($sql1) === true){
            echo "<script>window.location.href ='class-index.php';alert('Thêm thành công.');</script>";
        } else {
            echo "Error: " . $sql1 . "<br>" . $con->error;die();
        }
    }
    public function editClassStudent()
    {

    }
    public function deleteClassStudent()
    {

    }
}
