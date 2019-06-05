<?php
class TeacherModel extends Controller
{
    public $id;
    public $name_teacher;
    public $image;
    public $ability;
    public $address;
    public $date_of_birth;
    public $class_teacher;
    public $sex;
    public $username;
    public $password;
    public $result;

    public $page;
    public $limit;

    public function getListTeacher()
    {
        $sql = "SELECT * FROM `teacher`";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getData($sql, $this->limit, $this->page);
        if (!empty($result->data)) {
            // trả kết quả cho controller
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Chưa có dữ liệu"];
        }
    }

    public function addTeacher()
    {
        // validate username
        if (empty($this->username)) {
            return ['success' => false, 'message' => 'Tên đăng nhập không được để trông'];
        }
        $conModel = $this->model('Connect');

        // check username đã tồn tại
        $sqlCheckUserName = "SELECT * FROM `user` WHERE `username` = '{$this->username}'";

        $rsCheck = $conModel->getConnect($sqlCheckUserName);
        if ($rsCheck->num_rows > 0) {
            return ['success' => false, 'message' => 'Tên đăng nhập đã tồn tại'];
        }

        $sql = "INSERT INTO `teacher` (`name_teacher`,`address`,`date_of_birth`, `ability`,`class_teacher`,`sex`, `image`) VALUES ('{$this->name_teacher}','{$this->address}','{$this->date_of_birth}','{$this->ability}','{$this->class_teacher}','{$this->sex}','{$this->image}')";
        // cách gọi vào model connect từ model
        // thực hiện câu lệnh
        $teacherId = $conModel->getConnect($sql, true);
        if ($teacherId) {
            // add vào bảng user để đăng nhập
            $this->password = md5($this->password);
            $sqlInsertToUser = "INSERT INTO `user` (`username`, `password`, `fullName`, `teacher_id`, `role`) VALUES ('{$this->username}', '{$this->password}','{$this->name_teacher}', '{$teacherId}', " . Constant::ROLE_TEACHER . ")";
            $rs = $conModel->getConnect($sqlInsertToUser, true);
            if ($rs) {
                return ['success' => true, 'message' => 'Thêm mới giáo viên thành công!', 'id' => $teacherId];
            } else {
                return ['success' => false, 'message' => 'Lỗi hệ thống, Không tạo thành công tên đăng nhập!'];
            }
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function editTeacher()
    {
        $sql = "UPDATE `teacher` SET `name_teacher`='{$this->name_teacher}',`address`='{$this->address}',`date_of_birth`='{$this->date_of_birth}',`ability`='{$this->ability}',`class_teacher`='{$this->class_teacher}',`sex`= '{$this->sex}' WHERE id='{$this->id}'";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Cập nhật giáo viên thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function getTeacherById()
    {
        $sql = "SELECT * FROM `teacher` WHERE `id`=" . $this->id;
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

    public function getTeacherDropdownlist()
    {
        $sql = "SELECT `id`,`name_teacher` FROM `teacher`";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống !'];
        }
    }

    public function deleteTeacher()
    {
        $sql = "DELETE FROM  `teacher` WHERE  `id` = " . $this->id;
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Xóa giáo viên thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
}

?>