<?php

class NewsModel extends Controller
{
    public $id;
    public $title;
    public $title_asci;
    public $image;
    public $short_description;
    public $description;
    public $create_by;
    public $created_date;
    public $updated_date;
    public $approved_date;
    public $status;

    public $limit;
    public $page;

    public function findNews()
    {
        $sql = "SELECT * FROM `news`";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        $conModel->limit = $this->limit;
        $conModel->page = $this->page;
        $result = $conModel->getData($sql, $this->limit, $this->page);
        if (!empty($result)) {
            // trả kết quả cho controller
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Chưa có dữ liệu"];
        }
    }

    public function save()
    {
        $sql = "INSERT INTO `news` (`title`, `short_description`, `description`, `image`, `create_by`, `status`, `created_date`) 
		VALUES ('{$this->title}','{$this->short_description}','{$this->description}','{$this->image}','{$this->create_by}','{$this->status}','{$this->created_date}')";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh 
        $result = $conModel->getConnect($sql, true);
        if ($result) {
            return ['success' => true, 'message' => 'Thêm mới tin tức thành công!', 'id' => $result];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function update()
    {
        $sql = "UPDATE `news` SET `title` = '{$this->title}', `short_description` = '{$this->short_description}', 
`description` = '{$this->description}', `image` = '{$this->image}', `status` = '{$this->status}' WHERE `id` = '{$this->id}'";
        // cách gọi vào model connect từ model
        $conModel = $this->model('Connect');
        // thực hiện câu lệnh
        $result = $conModel->getConnect($sql);
        if ($result) {
            return ['success' => true, 'message' => 'Cập nhật tin tức thành công!', 'id' => $result];
        } else {
            return ['success' => false, 'message' => 'Lỗi hệ thống, Vui lòng nhập lại!'];
        }
    }

    public function findNew()
    {
        if ($this->create_by) {
            $sql = "SELECT * FROM `news` WHERE `id` = " . $this->id . " AND `create_by` = " . $this->create_by;
        } else {
            $sql = "SELECT * FROM `news` WHERE `id` = " . $this->id;
        }
        $conModel = $this->model('Connect');
        $result = $conModel->getConnect($sql);
        if (!empty($result)) {
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Lỗi không tìm thấy bản ghi"];
        }
    }

    public function findRelated()
    {
        if ($this->id) {
            $sql = "SELECT * FROM `news` WHERE `id` <> " . $this->id . " ORDER BY `id` limit 5";
        } else {
            $sql = "SELECT * FROM `news` ORDER BY `id` desc limit 5";
        }
        $conModel = $this->model('Connect');
        $result = $conModel->getConnect($sql);
        if ($result->num_rows > 0) {
            return ['success' => true, 'data' => $result];
        } else {
            return ['success' => false, 'message' => "Lỗi không tìm thấy bản ghi"];
        }
    }

    public function delete()
    {
        $sql = "DELETE `news` WHERE `id` = " . $this->id;
        $conModel = $this->model('Connect');
        $result = $conModel->getConnect($sql);
        if ($result === true) {
            return ['success' => true, 'message' => "Xóa tin thành công"];
        } else {
            return ['success' => false, 'message' => "Lỗi không tìm thấy bản ghi"];
        }
    }
}

?>