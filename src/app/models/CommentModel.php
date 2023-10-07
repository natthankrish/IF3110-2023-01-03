<?php

class CommentModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function store($user_id, $object_id, $message)
    {
        $query = 'INSERT INTO Comment
                (user_id, object_id, message) 
                VALUES (
                    (SELECT user_id FROM User WHERE user_id = :user_id),
                    (SELECT object_id FROM Object WHERE object_id = :object_id),
                    :message
                )';

        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('object_id', $object_id);
        $this->database->bind('message', $message);

        $this->database->execute();
    }

    public function getByIdObject($user_id, $object_id)
    {
        $query = 'SELECT comment_id, c.user_id AS user_id, message, username FROM Comment c INNER JOIN user u ON u.user_id = c.user_id WHERE object_id = :object_id';
        $this->database->query($query);
        $this->database->bind('object_id', $object_id);
        $res = $this->database->fetchAll();
        return $res;
    }

    public function delete($user_id, $comment_id)
    {
        $deleteCommentQuery = 'DELETE FROM Comment WHERE comment_id = :comment_id';
        $this->database->query($deleteCommentQuery);
        $this->database->bind('comment_id', $comment_id);
        $this->database->execute(); 
    }
}
