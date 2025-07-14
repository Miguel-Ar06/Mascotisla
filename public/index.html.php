<?php
    session_start();

    $_SESSION = array(); //vaciar la sesion;

    if (ini_get("session.use_cookies"))  // Borrar las cookies de la sesion
    { 
        $params = session_get_cookie_params(); 
        
        setcookie(
            session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/style.css">
        <title>Bienvenido a Mascotisla</title>
        <link rel="icon" href="../public/images/Logo Favicon.png" type="image/png">

        <style>
            button, .btn, input[type="button"], input[type="submit"], .hover-scale-up
            {
                cursor: pointer;
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
            <div class="d-flex container-fluid height-equals-bg flex-column" style="background-image: url('images/Foto Perro escalera2.png'); background-color: black; background-size: cover;">
                <div class="row justify-content-between">
                    <div class="d-flex col-auto p-3 align-self-center shrink">
                        <img id="mascotislaLogo" src="images/Logo.svg" alt="Logo Mascotisla">
                        <h2 id="mascotislaTitle" class="fw-bold align-self-center p-3">Mascotisla</h2>
                    </div>
                    <div class="col-auto p-3">
                        <a href="https://www.instagram.com/pimargarita_/?hl=es" target="_blank">
                            <img id="pimLogo" src="images/Logo PIM.svg" alt="Logo PIM" class="hover-scale-up">
                        </a>
                    </div>
                </div>
                <div class="row flex-grow-1 align-items-center">
                    <h1 id="callToAction" class="text-center fw-bolder col-12">Ayúdanos a cuidarlos</h1>
                </div>
                <div class="row flex-grow-1 justify-content-end align-items-start">
                    <div class="col-auto text-center">
                        <a href="pages/consulta.html.php" class="btn btn-light">Consulta animales</a>
                    </div>
                    <div class="col-auto text-center me-md-5">
                        <a href="#footer" class="btn btn-light">Contáctanos</a>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="container mt-5">
                <div class="row pt-5 pb-5">
                    <p class="fs-1 color-black fw-bold">Abandonados, maltratados, enfermos...</p>
                </div>
                <div class="row">
                    <div class="col-3">
                        <img src="images/gato triste.png" alt="Gato triste" class="img-fluid">
                    </div>
                    <div class="col-3">
                        <img src="images/perro serio.png" alt="Perro serio" class="img-fluid pb-3">
                        <img src="images/perro durmiendo.png" alt="perro durmiendo" class="img-fluid" style="height: 30%; width: auto; display: block;">
                    </div>
                    <div class="col-6">
                        <p class="text-break fs-4">
                                En la isla de margarita es común ver animales domésticos en las calles, víctimas de la crueldad, la indiferencia, 
                            o sencillamente no tuvieron la suerte de nacer en un hogar con amor.
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col">
                        <p class="text-break fs-4">
                                Esto los hace propensos a enfermedades, hambre y los vuelve objetos constantes de violencia
                             y maltrato. Identificar todos estos casos a lo largo y ancho del territorio insular no es facil, pero...
                         </p>
                    </div>
                    <div class="col">
                        <img src="images/perros.png" alt="Perros durmiendo" class="img-fluid">      
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row pt-5 justify-content-center">
                    <div class="col-auto text-center">
                        <p class="fs-1 fw-bold color-black">¡Tu puedes cambiar eso!</p>
                    </div>
                </div>
            </div>

            <div class="container mt-5 mb-5" style="padding-top: 5%; padding-bottom: 5%; background-image: url(images/perro\ y\ gato\ feli.png); background-size: cover; background-position: center; background-repeat: no-repeat; max-width: 70%; height: autopx;">
                <div class="row align-items-center justify-content-center">
                    <div class="col-2">
                        <img src="images/Logo.svg" alt="mascotislaLogo" class="img-fluid">
                    </div>
                </div>
                <div class="row align-items-center justify-content-center mt-3">
                    <div class="col-9">
                        <p class=" text-center fs-4 fw-bold text-light">Consulta nuestra base de datos con los animales y casos conocidos hasta ahora, o contáctanos para reportar o colaborar</p>
                    </div>
                </div>
                <div class="row flex-grow-1 justify-content-center pt-3">
                    <div class="col-auto text-center">
                        <a href="pages/consulta.html.php" class="btn btn-light">Consulta animales</a>
                    </div>
                </div>
                <div class="row flex-grow-1 justify-content-center pt-3">
                    <div class="col-auto text-center">
                        <a href="#footer" class="btn btn-light">Contáctanos</a>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center pt-5">
                    <div class="col-9">
                        <p class=" text-center fs-4 text-light">Adoptando, donando, rescatando, ofreciendo un hogar temporal o reportando. Cualquier apoyo es recibido</p>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row mt-5 justify-content-center align-items-center">
                    <div class="col-auto pt-5">
                        <p class="tex-center fs-4 color-black">¿Eres miembro de la fundación?</p>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-auto pt-5 pb-5 mb-5">
                        <a type="button" class="btn btn-dark" href="pages/login.html.php">Inicia sesión</a>
                    </div>
                </div>
            </div>
        </main>

        <footer id="footer">
            <div class="container-fluid mt-5 p-5 position-relative" style="background-color: #222222;">
                <div class="row position-absolute top-0 start-50 translate-middle p-4" style="background-color: black;  border-radius: 12px;">
                    <div class="col-3 align-items-center" >
                        <img src="images/Logo PIM.svg" alt="logo Pim" class="img-fluid">
                    </div>
                    <div class="col-2 align-items-center" >
                        <img src="images/Logo.svg" alt="logo Pim" class="img-fluid">
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
                        <div style="position: relative; display: inline-block;">
                            <button id="btnTelefono" type="button" style="background: none; border: none; padding: 0;">
                                <img src="images/Telefono.png" class="img-fluid hover-scale-up scale-down" alt="Teléfono">
                            </button>
                            <div id="divTelefonos" style="display: none; position: absolute; left: 50%; transform: translateX(-50%); min-width: 200px; background: #222; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); z-index: 1000; padding: 12px; text-align: center;">
                                <span class="text-light">Teléfonos de contacto:<br><strong>0416-6960017</strong><br><strong>0416-2905504</strong><br><strong>0424-8281580</strong><br><strong>0412-0242771</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-center">
                        <a 
                        href="mailto:marismendi.8551@unimar.edu.ve?Subject=Contacto%20Mascotisla&body=Hola!%20Me%20gustar%C3%ADa%20colaborar%20con%20PIM%0D%0A%0D%0A[Su%20Mensaje%20aqu%C3%AD]%0D%0A%0D%0AAtt%3A%0D%0A[Su%20nombre%20y%20apellido%20aqu%C3%AD]%0D%0A[Su%20c%C3%A9dula%20aqu%C3%AD]">
                        <img src="images/Mail.png" class="img-fluid hover-scale-up scale-down">
                        </a>
                    </div>
                    <div class="col-auto text-center">
                        <a href="https://www.instagram.com/pimargarita_/?hl=es" target="_blank">
                        <img src="images/Instagram.png" class="img-fluid hover-scale-up scale-down">
                        </a>
                    </div>
                    <div class="col-auto text-center">
                        <a href="https://wa.me/584166960017?text=Hola!%20Me%20gustaria%20colaborar%20con%20la%20fundaci%C3%B3n:%20%5Bsu%20mensaje%20aqu%C3%AD%5D" target="_blank">
                        <img src="images/WhatsApp.png" class="img-fluid hover-scale-up scale-down">
                        </a>
                    </div>
                </div>
                <div class="row pt-5 justify-content-center align-items-center">
                    <div class="col-auto pt-3">
                        <p class="tex-center fs-6 text-light">(Para formar parte de la fundación y obtener un usuario contáctanos)</p>
                    </div>
                </div>
                <div class="row p-3 justify-content-center align-items-center">
                    <div class="col-auto hover-scale-up">
                        <a href="pages/faq.html.php" class="tex-center fs-6 text-light">Preguntas frecuentes</a>
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
        <script>
        document.getElementById('btnTelefono').addEventListener('click', function(e) {
            e.stopPropagation();
            var div = document.getElementById('divTelefonos');
            div.style.display = (div.style.display === 'none' || div.style.display === '') ? 'block' : 'none';
        });
        document.addEventListener('click', function(e) {
            var div = document.getElementById('divTelefonos');
            if (div && div.style.display === 'block') {
                div.style.display = 'none';
            }
        });
        </script>
    </body>
</html>
