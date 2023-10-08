<?php

class AdminController extends Controller implements ControllerInterface
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

    public function users()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Grab user data
                    $userModel = $this->model('UserModel');
                    $res = $userModel->getUsers(1);

                    $loginView = $this->view('admin', 'UserDashboardView', $res);
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

    public function admins()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Grab admin data
                    $userModel = $this->model('UserModel');
                    $res = $userModel->getAdmins(1, $_SESSION['user_id']);

                    $loginView = $this->view('admin', 'AdminDashboardView', $res);
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

    public function user($username)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Check if user exists
                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUserByUsername($username);

                    if (!$user) {
                        throw new LoggedException('User Not Found', 404);
                    }

                    $loginView = $this->view('admin', 'UserDetailView', ['username' => $username]);
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

    public function admin($username)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Check if user exists
                    $userModel = $this->model('UserModel');
                    $user = $userModel->getUserByUsername($username);

                    if (!$user) {
                        throw new LoggedException('User Not Found', 404);
                    }

                    $loginView = $this->view('admin', 'AdminDetailView', ['username' => $username]);
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

    public function manage()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    $loginView = $this->view('admin', 'ManageMyAccountAdminView', []);
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

    public function registerAdmin()
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
                    $userModel->registerAdmin($_POST['email'], $_POST['username'], $_POST['password'], $_POST['fullname']);

                    // Kembalikan response code 201
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

    public function fetch($page)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $res = $userModel->getAdmins((int) $page, $_SESSION['user_id']);

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($res);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function filter($input)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $res = $userModel->getFilteredAdmins($input);

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($res);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (LoggedException $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function delete() 
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Prevent Access except Admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $userModel = $this->model('UserModel');
                    $userModel->deleteAdmin($_POST['username']);

                    http_response_code(201);
                    exit;

                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}