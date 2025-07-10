<?php
session_start();
include __DIR__ . "/user.php";
include __DIR__ . "/database.php";

// valores de prueba porque aun no he hecho la pagina para insertar usuarios a la bdd jsjsj
$testUsers =
[
   new User(1, "Miguel", "Arismendi", "San Juan", "31348551","marismendi.8551@unimar.edu.ve", "0000", true, true), 
   new User(2, "Angel", "Marin", "El valle", "12345","correodegei@gmail.com", "1234", true, false), 
];

$loggedIn = false;
$status = ' ';
$loggedUser = null;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $mailOrId = $_POST['tbMailOrId'] ?? null;
    $password = $_POST['tbPassword'] ?? null;

    Database::connect();

    foreach ($testUsers as $currentUser)
    {
        $validLogin = ($mailOrId == $currentUser->getEmail() || $mailOrId == $currentUser->getIdentification()) && $password == $currentUser->getPassword();

        if ($validLogin)
        {
            $loggedIn = true;
            $loggedUser = $currentUser;
            
            // sesion = variables accesibles para todo el navegador
            $_SESSION["userId"] = $loggedUser->getIdentification();
            $_SESSION["userName"] = $loggedUser->getName();
            $_SESSION["userIsAdmin"] = $loggedUser->isAdmin();
            $_SESSION["userMail"] = $loggedUser->getEmail();

            header("location: panel.html.php");
            exit();

            break;
        }
    }

    if ($loggedIn == false)
    {
        $status = 'Credenciales incorrectas';
    }

     //$status = Database::$outputStatus;
}
