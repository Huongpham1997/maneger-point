<?php

class managerSubject extends AuthController
{
    public function index()
    {
        $modelSubject = $this->model('subjectModel');
        $result = $modelSubject->getListSubject();
        $modelSubject->limit = !empty($_GET['limit']) ? $_GET['limit'] : 10;
        $modelSubject->page = !empty($_GET['page']) ? $_GET['page'] : 1;
        if ($result['success']) {
            // nếu có dữ liệu trả về
            $this->view('subject/subject-index', ['data' => $result['data']]);
        } else {
            // nếu không có dữ liệu trả về
            $this->view('subject/subject-index', ['resultMessage' => $result['message']]);
        }
    }

    public function addSubject()
    {
        $modelSubject = $this->model('subjectModel');
        if (!empty($_POST['submit_subject'])) {
            $modelSubject->subject_title = $_POST['subject_title'];
            $resultSubject = $modelSubject->addSubject();
            if ($resultSubject['success']) {
                // gọi lấy list thành công thì đẩy ra list
                $resultList = $modelSubject->getListSubject();
                $modelStudents->limit = "all";
                if ($resultList['success']) {
                    $this->view('subject/subject-index',
                        ['resultMessageProcess' => $resultSubject['message'], 'data' => $resultList['data']]);
                } else {
                    // không lấy list thành công thì vẫn báo thêm thành công
                    $this->view('subject/subject-form', ['resultMessaqugeAdd' => 'Thêm thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
                }
            } else {
                $this->view('subject/subject-form', ['resultMessageProcess' => $resultSubject['message']]);
            }
        } else {
            $this->view('subject/subject-form');
        }
    }

    public function update()
    {
        // kiểm tra link gọi có id ko
        if (!empty($_GET['id'])) {
            $modelSubject = $this->model('subjectModel');
            $modelSubject->id = $_GET['id'];
            if (!empty($_POST['submit_subject'])) {
                // nếu có post thì xử lý update lại thông tin
                $modelSubject->subject_title = $_POST['subject_title'];
                $resultSubject = $modelSubject->editSubject();
                if ($resultSubject['success']) {
                    $resultList = $modelSubject->getListSubject();
                    // gọi lấy list thành công thì đẩy ra list
                    if ($resultSubject['success']) {
                        $this->view('subject/subject-index', ['resultMessageProcess' => $resultSubject['message'], 'data' => $resultList['data']]);
                    } else
                        // không lấy list thành công thì vẫn báo thêm thành công
                        $this->view('subject/subject-form', ['resultMessaqugeAdd' => 'Cập nhật thành công vui lòng chuyển sang trang danh sách để kiểm tra!']);
                } else {
                    $this->view('subject/subject-form', ['resultMessageProcess' => $resultSubject['message']]);
                }
            } else {
                // lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
                $SubjectById = $modelSubject->getSubjectById();
                if ($SubjectById['success']) {
                    $this->view('subject/subject-form', ['data' => $SubjectById['data']]);
                } else {
                    $this->view('subject/subject-index', ['resultMessageProcess' => 'Không tìm thấy môn học']);
                }
            }
        } else {
            // không có id thì báo lỗi
            $this->view('subject/subject-index', ['resultMessageProcess' => 'Không tìm thấy môn học']);
        }

    }

    public function deleteSubject()
    {
        $modelSubject = $this->model('subjectModel');
        if (!empty($_POST['id'])) {
            $modelSubject->id = $_POST['id'];
            $resultDelete = $modelSubject->deleteSubject();
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
            $data = ['success' => false, 'message' => 'Không tìm thấy giáo viên!'];
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}

?>