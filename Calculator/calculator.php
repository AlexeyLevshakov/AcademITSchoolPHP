<?php
ini_set('error_reporting', E_ALL);

header('Content-type: text/html; charset=utf-8');

require_once __DIR__ . '/function.php';

session_start();

if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    if (auth($login, $password) == false) {
        header('Location: /calculator/index.php');
        exit();
    }
} else {
    header('Location: /calculator/index.php');
    exit();
}

if (count($_POST) == 0) {
    $_POST['firstNumber'] = 0;
    $_POST['secondNumber'] = 0;
    $_POST['operation'] = 'Выполнен вход на страницу';
}

switch ($_POST['operation']) {
    case 'Сложение':
        $result = $_POST['firstNumber'] + $_POST['secondNumber'];
        $text = $_POST['firstNumber'] . ' + ' . $_POST['secondNumber'] . ' = ' . $result . PHP_EOL;
        break;
    case 'Вычитание':
        $result = $_POST['firstNumber'] - $_POST['secondNumber'];
        $text = $_POST['firstNumber'] . ' - ' . $_POST['secondNumber'] . ' = ' . $result . PHP_EOL;
        break;
    case 'Умножение':
        $result = $_POST['firstNumber'] * $_POST['secondNumber'];
        $text = $_POST['firstNumber'] . ' * ' . $_POST['secondNumber'] . ' = ' . $result . PHP_EOL;
        break;
    case 'Деление':
        if ($_POST['secondNumber'] != 0) {
            $result = $_POST['firstNumber'] / $_POST['secondNumber'];
            $text = $_POST['firstNumber'] . ' / ' . $_POST['secondNumber'] . ' = ' . $result . PHP_EOL;
        } else {
            $result = 'На ноль делить запрещено';
            $text = 'Пользователь попробовал поделить на ноль' . PHP_EOL;
        }
        break;
    case 'Выполнен вход на страницу' :
        $result = 0;
        $text = 'Выполнен вход на страницу' . PHP_EOL;
}

$fileName = __DIR__ . '/memory.txt';
file_put_contents($fileName, $text, FILE_APPEND);
?>

<form method="post" action="/Calculator/calculator.php">
    <table>
        <tr>
            <td><label for="firstNumber">Введите первое число</label></td>
            <td><input id="firstNumber" type="text" name="firstNumber" value="<?= $_POST['firstNumber'] ?>"></td>
        </tr>
        <tr>
            <td><label for="secondNumber">Введите второе число</label></td>
            <td><input id="secondNumber" type="text" name="secondNumber" value="<?= $_POST['secondNumber'] ?>">
            </td>
        </tr>
    </table>
    <br/>
    <label>Выберите арифметическое действие:</label>
    <br/>
    <label><input type="radio" name="operation" value="Сложение" checked>Сложение</label>
    <label><input type="radio" name="operation" value="Вычитание">Вычитание</label>
    <label><input type="radio" name="operation" value="Умножение">Умножение</label>
    <label><input type="radio" name="operation" value="Деление">Деление</label>
    <br>
    <br>
    <input type="submit" value="Вычислить">
</form>

<p>Результат: <?= $result; ?></p>
<br/>
<br/>
<a href="/Calculator/logout.php">Выйти</a>


