<?php

$dbServer = "db";
$dbUser = "user";
$dbPwd = "secret";
$dbName = "php-auth";

$dbConn = mysqli_connect($dbServer, $dbUser, $dbPwd, $dbName);

if (!$dbConn) {
    die('DB connection failed: ' . mysqli_connect_error());
}

function createUser($dbConn, $email, $pwd) {
    $sql = "INSERT INTO users (email, pwd) VALUES (?,?);";
    $stmt = mysqli_stmt_init($dbConn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Error when creating the user');
    }

    $hashedPwd = md5($pwd);

    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
