<?php
session_start();
include __DIR__ . "/user.php";
include __DIR__ . "/database.php";

// valores de prueba porque aun no he hecho la pagina para insertar usuarios a la bdd jsjsj
$testUsers =
[
   new user("Miguel", "San Juan", "31348551","marismendi.8551@unimar.edu.ve", "0000", true), 
   new user("Angel", "El valle", "12345","correodegei@gmail.com", "1234", false), 
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
        $validLogin = ($mailOrId == $currentUser->getEmail() || $mailOrId == $currentUser->getId()) && $password == $currentUser->getPassword();

        if ($validLogin)
        {
            $loggedIn = true;
            $loggedUser = $currentUser;
            
            // sesion = variables accesibles para todo el navegador
            $_SESSION["userId"] = $loggedUser->getId();
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

    // $status = '<p class="text-light fs-5 text-center">'. Database::$outputStatus . '</p>';
}
