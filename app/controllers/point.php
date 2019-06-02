<?php

class point extends AuthController
{
    public function index()
    {
        $modelPoint = $this->model('PointModel');
        $result = $modelPoint->getListPoint();
        if ($result['success']) {
            // nếu có dữ liệu trả về
            $this->view('poitn/point-index', ['data' => $result['data']]);
        } else {
            // nếu không có dữ liệu trả về
            $this->view('poitn/point-index', ['resultMessage' => $result['message']]);
        }
    }

    public function addPoint()
    {
        $modelPoint = $this->model('PointModel');
        if (!empty($_POST['submit_point'])) {
            $modelPoint->point_name = $_POST['point_name'];
            $modelPoint->level = $_POST['level'];
            $modelPoint->statust = $_POST['statust'];
            $resultPoint = $modelPoint->addPoint();
            if ($resultPoint['success']) {
                // gọi lấy list thành công thì đẩy ra list
                $resultList = $modelPoint->getListPoint();
                if ($resultList['success']) {
                    $this->view('poitn/point-index',
                        ['resultMessageAdd' => $resultPoint['message'], 'data' => $resultList['data']]);
                } else {
                    // không lấy list thành công thì vẫn báo thêm thành công
                    $this->view('poitn/point-form', ['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
                }
            } else {
                $this->view('poitn/point-form', ['resultMessageAdd' => $resultPoint['message']]);
            }
        } else {
            $this->view('poitn/point-form');
        }
    }

    public function update()
    {
        // kiểm tra link gọi có id ko
        if (!empty($_GET['id'])) {
            $modelPoint = $this->model('PointModel');
            $modelPoint->id = $_GET['id'];
            if (!empty($_POST['submit_point'])) {
                // nếu có post thì xử lý update lại thông tin
                $modelPoint->point_name = $_POST['point_name'];
                $modelPoint->level = $_POST['level'];
                $modelPoint->statust = $_POST['statust'];
                $resultPoint = $modelPoint->editPoint();
                if ($resultPoint['success']) {
                    $this->view('poitn/point-index', ['resultMessageAdd' => $resultPoint['message']]);
                } else {
                    $this->view('poitn/point-form', ['resultMessageAdd' => $resultPoint['message']]);
                }
            } else {
                // lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
                $PointById = $modelPoint->getPoinById();
                if ($PointById['success']) {
                    $this->view('poitn/point-form', ['data' => $PointById['data']]);
                } else {
                    $this->view('poitn/point-index', ['resultMessageAdd' => 'Không tìm thấy loại điểm']);
                }
            }
        } else {
            // không có id thì báo lỗi
            $this->view('poitn/point-index', ['resultMessageAdd' => 'Không tìm thấy loại điểm']);
        }

    }

    public function deletePoint()
    {
        $modelPoint = $this->model('PointModel');
        if (!empty($_POST['id'])) {
            $modelPoint->id = $_POST['id'];
            $resultDelete = $modelPoint->deletePoint();
            if ($resultDelete['success']) {
                // trả về theo kiểu json
                $data = ['success' => true, 'message' => $resultDelete['message']];
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                $data = ['success' => false, 'message' => $resultDelete['message']];
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        } else {
            $data = ['success' => false, 'message' => 'Không tìm thấy loại điểm!'];
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}

?>