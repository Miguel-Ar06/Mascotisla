<?php 
require_once __DIR__ . "/../classes/database.php";
Database::Connect();   

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
    $details = htmlspecialchars($_POST['tbDetailss'] ?? null);
    $isMember = $_POST['ckMember'] ?? null;

    if ($isMember == 'on')
    {
        $email = htmlspecialchars($_POST['tbEmail'] ?? null);
        $password = htmlspecialchars($_POST['tbPasswrod'] ?? null);
        $passwordConfirm = htmlspecialchars($_POST['tbPasswordConfirm'] ?? null);
        $city = htmlspecialchars($_POST['tbCity'] ?? null);
        $street = htmlspecialchars($_POST['tbStreet'] ?? null);
        $municipality = htmlspecialchars($_POST['ddMunicipality'] ?? null);
        $referencePoint = htmlspecialchars($_POST['tbReference'] ?? null);
        $isADmin = $_POST['ckIsAdmin'] ?? null;
    }

    if ($_POST[$clickedButton] == "Registrar")
    {
        // Verificar que la cedula y/o correo no existen ya 
        $query = "SELECT correo, cedula
                    FROM colaboradores
                    LEFT JOIN miembros ON miembros.cedula_colaborador = colaboradores.cedula;";

        while (Database::executeQuery($query))
        {
            $actualEmail = Database::$result->fetch()['correo'];
            $actualCedula = Database::$result->fetch()['cedula'];

            if ($email == $actualEmail || $cedula == $actualCedula)
            {
                $_SESSION['message'] = "<div class='text-danger fs-4'>Error: Esta cédula o correo ya existen</div>";
                return;
            }
        }

        $_SESSION['message'] = "<div class='text-success fs-4'>Insertado (mentira, es para verificar que no acepte duplicados)</div>";
    }
    else if ($_POST[$clickedButton] = "Actualizar")
    {

    }
}