<?php

class Tables
{
    public const USER_TABLE =
    "CREATE TABLE IF NOT EXISTS User (
        user_id         INT                         AUTO_INCREMENT          PRIMARY KEY,
        email           VARCHAR(26)                 UNIQUE,
        password        VARCHAR(56),
        name            VARCHAR(56),
        user_role       ENUM('Admin', 'User'),
        storage         INT,
        storage_left    INT                  
    );";

    public const OBJECT_TABLE =
    "CREATE TABLE IF NOT EXISTS Object (
        object_id       INT                         AUTO_INCREMENT          PRIMARY KEY,
        user_id         INT,
        title           VARCHAR(112),
        type            ENUM('Photo', 'Video'),
        url             VARCHAR(255),
        isPublic        BOOLEAN,
        date            DATE,
        location        VARCHAR(255),
        description     VARCHAR(255),
        post_date       DATETIME,

        FOREIGN KEY (user_id) REFERENCES User(user_id)
    );";

    public const COMMENT_TABLE =
    "CREATE TABLE IF NOT EXISTS Comment (
        comment_id      INT                         AUTO_INCREMENT          PRIMARY KEY,
        object_id       INT,
        user_id         INT,
        message         VARCHAR(255),

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