<?php 
include __DIR__ . "/user.php"; //.php con la clase user bien bonita en un archivo aparte

// valores de prueba porque aun no he conectado a la bdd jsjsjjsj
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

    foreach ($testUsers as $user)
    {
        $validLogin = ($mailOrId == $user->getEmail() || $mailOrId == $user->getId()) && $password == $user->getPassword();

        if ($validLogin)
        {
            $loggedIn = true;
            $loggedUser = $user;
            break;
        }
    }

    if ($loggedIn == false)
    {
        $status = '<p class="text-light fs-5 text-center">Credenciales incorrectas</p>';
    }
    else
    {
        if ($loggedUser->isAdmin())
        {
            $status = '<p class="text-light fs-5 text-center">Logeado como administrador</p>';
        }
        else
        {
            $status = '<p class="text-light fs-5 text-center">Logeado</p>';
        }
    }
}
