<?php

class AuthenticationMiddleware
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function isAuthenticated()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new LoggedException('Unauthorized', 401);
        }

        $query = 'SELECT user_id FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user) {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function isNotAuthenticated()
    {
        if (isset($_SESSION['user_id'])) {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function isAdmin()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new LoggedException('Unauthorized', 401);
        }

        $query = 'SELECT is_admin FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user || !$user->is_admin) {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function isUser()
    {
        if (!isset($_SESSION['user_id'])) {
            throw new LoggedException('Unauthorized', 401);
        }

        $query = 'SELECT is_admin FROM user WHERE user_id = :user_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('user_id', $_SESSION['user_id']);

        $user = $this->database->fetch();

        if (!$user || $user->is_admin) {
            throw new LoggedException('Unauthorized', 401);
        }
    }
}
