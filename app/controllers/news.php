<?php


class news extends AuthController
{
    function create()
    {
        $model = $this->model('NewsModel');
        if (!empty($_POST['submit_create_news'])) {
            $model->title = $_POST['title'];
            $model->short_description = $_POST['short_description'];
            $model->description = $_POST['description'];
            $model->create_by = $_SESSION['user']['id'];
            $model->created_date = time();
            $model->status = 0;
            if (!empty($_FILES['image'])) {
                $imageModel = $this->model('FileUpload');
                $rsUpload = $imageModel->uploadImage('/../../public/statics/images/images_news/', $_FILES['image']);
                if (!$rsUpload['success']) {
                    $this->view('home/form-new', ['resultMessageProcess' => $rsUpload['message']]);
                }
                $model->image = $rsUpload['image'];
            }
            $rs = $model->save();
            if ($rs['success']) {
                $modelView = $this->model('NewsModel');
                $modelView->id = $rs['id'];
                $resultView = $modelView->findNew();
                $resultRelated = $modelView->findRelated();
                if ($resultView['success']) {
                    $this->view('home/detail-new', [
                        'message' => $rs['message'],
                        'data' => $resultView['data'],
                        'dataRelated' => !empty($resultRelated['data']) ? $resultRelated['data'] : ''
                    ]);
                } else {
                    $this->view('home/error', ['resultMessage' => $rs['message']]);
                }
            }
        }
        $this->view('home/form-new');
    }

    function update()
    {
        if(empty($_GET['id'])){
            $this->view('home/error', ['message' => 'Không tìm thấy bài viết']);
        }
        $model = $this->model('NewsModel');
        $model->id = $_GET['id'];
        $model->create_by = $_SESSION['user']['id'];
        $rsNew = $model->findNew();
        if(!$rsNew['success']){
            $this->view('home/error', ['message' => 'Không tìm thấy bài viết']);
        }
        if (!empty($_POST['submit_create_news'])) {
            while ($row = $rsNew['data']->fetch_assoc()) {
                $old_image = $row['image'];
            }
            $model->title = $_POST['title'];
            $model->short_description = $_POST['short_description'];
            $model->description = $_POST['description'];
            $model->create_by = $_SESSION['user']['id'];
            $model->created_date = time();
            $model->status = 0;
            if (!empty($_FILES['image']['name'])) {
                $imageModel = $this->model('FileUpload');
                $rsUpload = $imageModel->uploadImage('/../../public/statics/images/images_news/', $_FILES['image']);
                if (!$rsUpload['success']) {
                    $this->view('home/form-new', ['resultMessageProcess' => $rsUpload['message']]);
                }
                $model->image = $rsUpload['image'];
            }else{
                $model->image = $old_image;
            }
            $rs = $model->update();
            if ($rs['success']) {
                $modelView = $this->model('NewsModel');
                $modelView->id = $_GET['id'];
                $resultView = $modelView->findNew();
                $resultRelated = $modelView->findRelated();
                if ($resultView['success']) {
                    $this->view('home/detail-new', [
                        'message' => $rs['message'],
                        'data' => $resultView['data'],
                        'dataRelated' => !empty($resultRelated['data']) ? $resultRelated['data'] : ''
                    ]);
                } else {
                    $this->view('home/error', ['message' => $rs['message']]);
                }
            }
            $this->view('home/error', ['message' => $rs['message']]);
        }
        $this->view('home/form-new', ['data' => $rsNew['data']]);
    }

    public function detail(){
        if(empty($_GET['id'])){
            $this->view('home/error', ['resultMessage' => "Không tìm thấy nội dung"]);
        }
        $model = $this->model('NewsModel');
        $model->id = $_GET['id'];
        $rsDetail = $model->findNew();
        $rsRelated = $model->findRelated();
        if(!$rsDetail['success']){
            $this->view('home/error', ['resultMessage' => "Không tìm thấy nội dung"]);
        }
        $this->view('home/detail-new', [
           'data' => $rsDetail['data'],
           'dataRelated' => !empty($rsRelated['data'])?$rsRelated['data']:''
        ]);
    }
}