<?php
session_start();
if (isset($_SESSION["email"])) {
    echo '<p> You are logged in as ' . $_SESSION["email"] . '</p>';
    echo '<a href="logout.php">Logout</a>';
} else {
    header('location: login.php');
}