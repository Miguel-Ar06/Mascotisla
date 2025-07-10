<?php 
// include __DIR__ . "/Database.php";
Database::Connect();   

$clickedButton = "btSubmitCOlaborador";
$message = "";

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
    $pohnesStr = htmlspecialchars($_POST['tbPhone'] ?? null);
    $phonessArr = explode ('-' ,$telefonosStr);
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

    if ($_POST[$clickedButton] = "Registrar")
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
                $message = "Error: Esta cédula o correo ya existen";
                return;
            }
        }

        $message = "Insertado (mentira, es para verificar que no acepte duplicados)";
    }
    else if ($_POST[$clickedButton] = "Actualizar")
    {

    }
}