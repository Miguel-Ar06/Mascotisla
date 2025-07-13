<?php
session_start();
include __DIR__ . "/classes/user.php";
include __DIR__ . "/classes/database.php";

include_once __DIR__ . '/classes/notificacionAdmin.php';
include_once __DIR__ . '/classes/user.php';

Database::connect();
$users = [];
$query = "SELECT m.id, m.correo, m.constrasena, m.cedula_colaborador, m.fecha_de_ingreso, m.id_direccion, c.nombre, c.apellido, d.calle, d.referencia, a.id AS admin_id FROM miembros m
LEFT JOIN colaboradores c ON m.cedula_colaborador = c.cedula
LEFT JOIN direcciones d ON m.id_direccion = d.id
LEFT JOIN administradores a ON m.id = a.id_miembro";
$stmt = Database::$pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $users[] = new User(
        $row['id'],
        $row['nombre'] ?? '',
        $row['apellido'] ?? '',
        ($row['calle'] ?? '') . ' ' . ($row['referencia'] ?? ''),
        $row['cedula_colaborador'],
        $row['correo'],
        $row['constrasena'],
        true,
        !empty($row['admin_id'])
    );
}
$users[] = new User(1, "Miguel", "Arismendi", "San Juan", "31348551","marismendi.8551@unimar.edu.ve", "0000", true, true);

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
        if ($mailOrId == $currentUser->getEmail() || $mailOrId == $currentUser->getIdentification()) {
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

    if ($loggedIn == false) {
        if ($userFound) {
            $status = 'Contraseña incorrecta';
            $showForgot = true;
        } else {
            $status = 'Credenciales incorrectas';
        }
    }
// Manejo de solicitud de recuperación de contraseña
if (isset($_POST['forgotPassword']) && !empty($mailOrId)) {
    include_once __DIR__ . '/classes/notificacionAdmin.php';
    $titulo = 'Recuperación de contraseña';
    $mensaje = 'El usuario con correo/cédula "' . $mailOrId . '" ha solicitado recuperar su contraseña desde el login.';
    NotificacionAdmin::crear($titulo, $mensaje);
    $status = 'Solicitud enviada a los administradores.';
    $showForgot = false;
}
}
