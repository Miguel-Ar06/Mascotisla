<?php
include __DIR__ . "/user.php";
include __DIR__ . "/database.php";

// valores de prueba porque aun no he hecho la pagina para insertar usuarios a la bdd jsjsj
$testUsers =
[
   new user("Miguel", "San Juan", "31348551","marismendi.8551@unimar.edu.ve", "0000", true), 
   new user("Angel", "El valle", "12345","correodegei@gmail.com", "1234", false), 
];

$loggedIn = false;
$status = '<p class="text-light fs-5 text-center"> </p>';
$loggedUser = null;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $mailOrId = $_POST['tbMailOrId'] ?? null;
    $password = $_POST['tbPassword'] ?? null;

    Database::connect();

    foreach ($testUsers as $user)
    {
        $validLogin = ($mailOrId == $user->getEmail() || $mailOrId == $user->getId()) && $password == $user->getPassword();

        if ($validLogin)
        {
            $loggedIn = true;

            if ($loggedIn)
            {
                header("location: panel.html.php");
                exit();
            }

            $loggedUser = $user;

            if ($loggedUser->isAdmin())
            {
                $status = '<p class="text-light fs-5 text-center">Logeado como administrador</p>';
            }
            else
            {
                $status = '<p class="text-light fs-5 text-center">Logeado</p>';
            }

            break;
        }
    }

    if ($loggedIn == false)
    {
        $status = '<p class="text-light fs-5 text-center">Credenciales incorrectas</p>';
    }

    // $status = '<p class="text-light fs-5 text-center">'. Database::$outputStatus . '</p>';
}
