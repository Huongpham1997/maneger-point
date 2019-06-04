<?php

class viewPoint extends AuthController
{
    public function index()
    {
        $class_id = $_GET['class_id'];
        if (empty($class_id)) {
            $this->view('home/error', ['message' => 'Không tìm thấy lớp']);
        }
        $student_id = !empty($_GET['student_id']) ? $_GET['student_id'] : 0;
        if (empty($student_id)) {
            $this->view('home/error', ['message' => 'Không tìm thấy học sinh']);
        }
        $subject_id = 1;
        if (!empty($_POST['ViewPointByStudent'])) {
            $subject_id = $_POST['subject_id'];
        }
        $modelviewPonit = $this->model('viewPointStudentModel');
        $modelviewPonit->student_id = $student_id;
        $modelviewPonit->subject_id = $subject_id;
        $modelviewPonit->class_id = $class_id;
        $modelSubject = $this->model('subjectClassAsm');
        $modelviewPonit->limit = !empty($_GET['limit']) ? $_GET['limit'] : 10;
        $modelviewPonit->page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $resultSubject = $modelSubject->getSubjectDropdownlist();

        $result = $modelviewPonit->getListPointView();

        if ($result['success']) {
            // nếu có dữ liệu trả về
            $this->view('point-students/views-point-index', [
                'data' => $result['data'],
                'class_id' => $class_id,
                'dataSubject' => $resultSubject['data'],
                'student_id' => $student_id
            ]);
        } else {
            // nếu không có dữ liệu trả về
            $this->view('point-students/views-point-index', [
                'resultMessage' => $result['message'],
                'class_id' => $class_id,
                'dataSubject' => $resultSubject['data'],
                'student_id' => $student_id
            ]);
        }
    }

    public function showAvegare()
    {
        $modelviewPonit = $this->model('viewPointStudentModel');

        if (!empty($_GET['subjectId']) && !empty($_GET['classId'])) {
            $modelviewPonit->subjectId = $_GET['subjectId'];
            $modelviewPonit->classId = $_GET['classId'];
            $resultviewPonit = $modelviewPonit->checkPoint();

            if ($resultviewPonit['success']) {
                // trả về theo kiểu json
                $data = ['success' => true, 'message' => $resultviewPonit['message']];

            } else {
                $data = ['success' => false, 'message' => $resultviewPonit['message']];

            }
        } else {
            $data = ['success' => false, 'message' => 'Không tìm thấy điểm của học sinh!'];
        }
        // if(!empty($_POST['subjectId']) && !empty($_POST['classId'])){

        // 	// $modelviewPonit->subjectId = $_POST['subjectId'];
        // 	// $modelviewPonit->classId = $_POST['classId'];
        // 	$resultviewPonit = $modelviewPonit->checkPoint();

        // 	if($resultviewPonit['success']){
        // 	// trả về theo kiểu json
        // 		$data = ['success' => true, 'message' => $resultviewPonit['message']];

        // 	}else {
        // 		$data =  ['success' => false, 'message' => $resultviewPonit['message']];

        // 	}
        // }else{
        // 	$data =  ['success' => false, 'message' => 'Không tìm thấy điểm của học sinh!'];

        // }
    }
}

?>
