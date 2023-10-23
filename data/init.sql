USE `php-auth`;

CREATE TABLE users (
    email varchar(128) PRIMARY KEY,
    pwd varchar(256) NOT NULL
);