<?php 
require_once __DIR__ . "/../classes/animal.php";

// animales de prueba para ir creando la plantilla generadora de tablas
$testAnimals = 
[
    new Animal(1, "perro", "pochaco", "volteapipote", "sano", "adoptado", "macho", ["link1","link2"], "00-00-0000"),
    new Animal(2, "perro", "cabecedeo", "volteapipote", "sano", "adoptado", "hembra", ["link1","link2"], "00-00-0000"),
    new Animal(3, "malparido", "malparido gato mion", "mion", "sano", "adoptado", "macho", ["link1","link2"], "00-00-0000"),
    new Animal(4, "malparido", "Gauss", "mion", "sano", "adoptado", "macho ????", ["link1","link2"], "00-00-0000"),
];

$editable = false;
$deleteable = false;
