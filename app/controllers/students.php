<?php

class students extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		session_start();
		$class_id = $_GET['class_id'];
		if(empty($class_id)){
			$this->view('students/students-index',['resultMessage' => 'Không tìm thấy lớp']);
		}
		$modelStudents =  $this->model('StudentModel');
		$modelStudents->class_id =  $class_id;
		$result = $modelStudents->getListStudents();
		if($result['success']){
			// neu co du lieu tra ve
			$this->view('students/students-index',[
				'data' => $result['data'],
				'class_id' => $class_id,
			]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('students/students-index',[
				'resultMessage' => $result['message'],
				'class_id' => $class_id,
			]);
		}
	}
	public function addStudents(){
		session_start();
		$class_id = $_GET['class_id'];
		if(empty($class_id)){
			$this->view('students/students-index',['resultMessage' => 'Không tìm thấy lớp']);
		}
		$modelStudents =  $this->model('StudentModel');
		if (!empty($_POST['submit_students'])) {
			$modelStudents->name_student = $_POST['name_student'];
			$modelStudents->address = $_POST['address'];
			$modelStudents->sex = $_POST['sex'];
			$modelStudents->birthday = $_POST['birthday'];
			$modelStudents->status = $_POST['status'];
			$modelStudents->class_id = $class_id;
			$modelStudents->parents = $_POST['parents'];
			$resultStudents = $modelStudents->addStudent();
			if($resultStudents['success']){ // đã vào đến đây là thêm thành công 
				// đây này gọi lại lấy list từ đây lấy list thành công thì đẩy ra list 
				$resultList = $modelStudents->getListStudents();
				if($resultList['success']){
					$this->view('students/students-index', 
						['resultMessageAdd' => $resultStudents['message'], 'data' => $resultList['data']]);
				}
				else{
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('students/students-form',[
						'resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!',
						'class_id' => $class_id
					]);
				}
			}else{
				$this->view('students/students-form',[
					'resultMessageAdd' => $resultStudents['message'],
					'class_id' => $class_id
				]);
			}
		}
		else{ 
			$this->view('students/students-form',['class_id' => $class_id]);
		}
	}
	public function update(){
		session_start();
		// kiểm tra link gọi có id ko
		$class_id = $_GET['class_id'];
		if(empty($class_id)){
			$this->view('students/students-index',['resultMessage' => 'Không tìm thấy lớp']);
		}
		if(!empty($_GET['id'])){
			$modelStudents =  $this->model('StudentModel');
			$modelStudents->id = $_GET['id'];
			if (!empty($_POST['submit_students'])) {
				// nếu có post thì xử lý update lại thông tin
				$modelStudents->name_student = $_POST['name_student'];
				$modelStudents->address = $_POST['address'];
				$modelStudents->sex = $_POST['sex'];
				$modelStudents->birthday = $_POST['birthday'];
				$modelStudents->status = $_POST['status'];
				$modelStudents->parents = $_POST['parents'];
				$resultStudents = $modelStudents->editStudents();
				if($resultStudents['success']){
					$modelStudents->class_id = $class_id;
					$resultList = $modelStudents->getListStudents();
					if($resultList['success']){
						$this->view('students/students-index', ['resultMessageAdd' => $resultStudents['message'], 'data' => $resultList['data']]);
					}
					else{
						// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
						// die('khong lay dc data');
						$this->view('students/students-form', ['resultMessaqugeAdd' => 'Cập nhật thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
					}
				}else{
					$this->view('students/students-form', ['resultMessageAdd' => $resultStudents['message']]);
				}
			}else{
				// lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
				$StudentById = $modelStudents->getStudentById();				
				if($StudentById['success']){
					$this->view('students/students-form',['data' => $StudentById['data']]);
				}else{
					$this->view('students/students-index', ['resultMessageAdd' => 'Không tìm thấy học sinh']);
				}
			}
		}else{
			// không có id thì báo lỗi
			$this->view('students/students-index', ['resultMessageAdd' => 'Không tìm thấy học sinh']);
		}

	}
	public function deleteStudents(){
		session_start();
		$modelStudents =  $this->model('StudentModel');
		if(!empty($_POST['id'])){
			$modelStudents->id = $_POST['id'];
			$resultDelete = $modelStudents->deleteStudents();
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
			$data =  ['success' => false, 'message' => 'Không tìm thấy học sinh!'];
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
}
?>