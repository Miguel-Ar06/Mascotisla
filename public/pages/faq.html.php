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
        <title>Consulta animales</title>

        <style>
            .btn, input[type="button"], input[type="submit"], .hover-scale-up
            {
                transition: transform 0.3s ease-in-out;
            }

            .btn:hover, input[type="button"]:hover, input[type="submit"]:hover, .hover-scale-up:hover
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
                            Preguntas frecuentes (FaQ)
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

        <!-- faq.html.php -->
        <section class="container mt-5 mb-5">
        <div class="accordion border border-dark" id="faqAccordion" >
            
            <!-- Pregunta 1 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer1" aria-expanded="false" aria-controls="answer1">
                ¿Qué es Mascotisla?
                </button>
            </h2>
            <div id="answer1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Mascotisla es una plataforma de la Fundación PIM para registrar, consultar y gestionar casos de animales en situación vulnerable en la isla de Margarita.
                </div>
            </div>
            </div>

            <!-- Pregunta -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq9">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer9" aria-expanded="false" aria-controls="answer9">
                ¿Qué es PIM?
                </button>
            </h2>
            <div id="answer9" class="accordion-collapse collapse" aria-labelledby="faq9" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Proteccionistas Independientes de Margarita (PIM) es una fundación sin fines de lucro dedicada a velar y actuar por la salud, cuidado, rescate y adopcion de animales vulnerables en la isla de Margarita.
                Es una fundación que no se encuentra afiliada a ningún ente politico o gubernamental por lo que la colaboración de tanto miembros como terceros es de vital importancia.
                </div>
            </div>
            </div>


            <!-- Pregunta 2 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer2" aria-expanded="false" aria-controls="answer2">
                ¿Quién puede usar la plataforma?
                </button>
            </h2>
            <div id="answer2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Visitantes externos pueden consultar animales y comunicarse con la fundación. Miembros registrados tienen acceso para registrar y actualizar información. Administradores pueden gestionar colaboradores y controlar el sistema completo.
                </div>
            </div>
            </div>

            <!-- Pregunta 3 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer3" aria-expanded="false" aria-controls="answer3">
                ¿Cómo puedo ver los animales disponibles?
                </button>
            </h2>
            <div id="answer3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                En la sección “Consulta de animales” puede buscar por estado, especie, condición, y ver fotos de cada animal registrado.
                </div>
            </div>
            </div>

            <!-- Pregunta 4 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer4" aria-expanded="false" aria-controls="answer4">
                ¿Cómo puedo ayudar?
                </button>
            </h2>
            <div id="answer4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Puedes ayudar adoptando, donando, reportando animales, o ofreciendo un hogar temporal. Hay opciones de contacto directo con la fundación disponibles desde la página.
                </div>
            </div>
            </div>

            <!-- Pregunta 5 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer5" aria-expanded="false" aria-controls="answer5">
                ¿Necesito registrarme para usar el sistema?
                </button>
            </h2>
            <div id="answer5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Solo los miembros de la fundación necesitan iniciar sesión para acceder a las funciones de gestión. Los visitantes pueden explorar libremente.
                </div>
            </div>
            </div>

            <!-- Pregunta 6 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq6">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer6" aria-expanded="false" aria-controls="answer6">
                ¿Cómo se agregan fotos a los casos?
                </button>
            </h2>
            <div id="answer6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Los miembros pueden subir imágenes desde el módulo correspondiente, para el animal que estén ingresando .
                </div>
            </div>
            </div>

            <!-- Pregunta 7 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq7">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer7" aria-expanded="false" aria-controls="answer7">
                ¿Dónde puedo ver información de cada caso?
                </button>
            </h2>
            <div id="answer7" class="accordion-collapse collapse" aria-labelledby="faq7" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Cada caso tiene su ficha detallada en el módulo de gestión de casos, incluyendo estado, ubicación, animal involucrado y colaborador asignado.
                </div>
            </div>
            </div>

            <!-- Pregunta 8 -->
            <div class="accordion-item">
            <h2 class="accordion-header" id="faq8">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer8" aria-expanded="false" aria-controls="answer8">
                ¿Cómo me comunico con la fundación?
                </button>
            </h2>
            <div id="answer8" class="accordion-collapse collapse" aria-labelledby="faq8" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Desde la página de inicio puedes acceder a los medios de contacto o llenar un formulario. También puedes solicitar formar parte de la fundación.
                </div>
            </div>
            </div>

        </div>
        </section>

        <footer>
            <?php include __DIR__ . "/../../app/templates/footer.html.php" ?>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>

</html>