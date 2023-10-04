<?php

class ObjectModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function store($user_id, $title, $url_photo, $url_video, $date, $location, $type)
    {
        if($url_video){
            $query = 'INSERT INTO Object 
                    (user_id, title, type, url_photo, url_video, isPublic, date, location, description, post_date) 
                    VALUES (
                        (SELECT user_id FROM User WHERE user_id = :user_id),
                        :title,
                        :type,
                        :url_photo,
                        :url_video,
                        :isPublic,
                        :date,
                        :location,
                        :description,
                        :post_date
                    )';
    
            $this->database->query($query);
            $this->database->bind('user_id', $user_id);
            $this->database->bind('title', $title);
            $this->database->bind('type', $type);
            $this->database->bind('url_photo', $url_photo);
            $this->database->bind('url_video', $url_video);
            $this->database->bind('isPublic', false);
            $this->database->bind('date', $date);
            $this->database->bind('location', $location);
            $this->database->bind('description', NULL);
            $this->database->bind('post_date', NULL);
    
            $this->database->execute();
        }else{
            $query = 'INSERT INTO Object 
                    (user_id, title, type, url_photo, isPublic, date, location, description, post_date) 
                    VALUES (
                        (SELECT user_id FROM User WHERE user_id = :user_id),
                        :title,
                        :type,
                        :url_photo,
                        :isPublic,
                        :date,
                        :location,
                        :description,
                        :post_date
                    )';
    
            $this->database->query($query);
            $this->database->bind('user_id', $user_id);
            $this->database->bind('title', $title);
            $this->database->bind('type', $type);
            $this->database->bind('url_photo', $url_photo);
            $this->database->bind('isPublic', false);
            $this->database->bind('date', $date);
            $this->database->bind('location', $location);
            $this->database->bind('description', NULL);
            $this->database->bind('post_date', NULL);
    
            $this->database->execute();
        }
    }

    public function updateIsPublic($user_id, $object_id, $isPublic)
    {
        $postDateQuery = 'SELECT post_date FROM Object WHERE object_id = :object_id';
        $this->database->query($postDateQuery);
        $this->database->bind('object_', $object_id);
        $postDate = $this->database->fetch(); 
        echo $postDate;
        if ($postDate === NULL){
            $query = 'UPDATE Object 
                    SET isPublic = :isPublic, description = name, post_date = NOW()
                    WHERE object_id = :object_id';
    
            $this->database->query($query);
            $this->database->bind('object_id', $object_id);
            $this->database->bind('isPublic', 1);
    
            $this->database->execute();
        } else {
            if($isPublic){
                $query = 'UPDATE Object 
                SET isPublic = :isPublic
                WHERE object_id = :object_id';
    
                $this->database->query($query);
                $this->database->bind('object_id', $object_id);
                $this->database->bind('isPublic', $isPublic);
    
                $this->database->execute();
            }else{
                $query = 'UPDATE Object 
                SET isPublic = :isPublic, post_date = NOW()
                WHERE object_id = :object_id';
    
                $this->database->query($query);
                $this->database->bind('object_id', $object_id);
                $this->database->bind('isPublic', $isPublic);
    
                $this->database->execute();
            }
        }
    }

    public function updateNameOrDesc($user_id, $object_id, $text)
    {
        $isPublicQuery = 'SELECT isPublic FROM Object WHERE object_id = :object_id';
        $this->database->query($isPublicQuery);
        $this->database->bind('object_id', $object_id);
        $isPublic = $this->database->fetch(); 
        if ($isPublic){
            $query = 'UPDATE Object 
                    SET description = :text
                    WHERE object_id = :object_id';
    
            $this->database->query($query);
            $this->database->bind('object_id', $object_id);
            $this->database->bind('text', $text);
    
            $this->database->execute();
        } else {
            $query = 'UPDATE Object 
                    SET name = :text
                    WHERE object_id = :object_id';
    
            $this->database->query($query);
            $this->database->bind('object_id', $object_id);
            $this->database->bind('text', $text);
    
            $this->database->execute();
        }
    }

    public function delete($user_id, $object_id)
    {
        $deleteCommentQuery = 'DELETE FROM Comment WHERE object_id = :object_id';
        $this->database->query($deleteCommentQuery);
        $this->database->bind('object_id', $object_id);
        $this->database->execute(); 
        $deleteLikeQuery = 'DELETE FROM Likes WHERE object_id = :object_id';
        $this->database->query($deleteLikeQuery);
        $this->database->bind('object_id', $object_id);
        $this->database->execute(); 
        $deleteObjectQuery = 'DELETE FROM Object WHERE object_id = :object_id';
        $this->database->query($deleteObjectQuery);
        $this->database->bind('object_id', $object_id);
        $this->database->execute(); 
    }
}
