<?php
session_start();
include __DIR__ . "/classes/user.php";
include __DIR__ . "/classes/animal.php";
include __DIR__ . "/classes/database.php";

require __DIR__ . "/formLogic/formColaborators.php";
require __DIR__ . '/formLogic/formAnimal.php';

require __DIR__ . "/tableLogic/tableColaboradores.php";
require __DIR__ . "/tableLogic/tableAnimals.php";


// establecer a sus valores o default en caso de que por algun motivo no se pueda
$_SESSION['userName'] = $_SESSION['userName'] ?? ' usuario';
$_SESSION['userIsAdmin'] = $_SESSION['userIsAdmin'] ?? false;
$_SESSION['module'] = $_SESSION['module'] ?? " ";

if (!isset($_SESSION['messageShown'])) {
    $_SESSION['messageShown'] = false;
}
// aquí había un undefined array key y por lo tanto se agregó el if(!isset) de arriba para inicializar la variable antes de usarla
if ($_SERVER['REQUEST_METHOD'] == "GET")
{
    if (isset($_SESSION['messageShown']))
    {
        if ($_SESSION['messageShown'] == true)
        {
            $_SESSION['message'] = " ";
        }
        $_SESSION['messageShown'] = true;
    }
    

    // COLABORADORES
    if (isset($_SESSION['colaboratorShown']) && $_SESSION['alreadyViewedColaborator'])
    {
        unset($_SESSION['colaboratorShown']);
    }
    $_SESSION['alreadyViewedColaborator'] = true;

    if (isset($_GET["btSeleccionMenu"]))
    {
            $_SESSION['module'] = htmlspecialchars($_GET["btSeleccionMenu"]);

            if ($_SESSION['module'] == "Reset")
            {
                $_SESSION['module'] = "" ;
            }
    }

    // ANIMALES
    if (isset($_SESSION['animalShown']))
    {
        if ($_SESSION['animalShown'] && isset($_SESSION['selectedAnimal']))
        {
            unset($_SESSION['selectedAnimal']);
        }
    
        $_SESSION['animalShown'] = true;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
   $isAdmin = ($_POST['ckIsAdmin'] === 'on') ? 1 : 0;
}