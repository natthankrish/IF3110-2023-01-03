<?php

class Tables
{
    public const USER_TABLE =
    "CREATE TABLE IF NOT EXISTS user (
        user_id         INT                         AUTO_INCREMENT          PRIMARY KEY,
        fullname        VARCHAR(256),
        username        VARCHAR(256)                 UNIQUE,
        email           VARCHAR(256)                 UNIQUE,
        password        VARCHAR(256),
        is_admin        BOOLEAN,
        storage         INT,
        storage_left    INT                  
    );";

    public const OBJECT_TABLE =
    "CREATE TABLE IF NOT EXISTS Object (
        object_id       INT                         AUTO_INCREMENT          PRIMARY KEY,
        user_id         INT,
        title           VARCHAR(112),
        type            ENUM('Photo', 'Video'),
        url_photo       VARCHAR(255),
        url_video       VARCHAR(255),
        isPublic        BOOLEAN,
        date            DATE,
        location        VARCHAR(256),
        description     VARCHAR(512),
        post_date       DATETIME,

        FOREIGN KEY (user_id) REFERENCES user(user_id)
    );";

    public const COMMENT_TABLE =
    "CREATE TABLE IF NOT EXISTS Comment (
        comment_id      INT                         AUTO_INCREMENT          PRIMARY KEY,
        object_id       INT,
        user_id         INT,
        message         VARCHAR(512),

        FOREIGN KEY (user_id) REFERENCES User(user_id),
        FOREIGN KEY (object_id) REFERENCES Object(object_id)
    );";

    public const LIKE_TABLE =
    "CREATE TABLE IF NOT EXISTS Likes (
        like_id         INT                         AUTO_INCREMENT          PRIMARY KEY,
        object_id       INT,
        user_id         INT,
        
        FOREIGN KEY (user_id) REFERENCES User(user_id),
        FOREIGN KEY (object_id) REFERENCES Object(object_id)
    );";
}