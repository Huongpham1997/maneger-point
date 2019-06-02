<?php

class managerPoint extends Controller 
{
	public function index(){
		$class_id = $_GET['class_id'];
		if(empty($class_id)){
			$this->view('home/error',['message' => 'Không tìm thấy lớp']);
		}
		// lấy loại điểm
		$modelPoint = $this->model('PointModel');
		$resultPoint = $modelPoint->getPointDropdownlist();
		//lấy loại môn
		$modelSubject = $this->model('subjectClassAsm');
		$resultSubject = $modelSubject->getSubjectDropdownlist();
		// lấy điểm của học sinh theo lớp
		$modelPointStudents = $this->model('StudentPointAsmModel');	
		$modelPointStudents->class_id = $class_id;
		$modelPointStudents->point_id = 0;
		$modelPointStudents->subject_id = 0;
		if(!empty($_POST['submit_search'])){
			// echo "<pre>";print_r($_POST);die;
			$modelPointStudents->point_id = $_POST['point_id'];
			$modelPointStudents->subject_id = $_POST['subject_id'];
			$modelPointStudents->test_time = $_POST['date_test'];
		}
		$result = $modelPointStudents->getListPointStudents();
		if($resultPoint['success']){
			if($result['success']){
			// nếu có dữ liệu trả về
				$this->view('point-students/point-students-index',[
					'data' => $result['data'],
					'dataPoint' => $resultPoint['data'],
					'dataSubject' => $resultSubject['data'],
					'test_time' => $modelPointStudents->test_time
				]);
			}
			else{
			// nếu không có dữ liệu trả về
				$this->view('point-students/point-students-index',[
					'resultMessage' => $result['message'],
					'dataPoint' => $resultPoint['data'],
					'dataSubject' => $resultSubject['data'],
					'test_time' => $modelPointStudents->test_time
				]);
			}
		}else{
			$this->view('home/error',['message' => 'Không lấy được điểm']);
		}
	}

