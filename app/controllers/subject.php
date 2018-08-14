<?php

class subject extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		session_start();
		$modelSubject =  $this->model('subjectModel');
		$result = $modelSubject->getListSubject();
		if($result['success']){
			
			// neu co du lieu tra ve
			$this->view('subject/subject-index',['data' => $result['data']]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('subject/subject-form',['resultMessage' => $result['message']]); 
		}
	}

	public function add(){
		session_start();
		$processSubject = $this->model('subjectModel');
		if (!empty($_POST['submit_add_subject'])) {
			$processSubject->subject_title = $_POST['subject_title'];
			$resultSubject = $processSubject->addSubjectStudent();
			if($resultSubject['success']){ 
				// gọi lại lấy list từ đây lấy list thành công thì đẩy ra list 
				$resultList = $processSubject->getListSubject();
				if($resultList['success']){
					$this->view('subject/subject-index', 
						['resultMessageAdd' => $resultSubject['message'], 'data' => $resultList['data']]);
				}
				else{
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('subject/subject-form',['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}
			}else{
				$this->view('subject/subject-form',['resultMessageAdd' => $resultSubject['message']]);
			}
		}
		else{ 
			$this->view('subject/subject-form');
		}
	}
	public function update(){
		session_start();
		// kiểm tra link gọi có id ko 	
		if(!empty($_GET['id'])){
			$processSubject = $this->model('subjectModel');
			$processSubject->id = $_GET['id'];
			if (!empty($_POST['submit_edit_subject'])) {
				// nếu có post thì xử lý update lại thông tin
				$processSubject->subject_title = $_POST['subject_title'];
				$resultSubject = $processSubject->editSubjectStudent();
				if($resultSubject['success']){
					// đây này gọi lại lấy list từ đây lấy list thành công thì đẩy ra list 
					$resultList = $processSubject->getListSubject();
					if($resultSubject['success']){
						$this->view('subject/subject-index', ['resultMessageAdd' => $resultSubject['message'], 'data' => $resultList['data']]);
					}else
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('subject/subject-form',['resultMessaqugeAdd' => 'Cập nhật thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}else{
					$this->view('subject/subject-form',['resultMessageAdd' => $resultSubject['message']]);
				}
			}else{
				// lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
				$subjectById = $processSubject->getSubjectById();				
				if($subjectById['success']){
					$this->view('subject/subject-form',['data' => $subjectById['data']]);
				}else{
					$this->view('subject/subject-index', ['resultMessageAdd' => 'Không tìm thấy lớp']);
				}
			}
		}else{
			// không có id thì báo lỗi
			$this->view('subject/subject-index', ['resultMessageAdd' => 'Không tìm thấy lớp']);
		}
		
	}
	public function delete(){
		session_start();
		$processSubject = $this->model('subjectModel');
		if(!empty($_POST['id'])){
			$processSubject->id = $_POST['id'];
			$resultDelete = $processSubject->deleteSubjectStudent();
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
				$data =  ['success' => false, 'message' => 'Không tìm thấy môn học!'];
				header('Content-Type: application/json');
				echo json_encode($data);
		}
	}
}

?>