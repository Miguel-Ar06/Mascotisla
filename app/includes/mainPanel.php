<?php
session_start();
include __DIR__ . "/classes/user.php";
include __DIR__ . "/classes/animal.php";
include __DIR__ . "/classes/database.php";

// establecer a sus valores o default en caso de que por algun motivo no se pueda
$_SESSION['userName'] = $_SESSION['userName'] ?? ' usuario';
$_SESSION['userIsAdmin'] = $_SESSION['userIsAdmin'] ?? false;


if ($_SERVER['REQUEST_METHOD'] == "GET")
{
    if (isset($_SESSION['colaboratorShow']))
    {
        unset($_SESSION['colaboratorShow']);
    }

    if (isset($_GET["btSeleccionMenu"]))
    {
            $_SESSION['module'] = htmlspecialchars($_GET["btSeleccionMenu"]);

            if ($_SESSION['module'] == "Reset")
            {
                $_SESSION['module'] = "" ;
            }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
}