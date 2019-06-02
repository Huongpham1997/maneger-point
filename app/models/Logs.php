<?php

class Logs extends Controller
{
    public $id;
    public $user_id;
    public $ip;
    public $action;
    public $description;
    public $created_date;

    public function addLog()
    {
        $sql = "INSERT INTO `logs` (`user_id`, `action`, `description`, `ip`, `created_date`) 
                VALUES ('{$this->user_id}','{$this->action}','{$this->description}','{$this->ip}','{$this->created_date}')";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => 'Thêm mới loại điểm thành công!'];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }
}

?>