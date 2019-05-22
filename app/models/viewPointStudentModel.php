<?php
class viewPointStudentModel extends Controller {
    public $id;
    public $class_id;
    public $student_id;
    public $point_id;
    public $subject_id;
    public $point;
    public $subject_title;
    public $point_name;
    public $average;
    public $result;
    public function getListPointView(){
        // var_dump($this->student_id);die();
    	$sql = "SELECT `point`.`point_name`,`subject`.`subject_title`,`student_point_asm`.`point`
        FROM `student_point_asm`
        INNER JOIN `point` 
        ON `student_point_asm`.`point_id` = `point`.`id`
        INNER JOIN `subject` 
        ON `student_point_asm`.`subject_id` = `subject`.`id`
        INNER JOIN `class_students`
        ON  `class_students`.`student_id` = `student_point_asm`.`student_id`
        WHERE `student_point_asm`.`student_id` = $this->student_id
        AND `student_point_asm`.`subject_id` =$this->subject_id 
        AND `class_students`.`class_id` = $this->class_id
        ";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        // var_dump(expression)
        if ($result->num_rows > 0) {
            // trả kết quả cho controller
            return ['success' => true,'data' => $result];
        }
        else{
            return ['success'=>false, 'message' => "Chưa có dữ liệu"];
        }	
    }
    public function getIdStudent(){
        // die("a");
        $sql = "SELECT `id` FROM `student` LIMIT 1 ";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        // print_r($result);die();     
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row['id'];
            }
        }
        return null;
    }


    public function getPointId($id){
        // die("a");
        $arrayPointsId = [];
        $sql1 = "SELECT `point_id` FROM `student_point_asm`
        WHERE `student_id` = ".$id;
        $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
        $result1 = $conModel->getConnect($sql1);
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                //print_r($row);
                $arrayPointsId[] = $row['point_id'];
            }    
        }
        return $arrayPointsId;
    }

    public function getIDFromPoint(){
        // die("a");
        $arrayIdFromPoint = [];
        $sql2 = " SELECT `id` FROM `point` 
           WHERE `type` = 1";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result2 = $conModel->getConnect($sql2);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $arrayIdFromPoint[] = $row['id'];
                // var_dump($arrayIdFromPoint);
            }
        }
        return $arrayIdFromPoint;
    }


    public function checkPoint()
    {
        // die("a");
        $idStudent = $this->getIdStudent();
        if (empty($idStudent)){
            return ['success'=>false, 'message' => "Không tìm thấy học sinh"];
        }
        $pointID = $this->getPointId($idStudent);

        if (empty($pointID) ){
            return ['success'=>false, 'message' => "Không đủ điểm"];
        }
        
        $idFromPoint = $this->getIDFromPoint();
        if (empty($idFromPoint)) { 
            return ['success'=>false, 'message' => "Học sinh chưa đủ điểm để tính điểm"];
        }
        foreach ($idFromPoint as $pointID) {
            if (!in_array($pointID, $arrayPointsId)) {
                return ['success'=>false, 'message' => "Học sinh chưa đủ điểm để tính điểm"];
            }
        }

    } 
}

?>