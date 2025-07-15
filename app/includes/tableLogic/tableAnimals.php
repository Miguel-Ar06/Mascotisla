<?php 
require_once __DIR__ . "/../classes/animal.php";
Database::connect();
$num_columns = 9;

// animales de prueba para ir creando la plantilla generadora de tablas
$animals = [];

$query = "SELECT animales.id AS id, especie, nombre, raza, sexo, estado, condicion
            FROM animales
            LEFT JOIN condiciones  ON animales.id_condicion = condiciones.id
            LEFT JOIN estados_animales ON animales.id = estados_animales.id_animal
            LEFT JOIN estados ON estados_animales.id_estado = estados.id
            GROUP BY animales.id
            ORDER BY animales.id DESC;";
Database::executeQuery($query);

foreach (Database::$result as $animal)
{
    $animals[] = new Animal(
        $animal['id'],
        $animal['especie'],
        $animal['nombre'],
        $animal['raza'],
        $animal['condicion'],
        $animal['estado'] ?? [],
        $animal['sexo'],
        [],
        " "
    );
}

$editable = false;
$deleteable = false;

if (isset($_SESSION) && isset($_SESSION['userIsAdmin']))
{
    if ($_SESSION['userIsAdmin'])
    {
        $deleteable = true;
    }
}
