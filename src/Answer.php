<?php
require_once dirname(__DIR__)."/vendor/autoload.php";

$input_data = "input_data2";
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
        <li>Машиномест:
            <?php
            echo json_decode(file_get_contents($input_data . ".json"), false)->park->places;
            ?>
        </li>
        <li>Кол-во дней:
            <?php
            if ($_POST['days'] == "") {
                echo "200";
            }
            else echo $_POST['days'];
            ?>
        </li>
        <li>Водителей:
            <?php
            echo sizeof(json_decode(file_get_contents($input_data . ".json"), true)["drivers"]);
            ?>
        </li>
        <li>Автомобилей:
            <?php
            echo sizeof(json_decode(file_get_contents($input_data . ".json"), true)["cars"]);
            ?>
        </li>
    </ul>
</div>
<?php

include("calculate.php");

$file_name = "отчет";
if ($_POST['file_name'] != ""){
    $file_name = $_POST['file_name'];
}

$fd = fopen($file_name . ".txt", 'r') or die("Не удалось открыть файл с отчетом!");
while(!feof($fd))
{
    $str = htmlentities(fgets($fd));
    echo $str . "<br />";
}
fclose($fd)
?>
</body>