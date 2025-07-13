<?php
require_once __DIR__ . "/../classes/user.php";

$colaborators = [];
Database::connect();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['colaboratorIdentification']) && isset($_POST['btRow']))
    {
        if ($_POST['btRow'] == "delete")
        {
            deleteColaborator();
        }
    }
}

$query = "SELECT miembros.id AS id, cedula, colaboradores.nombre AS nombre, apellido, correo, constrasena, calle, referencia, ciudades.nombre AS ciu_nombre, municipios.nombre AS mun_nombre, es_admin,
            CASE
                WHEN miembros.cedula_colaborador IS NOT NULL THEN TRUE
                ELSE FALSE
            END AS esMiembro
            FROM colaboradores
            LEFT JOIN miembros ON colaboradores.cedula = miembros.cedula_colaborador
            LEFT JOIN direcciones ON miembros.id_direccion = direcciones.id
            LEFT JOIN ciudades ON direcciones.id_ciudad = ciudades.id
            LEFT JOIN municipios ON ciudades.id_municipio = municipios.id;";

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

function deleteColaborator()
{
    $cedulaToDelete = $_POST['colaboratorIdentification'] ?? null;
    $isMember =  $_POST['colaboratorIsMember'] ?? null;

    $query = "DELETE FROM papeles_colaboradores WHERE cedula_colaborador LIKE ?;";
    Database::safeExecute($query,[$cedulaToDelete]);

    $query = "DELETE FROM numeros_telefonicos WHERE cedula_colaborador LIKE ?;";
    Database::safeExecute($query,[$cedulaToDelete]);

    $query = "DELETE FROM numeros_telefonicos WHERE cedula_colaborador LIKE ?;";
    Database::safeExecute($query,[$cedulaToDelete]);

    $query = "DELETE FROM reportes_casos_colaboradores WHERE cedula_colaborador LIKE ?;";
    Database::safeExecute($query,[$cedulaToDelete]);

    if (isset($isMember) && $isMember)
    {
        $query = "SELECT id FROM miembros WHERE cedula_colaborador LIKE ?;";
        Database::safeExecute($query,[$cedulaToDelete]);
        $memberId = Database::$result[0]['id'];

        $query = "DELETE FROM registros_miembros_casos WHERE id_miembro LIKE ?;";
        Database::safeExecute($query,[$memberId]);

        $query = "DELETE FROM registros_miembros_animales WHERE id_miembro LIKE ?;";
        Database::safeExecute($query,[$memberId]);

        $query = "DELETE FROM miembros WHERE cedula_colaborador LIKE ?;";
        Database::safeExecute($query,[$cedulaToDelete]);
    }

    $query = "DELETE FROM colaboradores WHERE cedula LIKE ?;";
    Database::safeExecute($query,[$cedulaToDelete]);

    $_SESSION['message'] = "<div class='text-success fs-4'>Colaborador eliminado exitosamente</div>";

}




function showColaborator()
{

}
