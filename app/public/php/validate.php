<?php

function validateSignup($email, $pwd, $repeatPwd) {
    if (empty($email)) {
        return 'No email provided';
    }
    if (empty($pwd)) {
        return 'No password provided';
    }
    if (empty($repeatPwd)) {
        return 'Repeat the password';
    }
    if ($pwd !== $repeatPwd) {
        return 'Passwords differ';
    }
    return false;
}

function validateLogin($email, $pwd) {
    if (empty($email)) {
        return 'No email provided';
    }
    if (empty($pwd)) {
        return 'No password provided';
    }
    return false;
}