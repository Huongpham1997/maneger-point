<?php

class managerClass extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		session_start();
		$modelClassStudents =  $this->model('ClassStudentsAsmModel');
		$modelPoint =  $this->model('PointModel');
		$modelClassStudents->point_id = 0;
		// $modelClassStudents->class_id = 0;
		// $modelClassStudents->student_id = 0;
		$result = $modelClassStudents->getListClassStudents();
		$resultPoint = $modelPoint->getPointDropdownlist();
		if(!$resultPoint['success']){
			$this->view('point-students/point-students-index',[
				'resultMessage' => 'Lỗi hệ thống'
				]);
		}else{
			if($result['success']){
			// neu co du lieu tra ve
				$this->view('point-students/point-students-index',[
					'data' => $result['data'],
					'dataPoint' => $resultPoint['data']
				]);
			}
			else{
			// Neu khong co du lieu tra ve 
				$this->view('point-students/point-students-index',[
					'resultMessage' => $result['message'],
					'dataPoint' => $resultPoint['data'],
					'test_time' => $modelClassStudents->test_time
				]);
			}
		}
	}
	public function addClassStudents(){
		session_start();
		$modelClassStudents =  $this->model('ClassStudentsAsmModel');
		if (!empty($_POST['submit_point_students'])) {
			$modelClassStudents->point_id = $_POST['point_id'];
			$modelClassStudents->student_id = $_POST['student_id'];
			$resultClassStudents = $modelClassStudents->addClassStudents();
			if($resultClassStudents['success']){ // đã vào đến đây là thêm thành công 
				// đây này gọi lại lấy list từ đây lấy list thành công thì đẩy ra list 
				$resultList = $modelClassStudents->getListClassStudents();
				if($resultList['success']){
					$this->view('point-students/point-students-index', 
						['resultMessageAdd' => $resultClassStudents['message'], 'data' => $resultList['data']]);
				}
				else{
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('point-students/point-students-form',['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}
			}else{
				$this->view('point-students/point-students-form',['resultMessageAdd' => $resultClassStudents['message']]);
			}
		}
		else{ 
			$this->view('point-students/point-students-form');
		}
	}
	public function deletePointStudents(){
		session_start();
		$modelClassStudents =  $this->model('ClassStudentsAsmModel');
		if(!empty($_POST['id'])){
			$modelClassStudents->id = $_POST['id'];
			$resultDelete = $modelClassStudents->deleteClassStudents();
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
