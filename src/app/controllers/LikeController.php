<?php

class LikeController extends Controller implements ControllerInterface
{
    public function index()
    {
        
    }
    public function store()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $likeModel = $this->model('LikeModel');
                    $likeModel->store($_POST['user_id'], $_POST['object_id']);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function delete()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $likeModel = $this->model('LikeModel');
                    $likeModel->delete($_POST['user_id'],$_POST['like_id']);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}