<!DOCTYPE html>

<html lang="es" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/style.css">
        <title>Inicio de sesión</title>

        <style>
            button, .btn, input[type="button"], input[type="submit"], .hover-scale-up
            {
                transition: transform 0.3s ease-in-out;
            }

            button:hover, .btn:hover, input[type="button"]:hover, input[type="submit"]:hover, .hover-scale-up:hover
            {
                transform: scale(1.1);
            }
            .scale-down
            {
                height: auto;
                width: 60%;
            }
        </style>
    </head>

    <body class="img-fluid d-flex flex-column h-100" style="background-image: url(../images/perroYgatoMimiento.png); background-size: cover; font-family: 'Montserrat'">
        <div class="container-fluid p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-1">
                    <a href="../index.html">
                        <img src="../images/Boton regresar.png" class="img-fluid hover-scale-up">
                    </a>
                </div>
                <div class="col-2">
                    <img src="../images/Logo PIM.svg" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center align-items-end">
                <div class="col-auto justify-content-center text-center">
                    <img src="../images/Logo.svg" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center align-items-start pt-2">
                <div class="col-auto justify-content-center">
                    <p class="fs-3 fw-bolder text-center text-light">Mascotisla</p>
                </div>
            </div>
        </div>

        <div class="container justify-content-center">
            <form action="" method="post">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="tbMailOrId" class="form-label text-light">Cédula o correo electrónico</label>
                            <input type="text" class="form-control" id="tbMailOrId" name="tbMailOrId">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="tbPassword" class="form-label text-light">Contraseña</label>
                            <input type="password" class="form-control" id="tbPassword" name="tbPassword">
                        </div>
                    </div>
                </div>

                <?php require __DIR__ . '/../../app/includes/login.php'; ?>
                <p class="text-light fs-5 text-center"> <?php echo $status; ?></p>
                
                <div class="row justify-content-center mt-3">
                    <div class="col-auto text-center justify-content-center">
                        <button type="submit" class="btn btn-light">Iniciar sesión</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="container d-flex flex-grow-1 align-items-end">
            <div class="row d-flex flex-grow-1 justify-content-center align-items-end">
                <div class="col-auto text-center align-items-end">
                    <p class="fs-6 text-light text-center">¿Quieres formar parte de la fundación? <span class="fw-bold"><a href="../index.html" class="link-light">Contáctanos</a></span></p>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
</html>
