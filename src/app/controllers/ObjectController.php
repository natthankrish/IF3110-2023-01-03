<?php

class ObjectController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $notFoundView = $this->view('home', 'PageNotFoundView');
                    $notFoundView->render();
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
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
                    $storageAccess = new StorageAccess(StorageAccess::VIDEO_PATH);
                    // $uploadedImage = $storageAccess->saveImage($_FILES['image']['tmp_name']);
                    $uploadedImage = '0c05322d7285c39b9390374ca02908ac.jpeg';
                    $uploadedVideo = $storageAccess->saveVideo($_FILES['video']['tmp_name']);
                    
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->store($_SESSION['user_id'], $_POST['title'], $uploadedImage, $uploadedVideo, date("Y-m-d", strtotime($_POST['date'])),  $_POST['location'], 'Video');
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
                    $objectModel->updateIsPublic($_SESSION['user_id'], $_POST['object_id'], $_POST['isPublic']);
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
                    $objectModel->updateNameOrDesc($_SESSION['user_id'], $_POST['object_id'], $_POST['text']);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function updateName()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->updateName($_SESSION['user_id'], $_POST['object_id'], $_POST['text']);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function updateDesc()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->updateDesc($_SESSION['user_id'], $_POST['object_id'], $_POST['text']);
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
                    $object = $objectModel->getByIdUser($_SESSION['user_id'], 12, 0);

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
                    // $objectModel->getPublic($_GET['user_id'], $_GET['perpage'], ($_GET['page']-1)*$_GET['perpage']);
                    $object = $objectModel->getPublic($_SESSION['user_id'], 12, 0);
                    
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

    public function getPublicById()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    // $objectModel->getPublic($_GET['user_id'], $_GET['perpage'], ($_GET['page']-1)*$_GET['perpage']);
                    $object = $objectModel->getPublicById($_SESSION['user_id'], 12, 0);
                    
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

    public function delete()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $objectModel = $this->model('ObjectModel');
                    $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
                    $storageAccess->deleteFile($_POST['url_photo']);
                    $storageAccess = new StorageAccess(StorageAccess::VIDEO_PATH);
                    $storageAccess->deleteFile($_POST['url_video']);
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