	public function addPointStudents(){
		$class_id = $_GET['class_id'];
		if(empty($class_id)){
			$this->view('home/error',['message' => 'Không tìm thấy lớp']);
		}

		// lấy loại điểm
		$modelPoint = $this->model('PointModel');
		$resultPoint = $modelPoint->getPointDropdownlist();
		
		//lấy loại môn
		$modelSubject = $this->model('subjectClassAsm');
		$resultSubject = $modelSubject->getSubjectDropdownlist();

		if($resultPoint['success']){
			// lấy danh sách học sinh
			$modelStudents = $this->model('StudentModel');
			$modelStudents->class_id = $class_id;
			$resultStudents = $modelStudents->getListStudents();
			//print_r($resultStudents);die();
			if($resultStudents['success']){
				if(!empty($_POST['insert_point'])){

					$modelPointStudents =  $this->model('StudentPointAsmModel');
					$modelPointStudents->point_id = $_POST['point_id'];
					$modelPointStudents->subject_id = $_POST['subject_id'];
					$modelPointStudents->test_time = strtotime($_POST['date_test']);
					$modelPointStudents->frequency = $_POST['frequency'];
					$i = 0;
					while ($row = $resultStudents['data']->fetch_assoc()) {
						// die("a");
						$modelPointStudents->student_id = $row['id'];
						$modelPointStudents->point = $_POST['point_'.$row['id']];
						$resultInputPoint = $modelPointStudents->addPointStudent();
						if(!$resultInputPoint['success']){
							$this->view('home/error',["message" => $resultInputPoint['message']]);
						}
						$i++;
					}
					// lấy lại data học sinh và điểm ở đây 
					$studentPointAsmModel = $this->model('StudentPointAsmModel');
					$studentPointAsmModel->point_id = $_POST['point_id'];
					$studentPointAsmModel->subject_id = $_POST['subject_id'];
					$studentPointAsmModel->class_id = $class_id;
					$studentPointAsmModel->test_time = $_POST['date_test'];

					$dataStudenAfterAdd = $studentPointAsmModel->getListPointStudents();
					if($dataStudenAfterAdd['success']){
						$this->view('point-students/point-students-index',[
						'resultMessageAdd' => 'Thêm điểm thành công cho '.$i.' học sinh',
						'data' => $dataStudenAfterAdd['data'],
						'dataPoint' => $resultPoint['data'],
						'dataSubject' => $resultSubject['data']
						]);
					}else{
						$this->view('home/error',['message' => 'Thêm điểm thành công cho '.$i.' học sinh vui lòng kiểm tra lại ở xem điểm(Lỗi lấy data)'
						]);
					}
					
					// var_dump($this);die();
				}else{
					$this->view('point-students/point-students-form',[
						'data' => $resultStudents['data'],
						'dataPoint' => $resultPoint['data'],
						'dataSubject' => $resultSubject['data']
					]);
				}
				
			}else{
				$this->view('home/error',['message' => 'Lỗi hệ thống!']);
			}
		}else{
			$this->view('home/error',['message' => 'Không lấy được điểm']);
		}
	}
	public function update(){
		if(!empty($_GET['id'])){
			$modelPointStudents =  $this->model('StudentPointAsmModel');
			$modelPointStudents->id = $_GET['id'];
			if (!empty($_POST['insert_point'])) {
				$modelStudents = $this->model('StudentModel');
				$modelStudents->class_id = $_GET['class_id'];
				// nếu có post thì xử lý update lại thông tin
				$modelPointStudents->point_id = $_POST['point_id'];
				// print_r($_POST['point_id']);die();
				$modelPointStudents->student_id = $_POST['student_id'];
				$modelPointStudents->point = $_POST['point'];
				$modelPointStudents->test_time = $_POST['test_time'];
				$modelPointStudents->frequency = $_POST['frequency'];
				$resultPointStudents = $modelPointStudents->editPointStudents();
				if($resultPointStudents['success']){
					// gọi lấy list thành công thì đẩy ra list 
					$resultList = $modelPointStudents->getListPointStudents();
					if($resultList['success']){
						$this->view('point-students/point-students-index', ['resultMessageAdd' => $resultPointStudents['message'], 'data' => $resultList['data']]);
					}
					else
						// không lấy list thành công thì vẫn báo thêm thành công  
						$this->view('point-students/point-students-form', ['resultMessaqugeAdd' => 'Cập nhật thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}else{
					$this->view('point-students/point-students-form', ['resultMessageAdd' => $resultPointStudents['message']]);
				}
			}else{
				// lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
				$pointStudentById = $modelPointStudents->getPointStudentById();				
				if($pointStudentById['success']){
					$this->view('point-students/point-students-form',['data' => $pointStudentById['data']]);
				}else{
					$this->view('point-students/point-students-index', ['resultMessageAdd' => 'Không tìm thấy điểm của học sinh']);
				}
			}
		}else{
			// không có id thì báo lỗi
			$this->view('point-students/point-students-index', ['resultMessageAdd' => 'Không tìm thấy điểm của học sinh']);
		}
	}
	public function updatePointById(){
		session_start();
		if(!empty($_POST['id']) && !empty($_POST['point'])){
			$modelPointStudents =  $this->model('StudentPointAsmModel');
			$modelPointStudents->id = $_POST['id'];
			$modelPointStudents->point = $_POST['point'];
			$resultPointStudents = $modelPointStudents->edit();
			if($resultPointStudents['message']){
				echo $resultPointStudents['message'];
			} else {
				echo 'Lỗi hệ thống';
			}
		}else{
			echo 'Không tìm thấy thông tin';
		}
	}
	
	public function deletePointStudents(){
		$modelPointStudents =  $this->model('StudentPointAsmModel');
		if(!empty($_POST['id'])){
			$modelPointStudents->id = $_POST['id'];
			$resultDelete = $modelPointStudents->deletePointStudents();
			if($resultDelete['success']){
			// trả về theo kiểu json 
				$data = ['success' => true, 'message' => $resultDelete['message']];
				header('Content-Type: application/json');
				echo json_encode($data);
			}else {
				$data =  ['success' => false, 'message' => $resultDelete['message']];
				header('Content-Type: application/json');
				echo json_encode($data);
			}
		}else{
			$data =  ['success' => false, 'message' => 'Không tìm thấy điểm của học sinh!'];
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	//tính điểm trung bình học kì  của các học sinh trong lớp
	public function averageOfClassByStudent()
	{
		$modelviewPonit =  $this->model('ClassStudentModel');
		$modelPoint = $this->model('PointModel');
		$resultPoint = $modelPoint->getPointDropdownlist();
		
		//lấy loại môn
		$modelSubject = $this->model('subjectClassAsm');
		$resultSubject = $modelSubject->getSubjectDropdownlist();

		if(!empty($_POST['subject_id']) && !empty($_GET['class_id'])){
			$modelviewPonit->subject_id = $_POST['subject_id'];
			$modelviewPonit->class_id = $_GET['class_id'];
			$resultviewPonit = $modelviewPonit->processPoint();

			if($resultviewPonit['success']){
				// call back to get list average's students
				$modelPointStudents = $this->model('StudentPointAsmModel');	
				$modelPointStudents->class_id = $_GET['class_id'];
				$modelPointStudents->point_id = 6;
				$modelPointStudents->test_time = date("yyyy/mm/dd", time());
				$modelPointStudents->subject_id = $_POST['subject_id'];
				$result = $modelPointStudents->getListPointStudents();
				if($result['success']){
				// nếu có dữ liệu trả về
					$this->view('point-students/point-students-index',[
						'data' => $result['data'],
						'dataPoint' => $resultPoint['data'],
						'dataSubject' => $resultSubject['data'],
						'test_time' => $modelPointStudents->test_time,
						'resultMessageAdd' => $resultviewPonit['message']
					]);
				}
			}else {
				$data =  ['success' => false, 'message' => $resultviewPonit['message']];
			}
		}
		else{
			$data =  ['success' => false, 'message' => 'Không tìm thấy điểm của học sinh!'];
		}
	}
}
?>
