<?php

class ClassStudentModel extends Controller
{
    public $id;
    public $class_name;
    public $student_id;
    public $subject_id;
    public $test_time;
    public $class_id;
    public $total_student;
    public $year;
    public $name_teacher;
    public $result;
    public $isNewRecord;
    public $point_id;

    public $page;
    public $limit;

    const ID_EXPAMLE = 6;

    public function getListClass()
    {
        $sql = "SELECT * FROM `class`";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        $conModel->limit = $this->limit;
        $conModel->page = $this->page;
        // thực hiện câu lệnh 
        $result = $conModel->getData($sql, $this->limit, $this->page);
        if (!empty($result->data)) {
            // trả kết quả cho controller
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Chưa có dữ liệu"];
        }
    }

    // ham lay diem cua hoc sinh de tinh diem theo lop
    public function getPointByClass()
    {
        $sql = "SELECT `student`.`name_student`,`student_point_asm`.`test_time`,`student_point_asm`.`point`,`point`.`point_name`
                FROM `student_point_asm`
                INNER JOIN `student`
                ON `student_point_asm`.`student_id` = `student`.`id`
                INNER JOIN `point`
                ON `student_point_asm`.`point_id` = `point`.`id`
                WHERE `student_point_asm`.`student_id` = `student`.`id`
                ";
        $conModel = $this->model('Connect');
        $conModel->limit = $this->limit;
        $conModel->page = $this->page;
        // thực hiện câu lệnh
        $result = $conModel->getData($sql);
        if ($result) {
            // trả kết quả cho controller
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Chưa có dữ liệu"];
        }
    }

    public function addClassStudent()
    {
        $sql = "INSERT INTO `class` (`class_name`, `total_student`, `year`, `name_teacher`) VALUES ('{$this->class_name}','{$this->total_student}','{$this->year}','{$this->name_teacher}')";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm lớp học thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function editClassStudent()
    {
        $sql = "UPDATE `class` SET `class_name`='{$this->class_name}',`total_student`='{$this->total_student}',`year`='{$this->year}',`name_teacher`= '{$this->name_teacher}' WHERE id='{$this->id}'";

        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);

        if ($result === true) {
            return ['success' => true, 'message' => 'Cập nhật lớp học thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function getClassById()
    {
        $sql = "SELECT * FROM `class` WHERE `id`=" . $this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function deleteClassStudent()
    {
        $sql = "DELETE FROM  `class` WHERE  `id` = " . $this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Xóa lớp học thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }

    }

    // hàm lấy id của 1 học sinh bất kì
    public function getIdStudent()
    {
        // die("a");
        $sql = "SELECT `id` FROM `student` LIMIT 1 ";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql);
        // print_r($result);die();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row['id'];
            }
        }
        return null;
    }

