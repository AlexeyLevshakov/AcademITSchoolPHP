<?php
ini_set('error_reporting', E_ALL);

header('Content-type: text/html; charset=utf-8');

session_start();

require_once __DIR__ . '/function.php';

if (count($_POST) > 0) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (auth($login, $password) === true) {
        header('Location: /Calculator/calculator.php');
        exit();
    } else {
        session_destroy();
        echo 'Неверные логин и/или пароль';
    }
}

if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    if (auth($login, $password) === true) {
        header('Location: /Calculator/calculator.php');
        exit();
    }
}
?>

<form method="post" action="index.php">
    <table>
        <tr>
            <td><label for="login">Введите логин</label></td>
            <td><input id="login" type="text" name="login"></td>
        </tr>
        <tr>
            <td><label for="password">Введите пароль</label></td>
            <td><input id="password" type="password" name="password"></td>
        </tr>
    </table>
    <input type="submit" value="OK">
</form>
