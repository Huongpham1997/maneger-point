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
		$processClass = $this->model('ClassStudentModel');
		if (!empty($_POST['submit_class'])) {
            $processClass->class_name = $_POST['class_name'];
            $processClass->total_student = (int)$_POST['total_student'];
            $processClass->year = $_POST['year'];
            $processClass->name_teacher = $_POST['name_teacher'];
			$resultClass = $processClass->addClassStudent();
			if($resultClass['success']){
                $this->view('class-students/class-index', ['resultMessageAdd' => $resultClass['message']]);
            }else{
                $this->view('class-students/class-form',['resultMessageAdd' => $resultClass['message']]);
            }
		}
	}
}
?>