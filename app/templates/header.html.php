<?php
include __DIR__ . "/../includes/user.php";
include __DIR__ . "/../includes/database.php";

$name = "{nombre}";
$selectedMenu = "{Menu seleccionado}";
$mainColor = "blue";
?>

<div class="container-fluid"> 
    <div class="row align-items-center justify-content-between pe-2" style="background-color: black;">
        <div class="d-flex col-1 p-3 align-self-center shrink">
            <a href="../index.html" target="_blank">
                <img id="mascotislaLogo" src="../images/Logo.svg" alt="Logo Mascotisla" class="img-fluid hover-scale-up">
            </a>
        </div>
        <div class="d-flex col-10 p-3 align-self-center shrink">
            <h2 id="mascotislaTitle" class="fw-bold align-self-center p-3">Bienvenido <?php echo $name ?>!</h2>
        </div>
        <div class="col-1 align-items-center justify-content-center">
            <a href="https://www.instagram.com/pimargarita_/?hl=es" target="_blank">
                <img id="pimLogo" src="../images/Logo PIM.svg" alt="Logo PIM" class="hover-scale-up img-fluid">
            </a>
        </div>
    </div>

    <div class="container-fluid p-3 pt-2">
        <form action="" method="POST">
            <div class="row justify-content-start">
                <div class="d-flex col-auto ps-0">
                    <h3 id="lbSeleccioneMenu" class="p-3 text-black text-start"> Seleccione un menú para manipular: </h3>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="d-flex col-auto align-items-start">
                    <button type="submit" name="btAnimales" class="btn btn-dark hover-scale-up me-4">Animales</button>
                    <button type="submit" name="btCasos" class="btn btn-dark hover-scale-up me-4">Casos</button>
                    <button type="submit" name="btColaboradores" class="btn btn-dark hover-scale-up me-4">Colaboradores</button>
                    <input type="hidden" name="action" value="btReset">
                    <input class="hover-scale-up " type="image" src="../images/reset_icon.svg" alt="reset_button" name="btReset" style="width:38px; height:38px; border:none; background-color: lightgray; border-radius: 6px; padding:5px;">
                </div>
                <div class="col-auto">
                    <h2 id="lbSelectedMenu" class="fw-bold align-self-center p-3 text-black"> <?php echo $selectedMenu ?> </h2>
                </div>
            </div>
        </form>
    </div>
</div>