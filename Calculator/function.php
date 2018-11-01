<?php

function auth($login, $password)
{
    $correct_login = 'alexey';
    $correct_password = '1234';

    if ($login == $correct_login && $password == $correct_password) {
        $_SESSION['login'] = $correct_login;
        $_SESSION['password'] = $correct_password;
        return true;
    };

    return false;
}