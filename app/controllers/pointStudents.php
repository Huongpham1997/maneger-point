<?php

class pointStudents extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		// session
		// die($_SESSION['user']);
		$modelClass =  $this->model('PointModel');
		$result = $modelClass->getListPoint();
		if($result['success']){
			// neu co du lieu tra ve
			$this->view('poitn-students/point-index',['data' => $result['data']]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('poitn-students/point-index',['resultMessage' => $result['message']]);
		}
	}
}
?>