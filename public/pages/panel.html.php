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
    <title>Panel Principal</title>

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
    <!-- 
        Aqui va a todo el codigo asqueroso para la interfaz de miembro y admin, la idea es que sea una 
        sola ventana comun con el mismo header y el mismo footer, pero dependiendo de si es admin o no
        se muestran controles adicionales y tablas adicionales, todo eso con la magia de phpsito
    -->

    <header>
        <?php 
            require __DIR__ . '/../../app/templates/header.html.php'; 
        ?>
    </header>

    <main>

    </main>

    <footer>

    </footer>
</body>
</html>