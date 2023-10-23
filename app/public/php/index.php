<?php
session_start();
if (isset($_SESSION["email"])) {
    echo 'You are logged in as ' . $_SESSION["email"];
    // TODO Add logout link
} else {
    header('location: login.php');
}