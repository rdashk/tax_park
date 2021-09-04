<?php
require_once dirname(__DIR__)."/vendor/autoload.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отчет</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div>
    <ul>Отчет
        <li>Машиномест: </li>
        <li>Кол-во дней: </li>
        <li>Водители
            <ul>
                <li>Бывалые: </li>
                <li>Обычные: </li>
            </ul>
        </li>
        <li>Автомобилей:
            <ul>
                <li>Luda: </li>
                <li>Homba: </li>
                <li>Hendai: </li>
            </ul>
        </li>
    </ul>
</div>
<?php

include("calculate.php");

?>
</body>