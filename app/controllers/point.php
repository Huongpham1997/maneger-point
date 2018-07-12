<?php
//

class point extends Controller // dat ten file the nao thi phai dat class nhu the 
{
	public function index(){
		session_start();
		$modelPoint =  $this->model('PointModel');
		$result = $modelPoint->getListPoint();
		if($result['success']){
			// neu co du lieu tra ve
			$this->view('poitn/point-index',['data' => $result['data']]);
		}else{
			// Neu khong co du lieu tra ve 
			$this->view('poitn/point-index',['resultMessage' => $result['message']]);
		}
	}
	public function addPoint(){
		session_start();
		$modelPoint =  $this->model('PointModel');
		if (!empty($_POST['submit_point'])) {
			$modelPoint->point_name = $_POST['point_name'];
			$modelPoint->level = $_POST['level'];
			$modelPoint->statust = $_POST['statust'];
			$resultPoint = $modelPoint->addPoint();
			if($resultPoint['success']){ // đã vào đến đây là thêm thành công 
				// đây này gọi lại lấy list từ đây lấy list thành công thì đẩy ra list 
				$resultList = $modelPoint->getListPoint();
				if($resultList['success']){
					$this->view('poitn/point-index', 
						['resultMessageAdd' => $resultPoint['message'], 'data' => $resultList['data']]);
				}
				else{
					// không lấy list thành công thì vẫn báo thêm thành công nhưng không lấy dc list thế thôi 
					$this->view('poitn/point-form',['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
				}
			}else{
				$this->view('poitn/point-form',['resultMessageAdd' => $resultPoint['message']]);
			}
		}
		else{ 
			$this->view('poitn/point-form');
		}
	}
	public function update(){
		session_start();
		// kiểm tra link gọi có id ko 	
		if(!empty($_GET['id'])){
			$modelPoint =  $this->model('PointModel');
			$modelPoint->id = $_GET['id'];
			if (!empty($_POST['submit_point'])) {
				// nếu có post thì xử lý update lại thông tin
				$modelPoint->point_name = $_POST['point_name'];
				$modelPoint->level = $_POST['level'];
				$modelPoint->statust = $_POST['statust'];
				$resultPoint = $modelPoint->editPoint();
				if($resultPoint['success']){
					$this->view('poitn/point-index', ['resultMessageAdd' => $resultPoint['message']]);
				}else{
					$this->view('poitn/point-form',['resultMessageAdd' => $resultPoint['message']]);
				}
			}else{
				// lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
				$PointById = $modelPoint->getPoinById();				
				if($PointById['success']){
					$this->view('poitn/point-form',['data' => $PointById['data']]);
				}else{
					$this->view('poitn/point-index', ['resultMessageAdd' => 'Không tìm thấy loại điểm']);
				}
			}
		}else{
			// không có id thì báo lỗi
			$this->view('poitn/point-index', ['resultMessageAdd' => 'Không tìm thấy loại điểm']);
		}
		
	}
	public function deletePoint(){
		session_start();
		$modelPoint =  $this->model('PointModel');
		if(!empty($_POST['id'])){
			$modelPoint->id = $_POST['id'];
			$resultDelete = $modelPoint->deletePoint();
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
				$data =  ['success' => false, 'message' => 'Không tìm thấy loại điểm!'];
				header('Content-Type: application/json');
				echo json_encode($data);
		}
	}
}
?>