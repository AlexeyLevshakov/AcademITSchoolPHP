<?php

function auth($login, $password)
{
    $correctLogin = 'alexey';
    $correctPassword = '1234';

    if ($login == $correctLogin && $password == $correctPassword) {
        $_SESSION['login'] = $correctLogin;
        $_SESSION['password'] = $correctPassword;
        return true;
    };

    return false;
}