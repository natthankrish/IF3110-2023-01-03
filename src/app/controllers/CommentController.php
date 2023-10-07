<?php

class CommentController extends Controller implements ControllerInterface
{
    public function index()
    {
        
    }
    public function store()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $commentModel = $this->model('CommentModel');
                    $commentModel->store($_SESSION['user_id'], $_POST['object_id'], $_POST['message']);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function getByIdObject()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $commentModel = $this->model('CommentModel');
                    $comments = $commentModel->getByIdObject($_SESSION['user_id'], $_GET['object_id']);

                    header('Content-Type: application/json');
                    echo json_encode(["comments" => $comments, "user_id" => $_SESSION['user_id']]);
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
                    $commentModel = $this->model('CommentModel');
                    $commentModel->delete($_SESSION['user_id'],$_POST['comment_id']);
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