    //hàm lấy ra các loại điểm của một học sinh ("miệng, 15 phút, 45 phút và học kì")
    public function getPointId($id)
    {
        // die("a");
        $arrayPointsId = [];
        $sql1 = "SELECT `point_id` FROM `student_point_asm`
        WHERE `student_id` = " . $id;
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result1 = $conModel->getConnect($sql1);
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                //print_r($row);
                $arrayPointsId[] = $row['point_id'];
            }
        }
        return $arrayPointsId;
    }

    //hàm lấy ra giá trị laoji điểm bắt buộc có để tính điểm trung bình
    public function getIDFromPoint()
    {
        // die("a");
        $arrayIdFromPoint = [];
        $sql2 = " SELECT `id` FROM `point` 
           WHERE `type` = 1";
        //type bằng 1 là giá trị bắt buộc để tính điểm trung bình môn
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result2 = $conModel->getConnect($sql2);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $arrayIdFromPoint[] = $row['id'];
                // var_dump($arrayIdFromPoint);
            }
        }
        return $arrayIdFromPoint;
    }


    // hàm kiểm tra nếu học sinh đủ điểm thì sẽ tính điểm trung bình môn
    public function checkPointOfSubject()
    {
        //trường hợp không có học sinh
        $idStudent = $this->getIdStudent();
        if (empty($idStudent)) {
            return ['success' => false, 'message' => "Không tìm thấy học sinh"];
        }

        //trường hợp không lấy được loại điểm
        $pointIdFromStudent = $this->getPointId($idStudent);
        if (empty($pointIdFromStudent)) {
            return ['success' => false, 'message' => "Không đủ điểm"];
        }

        //trường hợp không đủ điểm 
        $idFromPoint = $this->getIDFromPoint();
        if (empty($idFromPoint)) {
            return ['success' => false, 'message' => "Học sinh chưa đủ điểm để tính điểm"];
        }
        foreach ($idFromPoint as $pointID) {
            if (!in_array($pointID, $pointIdFromStudent)) {
                return ['success' => false, 'message' => "Học sinh chưa đủ điểm để tính điểm"];
            }
        }

        // trường hợp tính điểm rồi
        $conModel = $this->model('Connect');
        $sql = "SELECT * FROM  `student_point_asm` where `student_id` = $idStudent AND `point_id` = 6 AND `subject_id` = " . $this->subject_id;
        $rs = $conModel->getConnect($sql);
        if ($rs === true) {
            return ['success' => false, 'message' => "Đã tính điểm trung bình xin kiểm tra lại"];
        }
    }
    //hàm lấy ra id của tất cả học sinh
    function startProcessAverage()
    {
        $sql = "SELECT `student_id` FROM `class_students`";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // lấy điểm của từng học sinh
                $this->getListPointByStudent($row['student_id']);
            }
            return ['success' => true, 'message' => "Tính điểm trung bình môn thành công! Vui lòng tải lại trang"];
        }
        return ['success' => false, 'message' => "Không tìm thấy học sinh tại lớp"];
    }

    //hàm lấy ra mức nhân và điểm sau đó tiến hành tính điểm trung bình môn cho học sinh
    function getListPointByStudent($studentId)
    {
        $arrPoint = [];
        $sql1 = "SELECT `point`.`level`,`student_point_asm`.`point`
                FROM `student_point_asm`
                INNER JOIN `point` 
                ON `student_point_asm`.`point_id` = `point`.`id`
                WHERE `student_point_asm`.`student_id` = " . $studentId . "
                AND `student_point_asm`.`subject_id` = $this->subject_id";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql1);
        if ($result->num_rows > 0) {
            $tb = 0;
            $lv = 0;
            while ($row = $result->fetch_assoc()) {
                $tb = $row['level'] * $row['point'] + $tb;
                $lv = $lv + $row['level'];
            }
            $average = $tb / $lv;
            $average = round($average, 1, PHP_ROUND_HALF_DOWN);
            $this->frequency = 1;

            //sql insert
            $sql = "INSERT  INTO `student_point_asm` (`point_id`,`subject_id`, `student_id` , `point`, `test_time`,`frequency`) VALUES (" . $this::ID_EXPAMLE . " ," . $this->subject_id . ", " . $studentId . " , '" . $average . "', " . time() . ", " . $this->frequency . ")";
            $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
            $poitn_insert = $conModel->getConnect($sql, true);
        }
        return ['success' => true, 'message' => "Tính điểm trung bình thành công"];
    }

    // hàm kiểm tra nếu học sinh đủ điểm thì sẽ tính điểm trung bình học kì
    public function processPoint()
    {
        $idStudent = $this->getIdStudent();
        if (empty($idStudent)) {
            return ['success' => false, 'message' => "Không tìm thấy học sinh"];
        }
        $pointIdFromStudent = $this->getPointId($idStudent);

        if (empty($pointIdFromStudent)) {
            return ['success' => false, 'message' => "Không đủ điểm"];
        }

        $idFromPoint = $this->getIDFromPoint();

        if (empty($idFromPoint)) {
            return ['success' => false, 'message' => "Học sinh chưa đủ điểm để tính điểm"];
        }
        foreach ($idFromPoint as $pointID) {
            if (!in_array($pointID, $pointIdFromStudent)) {
                return ['success' => false, 'message' => "Học sinh chưa đủ điểm để tính điểm"];
            }
        }

        return $this->getIdStudentOfSubjectPoint();
    }

    //hàm lấy ra id của tất cả học sinh
    function getIdStudentOfSubjectPoint()
    {
        $sql = "SELECT `student_id` FROM `class_students`";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->getListPointByStudentOfClassAndAverage($row['student_id']);
            }
            return ['success' => true, 'message' => "Tính điểm trung bình học kì thành công"];
        }
        return ['success' => false, 'message' => "Không tìm thấy học sinh tại lớp"];
    }

    //hàm lấy ra mức nhân và điểm sau đó tiến hành tính điểm trung bình học kì cho học sinh
    function getListPointByStudentOfClassAndAverage($studentId)
    {
        $arrPoint = [];
        $sql1 = "SELECT `point`.`level`,`student_point_asm`.`point`
                FROM `student_point_asm`
                INNER JOIN `point` 
                ON `student_point_asm`.`point_id` = `point`.`id`
                WHERE `student_point_asm`.`student_id` = " . $studentId . "
                AND `student_point_asm`.`subject_id` = $this->subject_id";
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql1);
        if ($result->num_rows > 0) {
            $tb = 0;
            $lv = 0;
            while ($row = $result->fetch_assoc()) {
                $tb = $row['level'] * $row['point'] + $tb;
                $lv = $lv + $row['level'];
            }
            $average = $tb / $lv;
            $average = round($average, 1, PHP_ROUND_HALF_DOWN);
            $this->frequency = 1;

            //sql insert
            $sql = "INSERT  INTO `student_point_asm` (`point_id`,`subject_id`, `student_id` , `point`, `test_time`,`frequency`) VALUES (" . $this::ID_EXPAMLE . " ," . $this->subject_id . ", " . $studentId . " , '" . $average . "', " . time() . ", " . $this->frequency . ")";
            // print_r($sql);die();
            $conModel = $this->model('Connect');
            // thực hiện câu lệnh 
            $poitn_insert = $conModel->getConnect($sql, true);
        }
    }
}

?>