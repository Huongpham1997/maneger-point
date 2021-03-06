<?php

class teacher extends AuthController
{
    public function index()
    {
        $modelTeacher = $this->model('TeacherModel');
        // Get limit and size of page
        $modelTeacher->limit = !empty($_GET['limit']) ? $_GET['limit'] : 10;
        $modelTeacher->page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $result = $modelTeacher->getListTeacher();
        if ($result['success']) {
            // nếu có dữ liệu trả về lấy thêm đoạn html phân trang
            $this->view('teacher/teacher-index', ['data' => $result['data']]);
        } else {
            // nếu không có dữ liệu trả về
            $this->view('teacher/teacher-index', ['resultMessage' => $result['message']]);
        }
    }

    public function addTeacher()
    {
        $modelTeacher = $this->model('TeacherModel');
        if (!empty($_POST['submit_teacher'])) {
            $modelTeacher->name_teacher = $_POST['name_teacher'];
            $modelTeacher->address = $_POST['address'];
            $modelTeacher->date_of_birth = $_POST['date_of_birth'];
            $modelTeacher->ability = $_POST['ability'];
            $modelTeacher->class_teacher = $_POST['class_teacher'];
            $modelTeacher->sex = $_POST['sex'];
            $modelTeacher->username = $_POST['username'];
            $modelTeacher->password = $_POST['password'];
            if (!empty($_FILES['image_teacher'])) {
                $imageModel = $this->model('FileUpload');
                $rsUpload = $imageModel->uploadImage('/../../public/statics/images/images_teacher/', $_FILES['image_teacher']);
                if (!$rsUpload['success']) {
                    $this->view('teacher/teacher-form', ['resultMessageProcess' => $rsUpload['message']]);
                }
                $modelTeacher->image = $rsUpload['image'];
            }
            $resultTeacher = $modelTeacher->addTeacher();
            if ($resultTeacher['success']) {
                $model = $this->model('TeacherModel');
                $model->id = $resultTeacher['id'];
                $result = $model->getTeacherById();
                if ($result['success']) {
                    // nếu có dữ liệu trả về
                    $this->view('teacher/detail', ['data' => $result['data'], 'message' => $resultTeacher['message']]);
                } else {
                    // nếu không có dữ liệu trả về
                    $this->view('home/error', ['resultMessage' => $result['message']]);
                }
            } else {
                $this->view('teacher/teacher-form', ['resultMessageProcess' => $resultTeacher['message']]);
            }
        } else {
            $this->view('teacher/teacher-form');
        }
    }

    public function update()
    {
        // kiểm tra link gọi có id ko
        if (!empty($_GET['id'])) {
            $modelTeacher = $this->model('TeacherModel');
            $modelTeacher->id = $_GET['id'];
            $teacherOld = $modelTeacher->getTeacherById();
            if ($teacherOld['success']) {
                while ($row = $teacherOld['data']->fetch_assoc()) {
                    $old_image = $row['image'];
                }
            }
            if (!empty($_POST['submit_teacher'])) {
                // nếu có post thì xử lý update lại thông tin
                $modelTeacher->name_teacher = $_POST['name_teacher'];
                $modelTeacher->address = $_POST['address'];
                $modelTeacher->date_of_birth = $_POST['date_of_birth'];
                $modelTeacher->ability = $_POST['ability'];
                $modelTeacher->class_teacher = $_POST['class_teacher'];
                $modelTeacher->sex = $_POST['sex'];
                if (!empty($_FILES['image_teacher']['name'])) {
                    $imageModel = $this->model('FileUpload');
                    $rsUpload = $imageModel->uploadImage('/../../public/statics/images/images_teacher/', $_FILES['image_teacher']);
                    if (!$rsUpload['success']) {
                        $this->view('teacher/teacher-form', ['resultMessageProcess' => $rsUpload['message']]);
                    }
                    $modelTeacher->image = $rsUpload['image'];
                } else {
                    $modelTeacher->image = $old_image;
                }
                $resultTeacher = $modelTeacher->editTeacher();
                if ($resultTeacher['success']) {
                    $model = $this->model('TeacherModel');
                    $model->id = $_GET['id'];
                    $result = $model->getTeacherById();
                    if ($result['success']) {
                        // nếu có dữ liệu trả về
                        $this->view('teacher/detail', ['data' => $result['data'], 'message' => $resultTeacher['message']]);
                    } else {
                        // nếu không có dữ liệu trả về
                        $this->view('home/error', ['resultMessage' => $result['message']]);
                    }
                } else {
                    $this->view('teacher/teacher-form', ['resultMessageProcess' => $resultTeacher['message']]);
                }
            } else {
                // lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
                $TeacherById = $modelTeacher->getTeacherById();
                if ($TeacherById['success']) {
                    $this->view('teacher/teacher-form', ['data' => $TeacherById['data']]);
                } else {
                    $this->view('teacher/teacher-index', ['resultMessageProcess' => 'Không tìm thấy giáo viên']);
                }
            }
        } else {
            // không có id thì báo lỗi
            $this->view('teacher/teacher-index', ['resultMessageProcess' => 'Không tìm thấy giáo viên']);
        }

    }

    public function deleteTeacher()
    {
        $modelTeacher = $this->model('TeacherModel');
        if (!empty($_POST['id'])) {
            $modelTeacher->id = $_POST['id'];
            $resultDelete = $modelTeacher->deleteTeacher();
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

    public function detailTeacher()
    {
        $model = $this->model('TeacherModel');
        $model->id = $_GET['id'];
        $result = $model->getTeacherById();
        if ($result['success']) {
            // nếu có dữ liệu trả về
            $this->view('teacher/detail', ['data' => $result['data']]);
        } else {
            // nếu không có dữ liệu trả về
            $this->view('home/error', ['resultMessage' => $result['message']]);
        }
    }
}

?>