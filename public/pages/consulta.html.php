<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../images/Logo Favicon.png" type="image/png">
    <title>Consulta animales</title>

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

<body style="font-family: 'Montserrat';">
    <header>
        <div class="container-fluid"> 

            <div class="row align-items-center justify-content-between pe-2" style="background-color: black;">
                <div class="d-flex col-1 p-3 align-self-center shrink">
                    <a href="../index.html.php">
                        <img id="mascotislaLogo" src="../images/Logo.svg" alt="Logo Mascotisla" class="img-fluid hover-scale-up">
                    </a>
                </div>

                <div class="d-flex col-10 p-3 align-self-center shrink">
                    <h2 class="fw-bold align-self-center p-3 text-light">
                        Consulta de animales
                    </h2>
                </div>
                        
                <div class="col-1 align-items-center justify-content-center">
                    <a href="https://www.instagram.com/pimargarita_/?hl=es" target="_blank">
                        <img id="pimLogo" src="../images/Logo PIM.svg" alt="Logo PIM" class="hover-scale-up img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="d-flex container mt-5 mb-5 justify-content-center pb-5 text-center">
            <?php require __DIR__ . "/../../app/templates/tables/tableConsultaAnimales.html.php"  ?>
        </div>
    </main>

    <footer>
        <div class="container-fluid mt-5 p-5 position-relative" style="background-color: #222222;">
            <div class="row position-absolute top-0 start-50 translate-middle p-4" style="background-color: black;  border-radius: 12px;">
                <div class="col-3 align-items-center" >
                    <img src="../images/Logo PIM.svg" alt="logo Pim" class="img-fluid">
                </div>
                <div class="col-2 align-items-center" >
                    <img src="../images/Logo.svg" alt="logo Pim" class="img-fluid">
                </div>
                <div class="col-7">
                    <p class="fs-4 fw-bold text-light text-break"> Mascotisla, una iniciativa de la fundación PIM</p>
                </div>
            </div>
            <div class="row pt-5 justify-content-center align-items-center">
                <div class="col-auto pt-5 pb-5">
                    <p class="tex-center fs-4 text-light">Para colaborar, donar y reportar comunícate con nosotros a través de los siguientes medios:</p>
                </div>
            </div>   
            <div class="row pt-2 justify-content-center align-items-center" >
                <div class="col-auto text-center">
                    <img src="../images/Telefono.png" class="img-fluid hover-scale-up scale-down">
                </div>
                <div class="col-auto text-center">
                    <img src="../images/Mail.png" class="img-fluid hover-scale-up scale-down">
                </div>
                <div class="col-auto text-center">
                    <img src="../images/Instagram.png" class="img-fluid hover-scale-up scale-down">
                </div>
                <div class="col-auto text-center">
                    <img src="../images/WhatsApp.png" class="img-fluid hover-scale-up scale-down">
                </div>
            </div>
            <div class="row pt-5 justify-content-center align-items-center">
                <div class="col-auto pt-5">
                    <p class="tex-center fs-6 text-light">(Para formar parte de la fundación y obtener un usuario contáctanos)</p>
                </div>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-auto">
                    <p class="tex-center fs-6 text-light">- Miguel Arismendi, Angel Marin, Sebastian Martinez, Alejandro Malave -</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bo    otstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integ    rity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEM    VjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
