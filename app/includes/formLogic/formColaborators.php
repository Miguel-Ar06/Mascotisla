<?php 
require_once __DIR__ . "/../classes/database.php";
Database::connect();   

$cedula; $name; $lastName; $phonesStr; $phonesArr; $details; // variables para todos
$isMember; $email; $password; $passwordConfirm; $city; $street; $municipality; $referencePoint; $isAdmin; // variables solo para miemnbros

$roles = [];
getRoles();
$selectedRoles = $_POST['ckRole'] ?? [];

$clickedButton = "btSubmitColaborador";
$_SESSION['message'] = $_SESSION['message'] ?? " ";

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $_SESSION['message'] = " ";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    // entramos por post para procesar la info y volvemos por get para no repetirla
    if (isset($_POST['colaboratorIdentification']) && isset($_POST['btRow']))
    {
        if ($_POST['btRow'] == "see")
        {
            getColaboratorData();
            $_SESSION['message'] = '<div class="fs-4">Tip: puede editar los datos y presionar "actualizar"</div>';
            // redirect por get
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

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

        if (!empty($selectedRoles))
        {
            registerRoles();
        }
    }
    else if ($_POST[$clickedButton] == "Actualizar")
    {
        updateColaborator();
    }
}

// funciones para procesamiento

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

    if (!validRegister())
    {
        return;
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

function validRegister()
{
    global $cedula, $email, $phonesStr, $isMember;

    // Verificar que la cedula y/o correo no existen ya 
    $query = "SELECT correo, cedula, numero_telefono AS telefono
                FROM colaboradores
                LEFT JOIN miembros ON miembros.cedula_colaborador = colaboradores.cedula
                JOIN numeros_telefonicos n ON colaboradores.cedula = n.cedula_colaborador;";

    Database::executeQuery($query);

    $errorMsg = "";
    $errores = 0;
    foreach (Database::$result as $row)
    { 
        
        $actualEmail = $row['correo'];
        $actualCedula = $row['cedula'];
        $actualPhone = $row['telefono'];

        if ($cedula == $actualCedula)
        {
            $errorMsg .= "cédula";
            $errores++;
        }
        if ($isMember == "on" && !empty($email) && ($email == $actualEmail))
        {
            if ($errores > 0)
            {
                $errorMsg .= ", ";
            }
            $errorMsg .= " correo ";
            $errores++;
        }
        if ($phonesStr == $actualPhone)
        {
            if ($errores > 0)
            {
                $errorMsg .= ", ";
            }
            $errorMsg .= " teléfono ";
            $errores++;
        }

        if ($errores > 0)
        {
            $_SESSION['message'] = "<div class='text-danger fs-4'>Error: " . $errorMsg . " ya existente </div>";
            return false;
        }
    }

    return true;
}

function colaboratorFound()
{
    global $cedula;

    // Verificar que la cedula existe
    $query = "SELECT cedula FROM colaboradores;";
    Database::executeQuery($query);

    foreach (Database::$result as $row)
    { 
        
        $actualCedula = $row['cedula'];

        if ($cedula == $actualCedula)
        {
            return true;
        }
    }

    $_SESSION['message'] = "<div class='text-danger fs-4'>Error: no se encuentra el colaborador con esa cédula</div>";
    return false;
}

function getRoles()
{
    global $roles;
    $query = "SELECT nombre FROM papeles;";

    Database::executeQuery($query);

    foreach (Database::$result as $row)
    {
        $roles[] = $row['nombre'];
    }
}

function registerRoles()
{
    global $selectedRoles, $cedula;

    foreach ($selectedRoles as $role) 
    {
        $query = "INSERT INTO papeles_colaboradores (cedula_colaborador, id_papel)
                    SELECT c.cedula, p.id
                        FROM colaboradores c CROSS JOIN papeles p -- CROSS JOIN combina cada fila de c con cada fila de p
                        WHERE c.cedula LIKE ? AND p.nombre LIKE ?;";
        
        Database::safeExecute($query, [$cedula, $role]);
    }
}

function getColaboratorData()
{
    global $cedula, $name, $lastName, $phonesStr, $phonesArr ,$details, $selectedRoles, // variables para todos
    $isMember, $email, $password, $passwordConfirm, $city, $street, $municipality, $referencePoint, $isAdmin; // variables solo miembros

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btRow']) && $_POST['btRow'] == 'see') 
    {
        $cedulaToSee = $_POST['colaboratorIdentification'] ?? null;

        if ($cedulaToSee) 
        {
            // tomar datos del colaborador
            $query = "SELECT * FROM colaboradores WHERE cedula = ?";
            Database::safeExecute($query, [$cedulaToSee]);
            if (!empty(Database::$result)) 
            {
                $row = Database::$result[0];
                $cedula = $row['cedula'];
                $name = $row['nombre'];
                $lastName = $row['apellido'];
                $details = $row['detalles'];
                // tomar telefono
                $query = "SELECT numero_telefono FROM numeros_telefonicos WHERE cedula_colaborador = ?";
                Database::safeExecute($query, [$cedulaToSee]);
                $phonesArr = array_column(Database::$result, 'numero_telefono');
                $phonesStr = implode(',', $phonesArr);

                // tomar datos de miembro en caso de que lo sea
                $query = "SELECT * FROM miembros WHERE cedula_colaborador = ?";
                Database::safeExecute($query, [$cedulaToSee]);
                if (!empty(Database::$result)) 
                {
                    $member = Database::$result[0];
                    $isMember = 'on';
                    $email = $member['correo'];
                    $password = $member['constrasena'];
                    $passwordConfirm = $password;
                    $city = $street = $municipality = $referencePoint = $isAdmin = null;
                    $isAdmin = $member['es_admin'] ? 'on' : null;

                    // tomar direccion
                    $query = "SELECT d.calle, d.referencia, c.nombre AS ciudad, m.nombre AS municipio
                            FROM direcciones d
                            JOIN ciudades c ON d.id_ciudad = c.id
                            JOIN municipios m ON c.id_municipio = m.id
                            WHERE d.id = ?";
                    Database::safeExecute($query, [$member['id_direccion']]);
                    if (!empty(Database::$result)) 
                    {
                        $addr = Database::$result[0];
                        $city = $addr['ciudad'];
                        $street = $addr['calle'];
                        $municipality = $addr['municipio'];
                        $referencePoint = $addr['referencia'];
                    }
                } 
                else 
                {
                    $isMember = null;
                    $email = $password = $city = $street = $municipality = $referencePoint = $isAdmin = null;
                }

                // tomar sus papeles/roles
                $query = "SELECT p.nombre FROM papeles_colaboradores pc
                        JOIN papeles p ON pc.id_papel = p.id
                        WHERE pc.cedula_colaborador = ?";
                Database::safeExecute($query, [$cedulaToSee]);
                $selectedRoles = array_column(Database::$result, 'nombre');
            }

            $_SESSION['colaboratorShown'] = 
            [
                'cedula' => $cedula,
                'name' => $name,
                'lastName' => $lastName,
                'phonesStr' => $phonesStr,
                'phonesArr' => $phonesArr,
                'details' => $details,
                'selectedRoles' => $selectedRoles,
                'isMember' => $isMember,
                'email' => $email,
                'password' => $password,
                'passwordConfirm' => $passwordConfirm,
                'city' => $city,
                'street' => $street,
                'municipality' => $municipality,
                'referencePoint' => $referencePoint,
                'isAdmin' => $isAdmin
            ];
        }
    }
}

function clearColaboratorForm()
{
    global $cedula, $name, $lastName, $phonesStr, $phonesArr ,$details, $selectedRoles,
    $isMember, $email, $password, $passwordConfirm, $city, $street, $municipality, $referencePoint, $isAdmin,  $selectedRoles;

    $cedula = "";
    $name = "";
    $lastName = "";
    $phonesStr = "";
    $phonesArr = [];
    $details = "";
    $selectedRoles = "";
    $isMember = "";
    $email = "";
    $password = "";
    $passwordConfirm = "";
    $city = "";
    $street = "";
    $municipality = "";
    $referencePoint = "";
    $isAdmin = "";
    $selectedRoles = [];
}

function updateColaborator()
{
    global $cedula, $name, $lastName, $phonesStr, $phonesArr ,$details, // variables para todos
    $isMember, $email, $password, $passwordConfirm, $city, $street, $municipality, $referencePoint, $isAdmin; // variables solo miembros

    if (!colaboratorFound())
    {
        return;
    }

    if ($isMember && $password != $passwordConfirm)
    {
        $_SESSION['message'] = "<div class='text-danger fs-4'>Las contraseñas deben coincidir</div>";
        return;
    }

    // insertar primero sus datos de colaborador
    $query = "UPDATE colaboradores SET cedula = ?, nombre = ?, apellido = ?, detalles = ?
                WHERE cedula LIKE ?;";
    Database::safeExecute($query, [$cedula, $name, $lastName, $details, $cedula]);
    $query = "UPDATE numeros_telefonicos SET numero_telefono = ?, cedula_colaborador = ?
                WHERE cedula_colaborador LIKE ?;";
    Database::safeExecute($query, [$phonesStr, $cedula, $cedula]);

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

        $query = "SELECT id_direccion FROM miembros WHERE cedula_colaborador = ?;";
        Database::safeExecute($query, [$cedula]);
        $idDireccionActual = null; 
        if (!empty(Database::$result)) 
        {
            $idDireccionActual = Database::$result[0]['id_direccion'];
        }   

        if (!cityExists($city))
        {
            $query = "INSERT INTO ciudades(nombre, id_municipio) VALUES (?,?);";
            Database::safeExecute($query, [strtolower($city), $idMunicipality]);
        }

        $query = "SELECT id FROM ciudades WHERE nombre LIKE ?;";
        Database::safeExecute($query, [strtolower($city)]);
        $idCity = Database::$result[0]['id'];

        if ($idDireccionActual) 
        {
            // actualizar direccion existente
            $query = "UPDATE direcciones SET calle = ?, referencia = ?, id_ciudad = ? WHERE id = ?;";
            Database::safeExecute($query, [$street, $referencePoint, $idCity, $idDireccionActual]);
            $idAdress = $idDireccionActual;
        } 
        else 
        {
            // Insertar nueva direccion
            $query = "INSERT INTO direcciones(calle, referencia, id_ciudad) VALUES (?,?,?);";
            Database::safeExecute($query, [$street, $referencePoint, $idCity]);
            $query = "SELECT id FROM direcciones WHERE calle LIKE ? AND referencia LIKE ? AND id_ciudad = ?;";
            Database::safeExecute($query, [$street, $referencePoint, $idCity]);
            $idAdress = Database::$result[0]['id'];
        }

        // actualizar el miembro
        $query = "UPDATE miembros SET constrasena = ?, correo = ?, fecha_de_ingreso = ?, id_direccion = ?, cedula_colaborador = ?, es_admin = ?
                    WHERE cedula LIKE ?;";
        $admin = false;
        if ($isAdmin == "on") 
        {
            $admin = true;
        }
        Database::safeExecute($query, [$password, $email, date('Y-m-d'), $idAdress, $cedula, $admin, $cedula ]);
    }

    // actualizar sus papeles
    updateRoles();

    $_SESSION['message'] = "<div class='text-success fs-4'>Colaborador actualizado exitosamente</div>";
}

function updateRoles()
{
    global $selectedRoles, $cedula;

    $query = "DELETE FROM papeles_colaboradores WHERE cedula_colaborador = ?;";
    Database::safeExecute($query, [$cedula]);

    foreach ($selectedRoles as $role) 
    {
        $query = "INSERT INTO papeles_colaboradores (cedula_colaborador, id_papel)
                    SELECT ?, p.id FROM papeles p WHERE p.nombre = ?;";
        Database::safeExecute($query, [$cedula, $role]);
    }
}