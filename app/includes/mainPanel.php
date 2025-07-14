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


if ($_SERVER['REQUEST_METHOD'] == "GET")
{
    
    if ($_SESSION['messageShown'] == true)
    {
        $_SESSION['message'] = " ";
    }
    $_SESSION['messageShown'] = true;
    

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
}

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    
}