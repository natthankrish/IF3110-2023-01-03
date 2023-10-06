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
                    $likeModel->store($_SESSION['user_id'], $_POST['object_id']);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function isLiked()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $likeModel = $this->model('LikeModel');
                    $likeModel->isLiked($_SESSION['user_id'], $_GET['object_id']);
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
                    $likeModel->delete($_SESSION['user_id'],$_POST['object_id']);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function count()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $likeModel = $this->model('LikeModel');
                    $like = $likeModel->count($_SESSION['user_id'], $_GET['object_id']);

                    header('Content-Type: application/json');
                    echo json_encode(["like" => $like]);
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