<?php
session_start();
include __DIR__ . "/classes/user.php";
include __DIR__ . "/classes/database.php";
include_once __DIR__ . '/classes/notificacionAdmin.php';

Database::connect();

$users = [];
$query = "SELECT miembros.id AS id, colaboradores.nombre AS nombre, correo, constrasena, cedula_colaborador, es_admin 
            FROM miembros
            JOIN colaboradores ON miembros.cedula_colaborador = colaboradores.cedula;";

Database::executeQuery($query);

// solo crearlos con la info necesaria para este panel (correo, cedula, contrasena y permiso) para simplificarnos la vida
foreach (Database::$result as $row) 
{
    $isAdmin = false;
    if ($row['es_admin'] == true)
    {
        $isAdmin = true;
    }

    $users[] = new User
    (
        $row['id'] ?? null,
        $row['nombre'] ?? '',
        $row['apellido'] ?? '',
        ($row['calle'] ?? '') . ' ' . ($row['referencia'] ?? ''),
        $row['cedula_colaborador'],
        $row['correo'],
        $row['constrasena'],
        true,
        $isAdmin
    );
}

$loggedIn = false;
$status = ' ';
$loggedUser = null;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $mailOrId = htmlspecialchars($_POST['tbMailOrId'] ?? null);
    $password = htmlspecialchars($_POST['tbPassword'] ?? null);

    $userFound = null;
    foreach ($users as $currentUser)
    {
        if ($mailOrId == $currentUser->getEmail() || $mailOrId == $currentUser->getIdentification()) 
        {
            $userFound = $currentUser;

            if ($password == $currentUser->getPassword()) 
            {
                $loggedIn = true;
                $loggedUser = $currentUser;

                $_SESSION["userId"] = $loggedUser->getIdentification();
                $_SESSION["userName"] = $loggedUser->getName();
                $_SESSION["userIsAdmin"] = $loggedUser->isAdmin();
                $_SESSION["userMail"] = $loggedUser->getEmail();
                header("location: mainPanel.html.php");
                exit();
            }
            break;
        }
    }

    if ($loggedIn == false) 
    {
        if ($userFound) 
        {
            $status = 'Contraseña incorrecta';
            $showForgot = true;
        } 
        else 
        {
            $status = 'Credenciales incorrectas';
        }
    }

    // Manejo de solicitud de recuperación de contraseña
    if (isset($_POST['forgotPassword']) && !empty($mailOrId)) 
    {
        include_once __DIR__ . '/classes/notificacionAdmin.php';
        $titulo = 'Recuperación de contraseña';
        $mensaje = 'El usuario con correo/cédula "' . $mailOrId . '" ha solicitado recuperar su contraseña desde el login.';
        NotificacionAdmin::crear($titulo, $mensaje);
        $status = 'Solicitud enviada a los administradores.';
        $showForgot = false;
    }
}
