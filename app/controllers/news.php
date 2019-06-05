<?php


class news extends AuthController
{
    function createNew(){
        $model = $this->model('News');
        if(!empty($_POST['submit_create_news'])){
            $model->title = $_POST['title'];
            $model->short_description = $_POST['short_description'];
            $model->description = $_POST['description'];
            $model->description = $_POST['description'];
            $model->create_by = $_SESSION['user']['id'];
            $model->created_date = $_POST['created_date'];
            $model->status = 0;
            if (!empty($_FILES['image'])) {
                $imageModel = $this->model('FileUpload');
                $rsUpload = $imageModel->uploadImage('/../../public/statics/images/images_news/', $_FILES['image']);
                if (!$rsUpload['success']) {
                    $this->view('teacher/teacher-form', ['resultMessageProcess' => $rsUpload['message']]);
                }
                $model->image = $rsUpload['image'];
            }
            $rs = $model->save();
            if($rs['success']){
                $modelView = $this->model('TeacherModel');
                $modelView->id = $rs['id'];
                $resultView = $modelView->getTeacherById();
                if ($resultView['success']) {
                    $this->view('news/detail',[
                        'message' => $rs['message'],
                        'data' => $resultView
                    ]);
                } else {
                    $this->view('home/error', ['resultMessage' => $result['message']]);
                }

            }
        }
    }
}