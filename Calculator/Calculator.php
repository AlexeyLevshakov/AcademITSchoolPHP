<?php
header('Content-type: text/html; charset=utf-8');

include_once __DIR__ . '/function.php';

session_start();

if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
    $login = $_SESSION['login'];
    $password = $_SESSION['password'];
    if (auth($login, $password) == false) {
        header('Location: /Calculator/index.php');
        exit();
    }
} else {
    header('Location: /Calculator/index.php');
    exit();
}

?>

<form method="post" action="Calculator.php">
    <table>
        <tr>
            <td><label for="first_number">Введите первое число</label></td>
            <td><input id="first_number" type="text" name="first_number" value="<?= $_POST['first_number'] ?>"></td>
        </tr>
        <tr>
            <td><label for="second_number">Введите второе число</label></td>
            <td><input id="second_number" type="text" name="second_number" value="<?= $_POST['second_number'] ?>">
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

<?php

switch ($_POST['operation']) {
    case 'Сложение':
        $result = $_POST['first_number'] + $_POST['second_number'];
        $text = $_POST['first_number'] . ' + ' . $_POST['second_number'] . ' = ' . $result . PHP_EOL;
        break;
    case 'Вычитание':
        $result = $_POST['first_number'] - $_POST['second_number'];
        $text = $_POST['first_number'] . ' - ' . $_POST['second_number'] . ' = ' . $result . PHP_EOL;
        break;
    case 'Умножение':
        $result = $_POST['first_number'] * $_POST['second_number'];
        $text = $_POST['first_number'] . ' * ' . $_POST['second_number'] . ' = ' . $result . PHP_EOL;
        break;
    case 'Деление':
        if ($_POST['second_number'] != 0) {
            $result = $_POST['first_number'] / $_POST['second_number'];
            $text = $_POST['first_number'] . ' / ' . $_POST['second_number'] . ' = ' . $result . PHP_EOL;
        } else {
            $result = 'На ноль делить запрещено';
            $text = 'Пользователь попробовал поделить на ноль' . PHP_EOL;
        }
        break;
}

echo 'Результат: ' . $result;

$file_name = __DIR__ . '/Memory.txt';
file_put_contents($file_name, $text, FILE_APPEND);
?>

<br/>
<br/>
<a href="logout.php">Выйти</a>


