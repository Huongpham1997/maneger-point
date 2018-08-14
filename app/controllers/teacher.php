<?php

class teacher extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		session_start();
		$modelTeacher =  $this->model('TeacherModel');
		$result = $modelTeacher->getListTeacher();
		if($result['success']){
			// neu co du lieu tra ve
			$this->view('teacher/teacher-index',['data' => $result['data']]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('teacher/teacher-index',['resultMessage' => $result['message']]);
		}
	}
	public function addTeacher(){
		session_start();
		$modelTeacher =  $this->model('TeacherModel');
		if (!empty($_POST['submit_teacher'])) {
			$modelTeacher->name_teacher = $_POST['name_teacher'];
			$modelTeacher->position = $_POST['position'];
			$modelTeacher->class_teacher = $_POST['class_teacher'];
			$modelTeacher->sex = $_POST['sex'];
			$resultTeacher = $modelTeacher->addTeacher();
			if($resultTeacher['success']){ // đã vào đến đây là thêm thành công 
				// đây này gọi lại lấy list từ đây lấy list thành công thì đẩy ra list 
				$resultList = $modelTeacher->getListTeacher();
				if($resultList['success']){
					$this->view('teacher/teacher-index', 
						['resultMessageAdd' => $resultTeacher['message'], 'data' => $resultList['data']]);
				}
				else{
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('teacher/teacher-form',['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}
			}else{
				$this->view('teacher/teacher-form',['resultMessageAdd' => $resultTeacher['message']]);
			}
		}
		else{ 
			$this->view('teacher/teacher-form');
		}
	}
	public function update(){
		session_start();
		// kiểm tra link gọi có id ko 	
		if(!empty($_GET['id'])){
			$modelTeacher =  $this->model('TeacherModel');
			$modelTeacher->id = $_GET['id'];
			if (!empty($_POST['submit_teacher'])) {
				// nếu có post thì xử lý update lại thông tin
				$modelTeacher->name_teacher = $_POST['name_teacher'];
				$modelTeacher->position = $_POST['position'];
				$modelTeacher->class_teacher = $_POST['class_teacher'];
				$modelTeacher->sex = $_POST['sex'];
				$resultTeacher = $modelTeacher->editTeacher();
				if($resultTeacher['success']){
					$resultList = $modelTeacher->getListTeacher();
					if($resultTeacher['success']){
						$this->view('teacher/teacher-index', ['resultMessageAdd' => $resultTeacher['message'], 'data' => $resultList['data']]);
					}
					else
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('class-students/class-form',['resultMessaqugeAdd' => 'Cập nhật thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}else{
					$this->view('teacher/teacher-form',['resultMessageAdd' => $resultTeacher['message']]);
				}
			}else{
				// lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
				$TeacherById = $modelTeacher->getTeacherById();				
				if($TeacherById['success']){
					$this->view('teacher/teacher-form',['data' => $TeacherById['data']]);
				}else{
					$this->view('teacher/teacher-index', ['resultMessageAdd' => 'Không tìm thấy giáo viên']);
				}
			}
		}else{
			// không có id thì báo lỗi
			$this->view('teacher/teacher-index', ['resultMessageAdd' => 'Không tìm thấy giáo viên']);
		}
		
	}
	public function deleteTeacher(){
		session_start();
		$modelTeacher =  $this->model('TeacherModel');
		if(!empty($_POST['id'])){
			$modelTeacher->id = $_POST['id'];
			$resultDelete = $modelTeacher->deleteTeacher();
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
				$data =  ['success' => false, 'message' => 'Không tìm thấy giáo viên!'];
				header('Content-Type: application/json');
				echo json_encode($data);
		}
	}
}
?>