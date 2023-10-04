<?php

class UserModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function login($username, $password)
    {
        $query = 'SELECT user_id, password FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        if ($user && password_verify($password, $user->password)) {
            return $user->user_id;
        } else {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function register($email, $username, $password, $fullname)
    {
        $query = 'INSERT INTO user (email, username, fullname, password, is_admin, storage, storage_left) VALUES (:email, :username, :fullname, :password, :is_admin, :storage, :storage_left)';
        $options = [
            'cost' => BCRYPT_COST
        ];

        $this->database->query($query);
        $this->database->bind('email', $email);
        $this->database->bind('username', $username);
        $this->database->bind('fullname', $fullname);
        $this->database->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
        $this->database->bind('is_admin', false);
        $this->database->bind('storage', DEFAULT_STORAGE);
        $this->database->bind('storage_left', DEFAULT_STORAGE);

        $this->database->execute();
    }

    public function registerAdmin($email, $username, $password, $fullname)
    {
        $query = 'INSERT INTO user (email, username, fullname, password, is_admin, storage, storage_left) VALUES (:email, :username, :fullname, :password, :is_admin, :storage, :storage_left)';
        $options = [
            'cost' => BCRYPT_COST
        ];

        $this->database->query($query);
        $this->database->bind('email', $email);
        $this->database->bind('username', $username);
        $this->database->bind('fullname', $fullname);
        $this->database->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
        $this->database->bind('is_admin', true);
        $this->database->bind('storage', 0);
        $this->database->bind('storage_left', 0);

        $this->database->execute();
    }

    public function doesEmailExist($email)
    {
        $query = 'SELECT email FROM user WHERE email = :email LIMIT 1';

        $this->database->query($query);
        $this->database->bind('email', $email);

        $user = $this->database->fetch();

        return $user;
    }

    public function doesUsernameExist($username)
    {
        $query = 'SELECT username FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        return $user;
    }
}
