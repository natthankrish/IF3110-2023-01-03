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
                    $objectModel->store($_SESSION['user_id'], $_POST['title'], $uploadedImage, NULL, date("Y-m-d", strtotime($_POST['date'])),  $_POST['location'], 'Photo', $_POST['size']);
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
                    $uploadedVideo = $storageAccess->saveVideo($_FILES['video']['tmp_name']);
                    
                    $objectModel = $this->model('ObjectModel');
                    $objectModel->store($_SESSION['user_id'], $_POST['title'], NULL, $uploadedVideo, date("Y-m-d", strtotime($_POST['date'])),  $_POST['location'], 'Video', $_POST['size']);
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
                    $object = $objectModel->getByIdUser($_SESSION['user_id'], (int)$_GET["perpage"], (int)((int)$_GET["page"]-1)*(int)$_GET["perpage"]);

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

    public function getLengthByIdUser()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    $object = $objectModel->getLengthByIdUser($_SESSION['user_id']);

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
                    $object = $objectModel->getPublic($_SESSION['user_id'], (int)$_GET["perpage"], (int)((int)$_GET["page"]-1)*(int)$_GET["perpage"], $_GET["filter"]);
                    
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

    public function getLengthPublic()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    $object = $objectModel->getLengthPublic($_SESSION['user_id'], $_GET["filter"]);

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

    public function getPrivate()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    $object = $objectModel->getPrivate($_SESSION['user_id'], (int)$_GET["perpage"], (int)((int)$_GET["page"]-1)*(int)$_GET["perpage"]);
                    
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

    public function getLengthPrivate()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    $object = $objectModel->getLengthPrivate($_SESSION['user_id']);

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
                    $object = $objectModel->getPublicById($_SESSION['user_id'], (int)$_GET["perpage"], (int)((int)$_GET["page"]-1)*(int)$_GET["perpage"], $_GET["filter"], $_GET["public"], $_GET["sort"]);
                    
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

    public function getLengthPublicById()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $objectModel = $this->model('ObjectModel');
                    $object = $objectModel->getLengthPublicById($_SESSION['user_id'], $_GET["filter"], $_GET["public"]);
                    
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