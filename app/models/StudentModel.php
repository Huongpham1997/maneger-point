<?php
class StudentModel extends Controller {
    public $id;
    public $name_student;
    public $address;
    public $sex;
    public $birthday;
    public $status;
    public $parents;
}
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