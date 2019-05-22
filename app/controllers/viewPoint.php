<?php
class viewPoint extends Controller 
{
	public function index(){
		session_start();
		// die("aa");
		// var_dump("")
		$class_id = $_GET['class_id'];
		// print_r($class_id);die();
		if(empty($class_id)){
			$this->view('home/error',['message' => 'Không tìm thấy lớp']);
		}
		// die("aa");
		$student_id = !empty($_GET['student_id'])?$_GET['student_id']: 0;
		// print_r($student_id);die();
		if(empty($student_id)){
			$this->view('home/error',['message' => 'Không tìm thấy học sinh']);
		}
		$subject_id = 1;
		if (!empty($_POST['ViewPointByStudent'])){
			$subject_id = $_POST['subject_id'];
			// print_r($subject_id);die();
		}
		$modelviewPonit =  $this->model('viewPointStudentModel');
		$modelviewPonit->student_id = $student_id;
		$modelviewPonit->subject_id = $subject_id;
		$modelviewPonit->class_id = $class_id;
		$modelSubject = $this->model('subjectClassAsm');
		$resultSubject = $modelSubject->getSubjectDropdownlist();

		$result = $modelviewPonit->getListPointView();
		
		if($result['success']){
			// nếu có dữ liệu trả về
			$this->view('view-point-student/views-point-index',[
				'data' => $result['data'],
				'class_id' => $class_id,
				'dataSubject' => $resultSubject['data'],
				'student_id' => $student_id
			]);
		}else{
			// nếu không có dữ liệu trả về
			$this->view('view-point-student/views-point-index',[
				'resultMessage' => $result['message'],
				 'class_id' => $class_id,
				 'dataSubject' => $resultSubject['data'],
				'student_id' => $student_id
			]);
		}
	}
	public function showAvegare()
	{
		session_start();
		$modelviewPonit =  $this->model('viewPointStudentModel');

		// print_r($modelviewPonit);die();
		if(!empty($_GET['subjectId']) && !empty($_GET['classId'])){
			$modelviewPonit->subjectId = $_GET['subjectId'];
			$modelviewPonit->classId = $_GET['classId'];
			$resultviewPonit = $modelviewPonit->checkPoint();
			
			if($resultviewPonit['success']){
			// trả về theo kiểu json 
				$data = ['success' => true, 'message' => $resultviewPonit['message']];
				
			}else {
				$data =  ['success' => false, 'message' => $resultviewPonit['message']];
				
			}
		}
		else{
			// die("a");
			$data =  ['success' => false, 'message' => 'Không tìm thấy điểm của học sinh!'];
			
		}
		// if(!empty($_POST['subjectId']) && !empty($_POST['classId'])){

		// 	// $modelviewPonit->subjectId = $_POST['subjectId'];
		// 	// $modelviewPonit->classId = $_POST['classId'];
		// 	$resultviewPonit = $modelviewPonit->checkPoint();
			
		// 	if($resultviewPonit['success']){
		// 	// trả về theo kiểu json 
		// 		$data = ['success' => true, 'message' => $resultviewPonit['message']];
				
		// 	}else {
		// 		$data =  ['success' => false, 'message' => $resultviewPonit['message']];
				
		// 	}
		// }else{
		// 	$data =  ['success' => false, 'message' => 'Không tìm thấy điểm của học sinh!'];
			
		// }
	}
}
?>
