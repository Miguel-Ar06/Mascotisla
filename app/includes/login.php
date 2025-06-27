<?php 
    // valores de prueba porque aun no he conectado a la bdd jsjsjjsj
    $users = ["Mogel", "Angel@gmail.com"];
    $pass = ["123","456"];

    $logeado = false;
    
    $status = '<p class="text-light fs-5 text-center"> </p>';

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $correoCedula = $_POST['tbCorreoCedula'] ?? null;
        $contrasena = $_POST['tbContrasena'] ?? null;
        
        foreach ($users as $user)
        {
            if ($correoCedula == $user)
            {
                foreach ($pass as $contra)
                {
                    if ($contrasena == $contra)
                    {
                        $logeado = true;
                        break;
                    }
                }
            }
        }

        if ($logeado == false)
        {
            $status = '<p class="text-light fs-5 text-center">Credenciales incorrectas</p>';
        }
        else
        {
            $status = '<p class="text-light fs-5 text-center">Logeado</p>';
        }
    }
