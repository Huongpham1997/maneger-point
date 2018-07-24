<?php

class studentsPointAsm extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		session_start();
		$modelPointStudents =  $this->model('StudentPointAsmModel');
		$result = $modelPointStudents->getListPointStudents();
		if($result['success']){
			// neu co du lieu tra ve
			$this->view('point-students/point-students-index',['data' => $result['data']]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('point-students/point-students-index',['resultMessage' => $result['message']]);
		}
	}
	public function addPointStudents(){
		session_start();
		$modelPointStudents =  $this->model('StudentPointAsmModel');
		if (!empty($_POST['submit_point_students'])) {
			$modelPointStudents->point_name = $_POST['point_name'];
			$modelPointStudents->name_student = $_POST['name_student'];
			$modelPointStudents->point = $_POST['point'];
			$modelPointStudents->test_time = $_POST['test_time'];
			$modelPointStudents->frequency = $_POST['frequency'];
			$resultPointStudents = $modelPointStudents->addPointStudent();
			if($resultPointStudents['success']){ // đã vào đến đây là thêm thành công 
				// đây này gọi lại lấy list từ đây lấy list thành công thì đẩy ra list 
				$resultList = $modelPointStudents->getListPointStudents();
				if($resultList['success']){
					$this->view('point-students/point-students-index', 
						['resultMessageAdd' => $resultPointStudents['message'], 'data' => $resultList['data']]);
				}
				else{
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('point-students/point-students-form',['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}
			}else{
				$this->view('point-students/point-students-form',['resultMessageAdd' => $resultPointStudents['message']]);
			}
		}
		else{ 
			$this->view('point-students/point-students-form');
		}
	}
	public function update(){
		session_start();
		// kiểm tra link gọi có id ko 	
		if(!empty($_GET['id'])){
			$modelPointStudents =  $this->model('StudentPointAsmModel');
			$modelPointStudents->id = $_GET['id'];
			if (!empty($_POST['submit_point_students'])) {
				// nếu có post thì xử lý update lại thông tin
				$modelPointStudents->point_name = $_POST['point_name'];
				$modelPointStudents->name_student = $_POST['name_student'];
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