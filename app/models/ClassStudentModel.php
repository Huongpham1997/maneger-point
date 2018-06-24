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
    	$result = $con->query(sql);
    	if ($result->num_rows > 0) {
    		return $result;
    	}
    	else{
    		return $this->result="Chưa có dữ liệu";
    	}
    	
    }
}
