<?php

class LikeModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function store($user_id, $object_id)
    {
        $query = 'INSERT INTO Likes 
                (user_id, object_id) 
                VALUES (
                    (SELECT user_id FROM User WHERE user_id = :user_id),
                    (SELECT object_id FROM Object WHERE object_id = :object_id)
                )';

        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('object_id', $object_id);

        $this->database->execute();
    }

    public function delete($user_id, $like_id)
    {
        $deleteLikeQuery = 'DELETE FROM Likes WHERE like_id = :like_id';
        $this->database->query($deleteLikeQuery);
        $this->database->bind('like_id', $like_id);
        $this->database->execute(); 
    }
}
