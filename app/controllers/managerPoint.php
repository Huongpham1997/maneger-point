<?php

class managerPoint extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		session_start();
		$class_id = $_GET['class_id'];
		if(empty($class_id)){
			$this->view('home/error',['message' => 'Không tìm thấy lớp']);
		}
		// lay loai diem 
		$modelPoint = $this->model('PointModel');
		$resultPoint = $modelPoint->getPointDropdownlist();
		//lấy loại môn
		$modelSubject = $this->model('subjectModel');
		$resultSubject = $modelSubject->getSubjectDropdownlist();
		// lay diem cua hs theo lop
		$modelPointStudents = $this->model('StudentPointAsmModel');	
		$modelPointStudents->class_id = $class_id;
		$modelPointStudents->point_id = 0;
		$modelPointStudents->subject_id = 0;
		if(!empty($_POST['submit_search'])){
			$modelPointStudents->point_id = $_POST['point_id'];
			$modelPointStudents->subject_id = $_POST['subject_id'];
			$modelPointStudents->test_time = $_POST['date_test'];
		}
		$result = $modelPointStudents->getListPointStudents();
		if($resultPoint['success']){
			if($result['success']){
			// neu co du lieu tra ve
				$this->view('point-students/point-students-index',[
					'data' => $result['data'],
					'dataPoint' => $resultPoint['data'],
					'dataSubject' => $resultSubject['data'],
					'test_time' => $modelPointStudents->test_time
				]);
			}
			else{
			// Neu khong co du lieu tra ve 
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
		session_start();
		$class_id = $_GET['class_id'];
		if(empty($class_id)){
			$this->view('home/error',['message' => 'Không tìm thấy lớp']);
		}
		// lay loai diem 
		$modelPoint = $this->model('PointModel');
		$resultPoint = $modelPoint->getPointDropdownlist();
		//lấy loại môn
		$modelSubject = $this->model('subjectModel');
		$resultSubject = $modelSubject->getSubjectDropdownlist();
		if($resultPoint['success']){
			// lay danh sach hoc sinh 
			$modelStudents = $this->model('StudentModel');
			$modelStudents->class_id = $class_id;
			$resultStudents = $modelStudents->getListStudents();
			if($resultStudents['success']){
				if(!empty($_POST['insert_point'])){
					$modelPointStudents =  $this->model('StudentPointAsmModel');
					$modelPointStudents->point_id = $_POST['point_id'];
					$modelPointStudents->subject_id = $_POST['subject_id'];
					$modelPointStudents->test_time = strtotime($_POST['date_test']);
					$modelPointStudents->frequency = $_POST['frequency'];
					$i = 0;
					while ($row = $resultStudents['data']->fetch_assoc()) {
						$modelPointStudents->student_id = $row['id'];
						$modelPointStudents->point = $_POST['point_'.$row['id']];
						$resultInputPoint = $modelPointStudents->addPointStudent();
						if(!$resultInputPoint['success']){
							$this->view('home/error',['message' => 'Lỗi! Không thêm được học sinh ']);
						}
						$i++;
					}

					$this->view('point-students/point-students-index',['resultMessageAdd' => 'Thêm điểm thành công cho '.$i.' học sinh',
						'data' => $resultStudents['data'],
						'dataPoint' => $resultPoint['data'],
						'dataSubject' => $resultSubject['data']
					]);
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
		session_start();
		// $class_id = $_GET['class_id'];
		// if(empty($class_id)){
		// 	$this->view('home/error',['message' => 'Không tìm thấy lớp']);
		// }
		// lay loai diem 
		// $modelPoint = $this->model('PointModel');
		// $resultPoint = $modelPoint->getPointDropdownlist();
		// lấy học sinh theo lớp
		// $modelStudents = $this->model('StudentModel');
		// $modelStudents->class_id = $class_id;
		// $resultStudents = $modelStudents->getListStudents();
		// kiểm tra link gọi có id ko 	
		if(!empty($_GET['id'])){
			$modelPointStudents =  $this->model('StudentPointAsmModel');
			$modelPointStudents->id = $_GET['id'];
			if (!empty($_POST['insert_point'])) {
				$modelStudents = $this->model('StudentModel');
				$modelStudents->class_id = $class_id;
				// nếu có post thì xử lý update lại thông tin
				$modelPointStudents->point_id = $_POST['point_id'];
				$modelPointStudents->student_id = $_POST['student_id'];
				$modelPointStudents->point = $_POST['point'];
				$modelPointStudents->test_time = $_POST['test_time'];
				$modelPointStudents->frequency = $_POST['frequency'];
				$resultPointStudents = $modelPointStudents->editPointStudents();
				if($resultPointStudents['success']){
					$resultList = $modelPointStudents->getListPointStudents();
					if($resultList['success']){
						$this->view('point-students/point-students-index', ['resultMessageAdd' => $resultPointStudents['message'], 'data' => $resultList['data']]);
					}
					else
						// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
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
	//tính điểm trung bình
	// public function averagePointStudents(){
	// 	session_start();
	// 	if () {

	// 	}
	// }
	public function deletePointStudents(){
		session_start();
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
}
?>
