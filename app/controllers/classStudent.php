<?php
//
class classStudent extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		// session
		// die($_SESSION['user']);
		$modelClass =  $this->model('ClassStudentModel');
		$result = $modelClass->getListClass();
		if($result['success']){
			// neu co du lieu tra ve
			$this->view('class-students/class-index',['data' => $result['data']]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('class-students/class-index',['resultMessage' => $result['message']]);
		}
	}

	public function addClass(){
		$processclass = $this->model('ClassStudentModel');
		if (!empty($_POST['submit_class'])) {
			$processclass->class_name = $_POST['class_name'];
			$processclass->total_student = (int)$_POST['total_student'];
			$processclass->year = $_POST['year'];
			$processclass->name_teacher = $_POST['name_teacher'];
			$resultClass = $processclass->addClassStudent();
			$this->view('class-students/class-form', ['data' => $result['data']]);     
		}
	}
}
?>