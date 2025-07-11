<?php
require_once __DIR__ . "/../classes/user.php";

$colaborators = [];
Database::connect();

$query = "SELECT miembros.id AS id, cedula, colaboradores.nombre AS nombre, apellido, correo, constrasena, calle, referencia, ciudades.nombre AS ciu_nombre, municipios.nombre AS mun_nombre, es_admin,
            CASE
                WHEN miembros.cedula_colaborador IS NOT NULL THEN TRUE
                ELSE FALSE
            END AS esMiembro
            FROM colaboradores
            LEFT JOIN miembros ON colaboradores.cedula = miembros.cedula_colaborador
            JOIN direcciones ON miembros.id_direccion = direcciones.id
            JOIN ciudades ON direcciones.id_ciudad = ciudades.id
            JOIN municipios ON ciudades.id_municipio = municipios.id;";

Database::executeQuery($query);

$row;
if (Database::$executionSuccessful)
{
    foreach (Database::$result as $row)
    {
        $newColaborator = new User
        (
            $row['id'],
            $row['nombre'],
            $row['apellido'],
            $row['calle'] . '-' . $row['ciu_nombre'] . '-' . $row['mun_nombre'] . '-' . $row['referencia'],
            $row['cedula'],
            $row['correo'],
            $row['constrasena'],
            $row['esMiembro'],
            $row['es_admin']
        );

        $colaborators[] = $newColaborator;
    }
}

// colaboradores de prueba para ir creando la plantilla generadora de tablas
$testColaborators = 
[
    new User(1, 'John', 'Doe', 'keoland', '123456', 'john@gmail.com', '0000', true, true),
    new User(2, 'Jane', 'Doe', '', '123457', 'jane@gmail.com', '0000', false, false),
    new User(3, 'Joe', 'Doe', 'keoland', '123458', 'joe@gmail.com', '0000', true, false)
];

$editable = false;
$deleteable = true;
$num_columns = 8;
function boolToSiONo($boolean)
{
    if ($boolean == true)
    {
        echo 'Si';
    }
    else
    {
        echo 'No';
    }
}
