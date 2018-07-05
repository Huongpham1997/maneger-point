<?php

class students extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		// session
		// die($_SESSION['user']);
		$modelClass =  $this->model('StudentModel');
		$result = $modelClass->getListStudents();
		if($result['success']){
			// neu co du lieu tra ve
			$this->view('students/students-index',['data' => $result['data']]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('students/students-index',['resultMessage' => $result['message']]);
		}
	}
}
?>