<?php

class subjectClass extends AuthController
{
    public function index()
    {
        $class_id = $_GET['class_id'];
        if (empty($class_id)) {
            $this->view('subject-class-asm/subject-class-asm-index', ['resultMessage' => 'Không tìm thấy lớp']);
        }
        $modelSubjectClass = $this->model('subjectClassAsm');
        $modelSubjectClass->limit = !empty($_GET['limit']) ? $_GET['limit'] : 10;
        $modelSubjectClass->page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $modelSubjectClass->class_id = $class_id;
        $result = $modelSubjectClass->getListSubjectClass();
        if ($result['success']) {
            // nếu có dữ liệu trả về
            $this->view('subject-class-asm/subject-class-asm-index',
                ['data' => $result['data'],
                    'class_id' => $class_id,
                ]);
        } else {
            // nếu không có dữ liệu trả về
            $this->view('subject-class-asm/subject-class-asm-form',
                ['resultMessage' => $result['message'],
                    'class_id' => $class_id,
                ]);
        }
    }

    public function addSubjectClass()
    {
        $class_id = $_GET['class_id'];
        if (empty($class_id)) {
            $this->view('subject-class-asm/subject-class-asm-index', ['resultMessage' => 'Không tìm thấy lớp']);
        }

        //lấy tất cả các tên môn học
        $modelSubjectClassAsm = $this->model('subjectClassAsm');
        $modelSubjectClassAsm->class_id = $class_id;
        $resultSubjectClassAsm = $modelSubjectClassAsm->getSubjectDropdownlist();

        // lấy giáo viên
        $modelTeacher = $this->model('TeacherModel');
        $resultTeacher = $modelTeacher->getTeacherDropdownlist();

        if ($resultSubjectClassAsm['success']) {
            // lấy danh sách môn học có trong bảng
            $modelSubject = $this->model('subjectClassAsm');
            $modelSubject->class_id = $class_id;
            $modelSubject->limit = "all";
            $modelSubject->page = 0;
            $resultSubject = $modelSubject->getListSubjectClass();

            if ($resultSubject['success']) {

                if (!empty($_POST['submit_add_subject'])) {
                    $processSubjectClass = $this->model('subjectClassAsm');
                    $processSubjectClass->subject_id = $_POST['subject_id'];
                    $processSubjectClass->teacher_id = $_POST['teacher_id'];
                    $processSubjectClass->class_id = $class_id;
                    $processSubjectClass->limit = "all";
                    $processSubjectClass->page = 0;
                    $resultSubject = $processSubjectClass->addSubjectClass();
                    if ($resultSubject['success']) {
                        $result = $processSubjectClass->getListSubjectClass();
                        if ($result['success']) {
                            $this->view('subject-class-asm/subject-class-asm-index',
                                [
                                    'data' => $result['data'],
                                    'class_id' => $class_id,
                                    'resultMessageProcess' => $resultSubject['message'],
                                ]);
                        } else {
                            $this->view('home/error', ['message' => 'Đã thêm thành công môn học']);
                        }
                    } else {
                        $this->view('subject-class-asm/subject-class-asm-form', [
                            'dataTeacher' => $resultTeacher['data'],
                            'dataSubject' => $resultSubjectClassAsm['data'],
                            'resultMessageProcess' => $resultSubject['message']
                        ]);
                    }
                } else {
                    $this->view('subject-class-asm/subject-class-asm-form', [
                        'dataTeacher' => $resultTeacher['data'],
                        'dataSubject' => $resultSubjectClassAsm['data'],
                    ]);
                }

            } else {
                $this->view('home/error', ['message' => 'Lỗi hệ thống!']);
            }
        } else {
            $this->view('home/error', ['message' => 'Không lấy được môn học']);
        }
    }

    public function update()
    {
        $class_id = $_GET['class_id'];
        if (empty($class_id)) {
            $this->view('subject-class-asm/subject-class-asm-index', ['resultMessage' => 'Không tìm thấy lớp']);
        }

        // kiểm tra link gọi có id không ?
        if (!empty($_GET['id'])) {
            $processSubjectClass = $this->model('subjectClassAsm');
            $processSubjectClass->id = $_GET['id'];
            $processSubjectClass->class_id = $class_id;
            // var_dump($class_id);die();

            //lấy loại môn
            $modelSubjectClassAsm = $this->model('subjectClassAsm');
            $modelSubjectClassAsm->class_id = $class_id;
            $resultSubjectClassAsm = $modelSubjectClassAsm->getSubjecEditDropdownlist();

            // lấy giáo viên
            $modelTeacher = $this->model('TeacherModel');
            $resultTeacher = $modelTeacher->getTeacherDropdownlist();

            if (!empty($_POST['submit_edit_subject'])) {
                // nếu có post thì xử lý update lại thông tin
                $processSubjectClass->class_id = $class_id;
                $processSubjectClass->subject_id = $_POST['subject_id'];
                $processSubjectClass->teacher_id = $_POST['teacher_id'];
                // die('aaa');
                $resultSubject = $processSubjectClass->editSubjectClass();
                if ($resultSubject['success']) {
                    // gọi lại lấy list thành công thì đẩy ra list
                    $resultList = $processSubjectClass->getListSubjectClass();
                    $processSubjectClass->class_id = $class_id;
                    // var_dump($resultList);die();
                    if ($resultSubject['success']) {
                        $this->view('subject-class-asm/subject-class-asm-index', [
                            'resultMessageProcess' => $resultSubject['message'],
                            'data' => $resultList['data'],
                            'class_id' => $class_id,
                            'dataTeacher' => $resultTeacher['data'],
                            'dataSubject' => $resultSubjectClassAsm['data']
                        ]);
                    } else
                        // không lấy list thành công thì vẫn báo thêm thành công
                        $this->view('subject-class-asm/subject-class-asm-form', [
                            // 'resultMessageProcess' => $resultSubject['message'],
                            'dataTeacher' => $resultTeacher['data'],
                            'dataSubject' => $resultSubjectClassAsm['data']
                        ]);
                } else {
                    $this->view('subject-class-asm/subject-class-asm-form', [
                        'resultMessageProcess' => $resultSubject['message']
                    ]);
                }
            } else {
                // lấy record cần sửa rồi đẩy ra view nếu có truyền id nhưng chưa có post gì lên thì đẩy ra giá trị của record
                $subjectById = $processSubjectClass->getSubjectClassById();
                if ($subjectById['success']) {
                    $this->view('subject-class-asm/subject-class-asm-form', [
                        'data' => $subjectById['data'],
                        'dataTeacher' => $resultTeacher['data'],
                        'dataSubject' => $resultSubjectClassAsm['data']
                    ]);
                } else {
                    $this->view('subject-class-asm/subject-class-asm-index', [
                        'resultMessageProcess' => 'Không tìm thấy môn học!'
                    ]);
                }
            }
        } else {
            // không có id thì báo lỗi
            $this->view('subject-class-asm/subject-class-asm-index', ['resultMessageProcess' => 'Không tìm thấy môn học !!!']);
        }

    }

    public function delete()
    {
        $processSubjectClass = $this->model('subjectClassAsm');
        if (!empty($_POST['id'])) {
            $processSubjectClass->id = $_POST['id'];
            $resultDelete = $processSubjectClass->deleteSubjectClass();
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
            $data = ['success' => false, 'message' => 'Không tìm thấy môn học!'];
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}

?>