<?php
class PointModel extends Controller {
    public $id;
    public $point_name;
    public $level;
    public $status;
}
public function getListPoint(){
    	$sql = "SELECT * FROM `point`";
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