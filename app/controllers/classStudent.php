<?php

class classStudent extends Controller
	public function index(){
		session_start();
		$modelClass =  $this->model('ClassStudentModel');
		$result = $modelClass->getListClass();
		if($result['success']){
			// nếu có dữ liệu trả về
			$this->view('class-students/class-index',['data' => $result['data']]);
		}else{
			// nếu không có dữ liệu trả về
			$this->view('class-students/class-form',['resultMessage' => $result['message']]);
		}
	}

	public function addClass(){
		session_start();
		$processClass = $this->model('ClassStudentModel');
		if (!empty($_POST['submit_class'])) {
			$processClass->class_name = $_POST['class_name'];
			$processClass->total_student = $_POST['total_student'];
			$processClass->year = $_POST['year'];
			$processClass->name_teacher = $_POST['name_teacher'];
			$resultClass = $processClass->addClassStudent();
			if($resultClass['success']){
				// gọi lấy list thành công thì đẩy ra list 
				$resultList = $processClass->getListClass();
				if($resultList['success']){
					$this->view('class-students/class-index', 
						['resultMessageAdd' => $resultClass['message'], 'data' => $resultList['data']]);
				}
				else{
					// không lấy list thành công thì vẫn báo thêm thành công
					$this->view('class-students/class-form',['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}
			}else{
				$this->view('class-students/class-form',['resultMessageAdd' => $resultClass['message']]);
			}
		}
		else{ 
			$this->view('class-students/class-form');
		}
	}
	public function update(){
		session_start();
		// kiểm tra link gọi có id ko 	
		if(!empty($_GET['id'])){
			$processClass = $this->model('ClassStudentModel');
			$processClass->id = $_GET['id'];
			if (!empty($_POST['submit_edit_class'])) {
				// nếu có post thì xử lý update lại thông tin
				$processClass->class_name = $_POST['class_name'];
				$processClass->total_student = $_POST['total_student'];
				// var_dump($_POST['total_student']);die();
				$processClass->year = $_POST['year'];
				$processClass->name_teacher = $_POST['name_teacher'];
				$resultClass = $processClass->editClassStudent();
				if($resultClass['success']){
					// gọi lấy list thành công thì đẩy ra list 
					$resultList = $processClass->getListClass();
					if($resultClass['success']){
						$this->view('class-students/class-index', ['resultMessageAdd' => $resultClass['message'], 'data' => $resultList['data']]);
					}else
					// không lấy list thành công thì vẫn báo thêm thành công
					$this->view('class-students/class-form',['resultMessaqugeAdd' => 'Cập nhật thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}else{
					$this->view('class-students/class-form',['resultMessageAdd' => $resultClass['message']]);
				}
			}else{
				// lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
				$classStudentById = $processClass->getClassById();				
				if($classStudentById['success']){
					$this->view('class-students/class-form',['data' => $classStudentById['data']]);
				}else{
					$this->view('class-students/class-index', ['resultMessageAdd' => 'Không tìm thấy lớp']);
				}
			}
		}else{
			// không có id thì báo lỗi
			$this->view('class-students/class-index', ['resultMessageAdd' => 'Không tìm thấy lớp']);
		}
		
	}
	public function deleteClass(){
		session_start();
		$modelClass =  $this->model('ClassStudentModel');
		if(!empty($_POST['id'])){
			$modelClass->id = $_POST['id'];
			$resultDelete = $modelClass->deleteClassStudent();
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
				$data =  ['success' => false, 'message' => 'Không tìm thấy lớp!'];
				header('Content-Type: application/json');
				echo json_encode($data);
		}
	}
}

?>