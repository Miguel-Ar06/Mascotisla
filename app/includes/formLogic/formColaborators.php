<?php 
require_once __DIR__ . "/../classes/database.php";
Database::Connect();   

$cedula; $name; $lastName; $phonesStr; $phonesArr; $details; // variables para todos
$isMember; $email; $password; $passwordConfirm; $city; $street; $municipality; $referencePoint; $isAdmin; // variables solo para miemnbros

$clickedButton = "btSubmitColaborador";
$_SESSION['message'] = $_SESSION['message'] ?? " ";

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $_SESSION['message'] = " ";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!isset($_POST[$clickedButton]))
    {
        $selectedMenu = "Colaboradores";
        return;
    }

    $cedula = htmlspecialchars($_POST['tbCedula'] ?? null);
    $name = htmlspecialchars($_POST['tbName'] ?? null);
    $lastName = htmlspecialchars($_POST['tbLastName'] ?? null);
    $phonesStr = htmlspecialchars($_POST['tbPhone'] ?? null);
    $phonesArr = explode (',' ,$phonesStr);
    $details = htmlspecialchars($_POST['tbDetails'] ?? null);
    $isMember = $_POST['ckMember'] ?? null;

    if ($isMember == 'on')
    {
        $email = htmlspecialchars($_POST['tbEmail'] ?? null);
        $password = htmlspecialchars($_POST['tbPassword'] ?? null);
        $passwordConfirm = htmlspecialchars($_POST['tbPasswordConfirm'] ?? null);
        $city = htmlspecialchars($_POST['tbCity'] ?? null);
        $street = htmlspecialchars($_POST['tbStreet'] ?? null);
        $municipality = htmlspecialchars($_POST['ddMunicipality'] ?? null);
        $referencePoint = htmlspecialchars($_POST['tbReference'] ?? null);
        $isAdmin = $_POST['ckIsAdmin'] ?? null;
    }

    if ($_POST[$clickedButton] == "Registrar")
    {
        registerColaborator();
    }
    else if ($_POST[$clickedButton] == "Actualizar")
    {

    }
}

// funciones de ayuda
function cityExists($cityName)
{
    $query = "SELECT id FROM ciudades WHERE nombre LIKE ?;";
    Database::safeExecute($query, [strtolower($cityName)]);

    if (count(Database::$result) > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function registerColaborator()
{
    global $cedula, $name, $lastName, $phonesStr, $phonesArr ,$details, // variables para todos
    $isMember, $email, $password, $passwordConfirm, $city, $street, $municipality, $referencePoint, $isAdmin; // variables solo miembros

    // Verificar que la cedula y/o correo no existen ya 
    $query = "SELECT correo, cedula, numero_telefono AS telefono
                FROM colaboradores
                LEFT JOIN miembros ON miembros.cedula_colaborador = colaboradores.cedula
                JOIN numeros_telefonicos n ON colaboradores.cedula = n.cedula_colaborador;";

    Database::executeQuery($query);
    foreach (Database::$result as $row)
    {
        $actualEmail = $row['correo'];
        $actualCedula = $row['cedula'];
        $actualPhone = $row['telefono'];

        if ($email == $actualEmail || $cedula == $actualCedula || $phonesStr == $actualPhone)
        {
            $_SESSION['message'] = "<div class='text-danger fs-4'>Error: Esta cédula, teléfono o correo ya existen</div>";
            return;
        }
    }

    if ($isMember && $password != $passwordConfirm)
    {
        $_SESSION['message'] = "<div class='text-danger fs-4'>Las contraseñas deben coincidir</div>";
        return;
    }

    // insertar primero sus datos de colaborador
    $query = "INSERT INTO colaboradores(cedula, nombre, apellido, detalles) VALUES (?,?,?,?);";
    Database::safeExecute($query, [$cedula, $name, $lastName, $details]);
    $query = "INSERT INTO numeros_telefonicos(numero_telefono, cedula_colaborador) VALUES (?,?);";
    Database::safeExecute($query, [$phonesStr, $cedula]);

    if ($isMember == "on")
    {
        // insertar sus datos de direccion para armar su idDireccion
        $query = "SELECT id FROM municipios WHERE nombre LIKE ?;";
        Database::safeExecute($query, [$municipality]);
        if (empty(Database::$result)) 
        {
            $_SESSION['message'] = "<div class='text-danger fs-4'>Municipio no encontrado</div>";
            return;
        }
        $idMunicipality = Database::$result[0]['id'];

        if (!cityExists($city))
        {
            $query = "INSERT INTO ciudades(nombre, id_municipio) VALUES (?,?);";
            Database::safeExecute($query, [strtolower($city), $idMunicipality]);
        }

        $query = "SELECT id FROM ciudades WHERE nombre LIKE ?;";
        Database::safeExecute($query, [strtolower($city)]);
        $idCity = Database::$result[0]['id'];

        $query = "INSERT INTO direcciones(calle, referencia, id_ciudad) VALUES (?,?,?);";
        Database::safeExecute($query, [$street, $referencePoint, $idCity]);
        $query = "SELECT id FROM direcciones WHERE calle LIKE ? AND referencia LIKE ? AND id_ciudad = ?;";
        Database::safeExecute($query, [$street, $referencePoint, $idCity]);
        $idAdress = Database::$result[0]['id'];

        // insertar el miembro (fuera de chinaso)
        $query = "INSERT INTO miembros(constrasena, correo, fecha_de_ingreso, id_direccion, cedula_colaborador, es_admin) 
                    VALUES(?,?,?,?,?,?);";
        $admin = false;
        if ($isAdmin == "on") 
        {
            $admin = true;
        }
        Database::safeExecute($query, [$password, $email, date('Y-m-d'), $idAdress, $cedula, $admin ]);
    }

    $_SESSION['message'] = "<div class='text-success fs-4'>Colaborador registrado exitosamente</div>";
}