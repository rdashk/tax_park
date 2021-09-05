<?php

use Bda\Rdashk\Classes\Car;
use Bda\Rdashk\Classes\Driver;

$input_data = "input_data2";

// данные из формы
$days = 200;
if ($_POST['days'] != ""){
    $days = (int)$_POST['days'];
}

$file_name = "отчет";
if ($_POST['file_name'] != ""){
    $file_name = $_POST['file_name'];
}

$one_trip = 7;

$drivers = CreateArray($input_data . ".json", "drivers");

$cars = CreateArray($input_data . ".json", "cars");

$km_and_other_from_json = json_decode(file_get_contents($input_data . ".json"), false)->cars;

$km = [];
foreach ($km_and_other_from_json as $value){
    array_push($km, $value->km);
}

$repair = array_fill(0, sizeof($cars), 0);
$repair_times = array_fill(0, sizeof($cars), 0);

$data_for_calculate = json_decode(file_get_contents('values.json'), true);
// echo $data_for_calculate["master"]["trip"];

/** подсчет дней
 *
 */
echo "<br /><br />";
for ($i=0; $i < $days; $i++){

    $id = 0;
    foreach ($cars as $car_id => $car){
        // если машина не в ремонте (можно пробегаться по массиву repair)
        if ($car->getBreakdown() < 100) {

            // есть свободные водители
            if ($id < sizeof($drivers)){
                $drivers[$id]->setCarId($car_id);

                // echo "Водитель " . $drivers[$id]->getId() . " берет авто " . $car->getBrand() . " № " . $car->getId() . "<br />";
            }

            // нет свободных водителей
            else break;

            /** считаем километраж
             * если пройдена очередная 1000 км, отправляем в ремонт
             **/
            $old_km = $km[$car->getId()] / 1000;
            $new_km = ($km[$car->getId()] + ($data_for_calculate[$drivers[$id]->getType()]["trip"] * $one_trip)) /1000;
            if ($old_km < $new_km){

                $km[$car->getId()] += 1000;

            }

            // если авто новое
            if ($car->getBreakdown() == -1 || $km[$car->getId()] < 1000) {
                $car->setBreakdown(0.5);
            }

            else {
                $car->setBreakdown($car->getBreakdown() * $data_for_calculate[$car->getBrand()]["breakdown"]);
            }

            // берем следующего водителя
            $id++;
        }

        else {
            if ($repair[$car->getId()] == 3) {
                // echo "Ремонт авто № " . $car->getId() . " завершен! ";
                $car->setBreakdown(0);
                $repair[$car->getId()] = 0;
            }

            else {
                // кол-во поломок
                if ($repair[$car->getId()] == 0){
                    $repair_times[$car->getId()]++;
                }

                // echo "Ремонт авто № " . $car->getId() . "продолжается.. ";
                $repair[$car->getId()]++;
            }
        }
    }
}

toFile($cars, $km, $repair_times, $file_name . ".txt");

function toFile($cars, $km, $repair_times, $file_name){

    // TODO: проверку на существование файла с всплывающим окном (изменить имя или заменить сам файл)
    if (file_exists($file_name)){

        echo "<script type=\"text/javascript\"> 

            alert(\"Файл с таким именем существует! Удаляем старый файл!\"); 
          
             </script>";

        unlink($file_name);
    }

// вывод пройденных км, потраченном бензине
    foreach ($cars as $car){
        $mytext = "Автомобиль № " . $car->getId() . " проехал " . $km[$car->getId()] . " км, сломался " . $repair_times[$car->getId()] . " раз." . PHP_EOL;

        $file=fopen($file_name, "a");
        fwrite ($file, $mytext);
        fclose($file);
    }

}


/**
 * создаем массив авто
 * @param $file
 * @param $code
 * @return array
 */
function CreateArray($file, $code) {

    $data_json = file_get_contents($file);
    $data_from_json = json_decode($data_json, false)->$code;

    $array = [];

    foreach ($data_from_json as $id => $item){
        switch ($code){
            case "cars":
                $new_item = new Car($item->brand, $id, -1);
                break;
            case "drivers":
                $new_item = new Driver($item->type, $item->name, $id);
                break;
            default:
                echo "Wrong data!";
                return [];
        }
        //var_dump($new_car);
        array_push($array, $new_item);
    }

    return $array;
}

