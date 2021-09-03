<?php

use Bda\Rdashk\Car\Car;

// данные из формы
$days = 300;
$default = 2;
$master = 3;

$drivers = [
    "master" => [
        "count" => $master,
        "trip" => 13,
        "percent_oil" => 80
    ],
    "default" => [
        "count" => $default,
        "trip" => 10,
        "percent_oil" => 100
    ]
];
//print_r($drivers["master"]["count"]);

$cars = CreateCarArray('input_data.json');

$km = array_fill(0, sizeof($cars), 0);

$repair = array_fill(0, sizeof($cars), 0);


/**
 * создаем массив авто
 * @param $array
 * @return array
 */
function CreateCarArray($file) {
    $data_json = file_get_contents($file);

    $cars_from_json = json_decode($data_json, false)->cars;

    $car_array = [];

    $id = 0;

    foreach ($cars_from_json as $car){
        $new_car = new Car($car->brand, $id, -1);
        var_dump($new_car);
        array_push($car_array, $new_car);
        $id++;
    }

    return $car_array;
}

/** подсчет дней
 *
 */
for ($i=0; $i < $days; $i++){

    // устанавливаем кол-во водителей
    $drivers_for_one_day = [
        "master" => $master,
        "default" => $default
    ];

    foreach ($cars as $car){

        $selected_driver = "default";
            if ($car->getBreakdown() < 100){

                // проверка на наличие "бывалых"
                if ($drivers_for_one_day["master"] > 0){
                    $selected_driver = "master";
                }

                // водителей больше нет
                elseif ($drivers_for_one_day["default"] == 0) {
                    break;
                }

                echo "Водитель " . $selected_driver . " берет авто № " . $car->getId() . $car->getBrand() . "\n";
                $km[$car->getId()] += ($drivers[$selected_driver]["trip"] * 7);

                if ($car->getBreakdown() == -1) {
                    $car->setBreakdown(0.5);
                }
                else {
                    $car->setBreakdown($car->getBreakdown()+1);
                }

                $drivers_for_one_day[$selected_driver]--;
            }

            else {

                echo "Ремонт авто № " . $car->getId() . " завершен!\n";
                if ($repair[$car->getId()] == 3) {
                    $car->setBreakdown(0);
                    $repair[$car->getId()] = 0;
                }

                else {
                    echo "Ремонт авто № " . $car->getId() . "продолжается..\n";
                    $repair[$car->getId()]++;
                }
            }
    }
}
