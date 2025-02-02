<?php

require_once("mensajes.php");
// $litado = array(

//     "MARCA" => "VOLKSWAGEN", "VOLKSWAGEN", "SEAT", "OPEL",
//     "MODELO" => "PASSAT", "POLO", "IBIZA", "CORSA",
//     "COLOR" => "GRIS", "ROJO", "BLANCO", "AZUL",
//     "MATRICULA" => "..", "DDD", "DDD", "DDD"   
// );

// forma 1
$listado = array(
    "coche1" => array("VOLSKWAGEN","PASSAT","GRIS","DKFKDSLF"),
    "coche2" => array("VOLSKWAGEN","POLO","ROJO","888-777-23KF"),
    "coche3" => array("SEAT","IBIZA","BLANCO","343-43-FDF")
);

// forma 2
$listado2 = array(
    array('marca' => "VOLSKWAGEN","modelo" => "PASSAT", "color" => "GRIS", "matricula" => "53434"),
    array('marca' => "VOLSKWAGEN","modelo" => "POLO", "color" => "AZUL", "matricula" => "3423432"),
    array('marca' => "LAMBORGHINI","modelo" => "AVENTADOR", "color" => "GRIS", "matricula" => "053-432-43G")
);



?>
