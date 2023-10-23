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
    try {
        mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $e) {
        $code = $e->getCode();
        if ($code === 1062) { // duplicate entry
            return 'Email already exists';
        }
    } finally {
        mysqli_stmt_close($stmt);
    }
}

function getUser($dbConn, $email) {
    $sql = "SELECT * FROM users WHERE email=?;";
    $stmt = mysqli_stmt_init($dbConn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Error getting the user from DB');
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($resultData);

    mysqli_stmt_close($stmt);

    return $row;
}
