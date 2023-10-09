<?php

class ObjectModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function store($user_id, $title, $url_photo, $url_video, $date, $location, $type, $size)
    {
        if($url_video){
            $query = 'INSERT INTO Object 
                    (user_id, title, type, url_photo, isPublic, date, location, description, post_date, url_video, size) 
                    VALUES (
                        :user_id,
                        :title,
                        :type,
                        :url_photo,
                        :isPublic,
                        :date,
                        :location,
                        :description,
                        :post_date,
                        :url_video,
                        :size
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
            $this->database->bind('url_video', $url_video);
            $this->database->bind('size', $size);
    
            $this->database->execute();
        }else{
            $query = 'INSERT INTO Object 
                    (user_id, title, type, url_photo, isPublic, date, location, description, post_date, size) 
                    VALUES (
                        :user_id,
                        :title,
                        :type,
                        :url_photo,
                        :isPublic,
                        :date,
                        :location,
                        :description,
                        :post_date,
                        :size
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
            $this->database->bind('size', $size);
    
            $this->database->execute();
        }

        // Update storage left in user
        $query = 'SELECT storage_left FROM User WHERE user_id = :user_id';

        $this->database->query($query);
        $this->database->bind('user_id', $user_id);

        $res = $this->database->fetch();

        $storage_left = $res->storage_left;
        $storage_left = $storage_left - $size;

        $query = 'UPDATE User SET storage_left = :storage_left WHERE user_id = :user_id';

        $this->database->query($query);

        $this->database->bind('user_id', $user_id);
        $this->database->bind('storage_left', $storage_left);

        $this->database->execute();

    }

    public function getByIdUser($user_id, $limit, $offset)
    {
        $query = 'SELECT * FROM Object WHERE user_id = :user_id LIMIT :limit OFFSET :offset';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('limit', $limit);
        $this->database->bind('offset', $offset);
        $res = $this->database->fetchAll();
        return $res;
    }

    public function getLengthByIdUser($user_id)
    {
        $query = 'SELECT COUNT(*) AS len FROM Object WHERE user_id = :user_id';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $res = $this->database->fetch();
        return $res;
    }

    public function getPublic($user_id, $limit, $offset, $filter)
    {
        $query = "SELECT * FROM Object WHERE user_id != :user_id AND isPublic = 1 AND (title LIKE '%$filter%' OR location LIKE '%$filter%') ORDER BY title LIMIT :limit OFFSET :offset";
        $this->database->query($query);
        $this->database->bind('limit', $limit);
        $this->database->bind('offset', $offset);
        $this->database->bind(':user_id', $user_id);
        $res = $this->database->fetchAll();
        return $res;
    }

    public function getLengthPublic($user_id, $filter)
    {
        $query = "SELECT COUNT(*) AS len FROM Object WHERE user_id != :user_id AND isPublic = 1 AND (title LIKE '%$filter%' OR location LIKE '%$filter%')";
        $this->database->query($query);
        $this->database->bind(':user_id', $user_id);
        $res = $this->database->fetch();
        return $res;
    }

    public function getPublicById($user_id, $limit, $offset, $filter, $isPublic, $isSorted)
    {
        $queryPublic = ($isPublic == "all" ? "" : ($isPublic == "private" ? "AND isPublic = 0" : "AND isPublic = 1"));
        $querySort = ($isSorted == "1" ? 'ORDER BY title' : '');
        $query = "SELECT * FROM Object WHERE user_id = :user_id $queryPublic AND (title LIKE '%$filter%' OR location LIKE '%$filter%') $querySort LIMIT :limit OFFSET :offset;";
        $this->database->query($query);
        $this->database->bind('limit', $limit);
        $this->database->bind('offset', $offset);
        $this->database->bind('user_id', $user_id);
        // echo $query; 
        $res = $this->database->fetchAll();
        return $res;
    }

    public function getLengthPublicById($user_id, $filter, $isPublic)
    {
        $queryPublic = ($isPublic == "all" ? "" : ($isPublic == "private" ? "AND isPublic = 0" : "AND isPublic = 1"));
        $query = "SELECT COUNT(*) AS len FROM Object WHERE user_id = :user_id $queryPublic AND (title LIKE '%$filter%' OR location LIKE '%$filter%');";
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        // echo $query;
        $res = $this->database->fetch();
        return $res;
    }

    public function getPrivate($user_id, $limit, $offset)
    {
        $query = "SELECT * FROM Object WHERE :user_id = user_id AND isPublic = 1 LIMIT :limit OFFSET :offset;";
        $this->database->query($query);
        $this->database->bind('limit', $limit);
        $this->database->bind('offset', $offset);
        $this->database->bind('user_id', $user_id);
        // echo $query; 
        $res = $this->database->fetchAll();
        return $res;
    }

    public function getLengthPrivate($user_id)
    {
        $query = "SELECT COUNT(*) AS len FROM Object WHERE :user_id = user_id AND isPublic = 1;";
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        // echo $query;
        $res = $this->database->fetch();
        return $res;
    }

    public function updateIsPublic($user_id, $object_id, $isPublic)
    {
        $postDateQuery = 'SELECT post_date FROM Object WHERE object_id = :object_id';
        $this->database->query($postDateQuery);
        $this->database->bind('object_id', $object_id);
        $postDate = $this->database->fetch(); 
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
                $this->database->bind('isPublic', 0);
    
                $this->database->execute();
            }else{
                $query = 'UPDATE Object 
                SET isPublic = :isPublic, post_date = NOW()
                WHERE object_id = :object_id';
    
                $this->database->query($query);
                $this->database->bind('object_id', $object_id);
                $this->database->bind('isPublic', 1);
    
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

    public function updateDesc($user_id, $object_id, $text)
    {
        $query = 'UPDATE Object 
                  SET description = :text
                  WHERE object_id = :object_id';
    
        $this->database->query($query);
        $this->database->bind('object_id', $object_id);
        $this->database->bind('text', $text);

        $this->database->execute();
    }

    public function updateName($user_id, $object_id, $text)
    {
        $query = 'UPDATE Object 
                    SET title = :text
                    WHERE object_id = :object_id';
    
        $this->database->query($query);
        $this->database->bind('object_id', $object_id);
        $this->database->bind('text', $text);

        $this->database->execute();
    }

    public function delete($user_id, $object_id)
    {
        // update storage left
        $query = 'SELECT size FROM Object WHERE object_id = :object_id';
        $this->database->query($query);
        $this->database->bind('object_id', $object_id);
        $res = $this->database->fetch();
        $size = $res->size;

        $query = 'SELECT storage_left FROM User WHERE user_id = :user_id';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $res = $this->database->fetch();
        $storage_left = $res->storage_left;
        $storage_left = $storage_left + $size;

        $query = 'UPDATE User SET storage_left = :storage_left WHERE user_id = :user_id';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('storage_left', $storage_left);
        $this->database->execute();

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
