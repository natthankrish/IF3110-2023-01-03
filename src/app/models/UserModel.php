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

    public function isAdmin($username)
    {
        $query = 'SELECT is_admin FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        return $user->is_admin;
    }

    public function getUserById($id)
    {
        $query = 'SELECT * FROM user WHERE user_id = :id';

        $this->database->query($query);
        $this->database->bind('id', $id);

        $user = $this->database->fetch();

        return $user;
    }

    public function getUserByUsername($username)
    {
        $query = 'SELECT * FROM user WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        return $user;
    }

    public function getUsers($page)
    {
        $query = 'SELECT user_id, fullname, email, username, storage, storage_left FROM user WHERE is_admin = FALSE LIMIT :limit OFFSET :offset';

        $this->database->query($query);
        $this->database->bind('limit', ROWS_PER_PAGE);
        $this->database->bind('offset', ($page - 1) * ROWS_PER_PAGE);
        $users = $this->database->fetchAll();

        $query = 'SELECT CEIL(COUNT(user_id) / :rows_per_page) AS page_count FROM user WHERE is_admin = FALSE';

        $this->database->query($query);
        $this->database->bind('rows_per_page', ROWS_PER_PAGE);
        $user = $this->database->fetch();
        $pageCount = $user->page_count;

        $returnArr = ['users' => $users, 'pages' => $pageCount];
        return $returnArr;
    }

    public function getFilteredUsers($input)
    {
        $query = 'SELECT user_id, fullname, email, username, storage, storage_left FROM user WHERE is_admin = FALSE AND (fullname LIKE :input OR email LIKE :input OR username LIKE :input)';

        $this->database->query($query);
        $this->database->bind('input', '%' . $input . '%');
        $users = $this->database->fetchAll();

        $returnArr = ['users' => $users];
        return $returnArr;
    }

    public function getUsername($id)
    {
        $query = 'SELECT username FROM user WHERE user_id = :id';

        $this->database->query($query);
        $this->database->bind('id', $id);

        $username = $this->database->fetch();
        return $username;
    }

    public function updateUsername($id, $username)
    {
        $query = 'UPDATE user SET username = :username WHERE user_id = :id';

        $this->database->query($query);
        $this->database->bind('username', $username);
        $this->database->bind('id', $id);

        $this->database->execute();
    }

    public function updateUsernameByUsername($username, $newUsername)
    {
        $query = 'UPDATE user SET username = :newUsername WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('newUsername', $newUsername);
        $this->database->bind('username', $username);

        $this->database->execute();
    }

    public function updateFullname($id, $fullname)
    {
        $query = 'UPDATE user SET fullname = :fullname WHERE user_id = :id';

        $this->database->query($query);
        $this->database->bind('fullname', $fullname);
        $this->database->bind('id', $id);

        $this->database->execute();
    }

    public function updateFullnameByUsername($username, $fullname)
    {
        $query = 'UPDATE user SET fullname = :fullname WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('fullname', $fullname);
        $this->database->bind('username', $username);

        $this->database->execute();
    }

    public function updatePassword($id, $password)
    {
        $query = 'UPDATE user SET password = :password WHERE user_id = :id';
        $options = [
            'cost' => BCRYPT_COST
        ];

        $this->database->query($query);
        $this->database->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
        $this->database->bind('id', $id);

        $this->database->execute();
    }

    public function updatePasswordByUsername($username, $password)
    {
        $query = 'UPDATE user SET password = :password WHERE username = :username';
        $options = [
            'cost' => BCRYPT_COST
        ];

        $this->database->query($query);
        $this->database->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
        $this->database->bind('username', $username);

        $this->database->execute();
    }

    public function updateStorageByUsername($username, $storage)
    {
        // Update storage left first by calculating the difference between the new storage and the old storage
        $query = 'UPDATE user SET storage_left = storage_left + (:storage - storage) WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('storage', $storage);
        $this->database->bind('username', $username);

        $this->database->execute();

        $query = 'UPDATE user SET storage = :storage WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('storage', $storage);
        $this->database->bind('username', $username);

        $this->database->execute();
    }

    public function deleteUSer($username)
    {
        $query = 'DELETE FROM user WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $this->database->execute();
    }
}
