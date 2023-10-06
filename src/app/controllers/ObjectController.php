<?php

class ObjectController extends Controller implements ControllerInterface
{
    public function index()
    {
        
    }
    public function storeImage()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    
                    $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
                    $uploadedImage = $storageAccess->saveImage($_FILES['image']['tmp_name']);

                    $objectModel = $this->model('ObjectModel');
                    $objectModel->store($_SESSION['user_id'], $_POST['title'], $uploadedImage, NULL, date("Y-m-d", strtotime($_POST['date'])),  $_POST['location'], 'Photo');
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function storeVideo()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
                    $uploadedImage = $storageAccess->saveImage($_FILES['image']['tmp_name']);
                    $uploadVideo = $storageAccess->saveVideo($_POST['video']['tmp_name']);
                    
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->store($_POST['user_id'], $_POST['title'], $uploadedImage, $uploadVideo, $_POST['date'],  $_POST['location'], 'Photo');
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function updateIsPublic()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->updateIsPublic($_POST['user_id'], $_POST['object_id'], $_POST['isPublic']);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function updateNameOrDesc()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->updateNameOrDesc($_POST['user_id'], $_POST['object_id'], $_POST['text']);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function getByIdUser()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    $object = $objectModel->getByIdUser($_SESSION['user_id'], 12, 1);

                    header('Content-Type: application/json');
                    echo json_encode(["object" => $object]);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function getPublic()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->getPublic($_GET['user_id'], $_GET['perpage'], ($_GET['page']-1)*$_GET['perpage']);
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
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->delete($_SESSION['user_id'],$_POST['object_id']);
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