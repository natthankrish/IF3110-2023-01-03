<?php

class Database
{
    private $host = HOST;
    private $db_name = DBNAME;
    private $user = USER;
    private $password = PASSWORD;
    private $port = PORT;

    private $admin_email = ADMIN_EMAIL;
    private $admin_username = ADMIN_USERNAME;
    private $admin_password = ADMIN_PASSWORD;
    private $admin_bcrypt_password;

    private $db_connection;
    private $statement;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name;
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->db_connection = new PDO($dsn, $this->user, $this->password, $option);
        } catch (PDOException) {
            throw new LoggedException('Bad Gateway', 502);
        }

        try {
            $this->db_connection->exec(Tables::USER_TABLE);
            $this->db_connection->exec(Tables::OBJECT_TABLE);
            $this->db_connection->exec(Tables::COMMENT_TABLE);
            $this->db_connection->exec(Tables::LIKE_TABLE);

            // Create new admin
            $this->admin_bcrypt_password = password_hash($this->admin_password, PASSWORD_BCRYPT, ['cost' => BCRYPT_COST]);

            $this->db_connection->exec(
                "INSERT IGNORE INTO user (
                    email, username, fullname, password, is_admin, storage, storage_left) 
                    VALUES ('" . $this->admin_email . "','" .$this->admin_username . "','" . $this->admin_username . "','" . $this->admin_bcrypt_password . "', true, 0, 0
                );"
            );
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function query($query)
    {
        try {
            $this->statement = $this->db_connection->prepare($query);
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function bind($param, $value, $type = null)
    {
        try {
            if (is_null($type)) {
                if (is_int($value)) {
                    $type = PDO::PARAM_INT;
                } else if (is_bool($value)) {
                    $type = PDO::PARAM_BOOL;
                } else if (is_null($value)) {
                    $type = PDO::PARAM_NULL;
                } else {
                    $type = PDO::PARAM_STR;
                }
            }
            $this->statement->bindValue($param, $value, $type);
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function execute()
    {
        try {
            $this->statement->execute();
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function fetch()
    {
        try {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function fetchAll()
    {
        try {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    public function rowCount()
    {
        try {
            return $this->statement->rowCount();
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }
    
    public function lastInsertID()
    {
        try {
            return $this->db_connection->lastInsertId();
        } catch (PDOException) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }
}