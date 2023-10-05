<?php

class UserController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $loginView = $this->view('user', 'LoginView', []);
                    $loginView->render();
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function login()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $loginView = $this->view('user', 'LoginView');
                    $loginView->render();
                    exit;

                case 'POST':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $userId = $userModel->login($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $userId;

                    // Kembalikan redirect_url berdasarkan user privileged
                    $isAdmin = $userModel->isAdmin($_POST['username']);
                    header('Content-Type: application/json');
                    http_response_code(201);
                    if ($isAdmin) {
                        echo json_encode(["redirect_url" => BASE_URL . "/admin/users"]);
                    } else {
                        echo json_encode(["redirect_url" => BASE_URL . "/user/photos"]);
                    }
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function register()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $registerView = $this->view('user', 'RegisterView');
                    $registerView->render();
                    exit;

                case 'POST':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $userModel->register($_POST['email'], $_POST['username'], $_POST['password'], $_POST['fullname']);

                    // Kembalikan redirect_url
                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/user/login"]);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }


    public function logout()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    unset($_SESSION['user_id']);

                    // Kembalikan redirect_url
                    header('Content-Type: application/json');
                    http_response_code(201);
                    echo json_encode(["redirect_url" => BASE_URL . "/home"]);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function username()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->doesUsernameExist($_GET['username']);

                    if (!$user) {
                        throw new LoggedException('Not Found', 404);
                    }

                    http_response_code(200);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function email()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->doesEmailExist($_GET['email']);

                    if (!$user) {
                        throw new LoggedException('Not Found', 404);
                    }

                    http_response_code(200);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function photos()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except User
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isUser();

                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        $photosView = $this->view('user', 'PhotosView', []);
                    } else {
                        // Tampilkan home page untuk user yang belum login
                        $photosView = $this->view('home', 'UnauthorizedHomeView', []);
                    }
                    $photosView->render();
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
    public function search()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except User
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isUser();

                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        $seachView = $this->view('user', 'SearchView', []);
                    } else {
                        // Tampilkan home page untuk user yang belum login
                        $seachView = $this->view('home', 'UnauthorizedHomeView', []);
                    }
                    $seachView->render();
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function feeds()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except User
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isUser();

                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        $feedsView = $this->view('user', 'FeedsView', []);
                    } else {
                        // Tampilkan home page untuk user yang belum login
                        $feedsView = $this->view('home', 'UnauthorizedHomeView', []);
                    }
                    $feedsView->render();
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function profile()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except User
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isUser();

                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        $profileView = $this->view('user', 'ProfileView', []);
                    } else {
                        // Tampilkan home page untuk user yang belum login
                        $profileView = $this->view('home', 'UnauthorizedHomeView', []);
                    }
                    $profileView->render();
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function manage()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except User
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isUser();
                    
                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        $manageView = $this->view('user', 'ManageMyAccountUserView', []);
                    } else {
                        // Tampilkan home page untuk user yang belum login
                        $manageView = $this->view('home', 'UnauthorizedHomeView', []);
                    }
                    $manageView->render();
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function data()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUserById($_SESSION['user_id']);
                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode(["fullname" => $user->fullname, "username" => $user->username, "storage" => $user->storage, "storage_left" => $user->storage_left]);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function updateUsername()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $userModel->updateUsername($_SESSION['user_id'], $_POST['username']);

                    http_response_code(201);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function updateFullname()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $userModel->updateFullname($_SESSION['user_id'], $_POST['fullname']);

                    http_response_code(201);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (LoggedException $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function updatePassword()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $userModel->updatePassword($_SESSION['user_id'], $_POST['password']);

                    http_response_code(201);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (LoggedException $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}