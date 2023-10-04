<?php

class HomeController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, tampilkan default home page
                        $homeView = $this->view('home', 'HomeView', []);
                    } else {
                        // Tampilkan home page untuk user yang belum login
                        $homeView = $this->view('home', 'UnauthorizedHomeView', []);
                    }
                    $homeView->render(); 

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}