<?php require __DIR__ . "/../../app/includes/mainPanel.php"?>
<?php require __DIR__ . "/../../app/includes/formLogic/formColaborators.php" ?>

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

    <script src="../scripts/extendColaboratorForm.js"></script>

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

        html
        {
            height: 100%;
        }
    </style>

</head>
<body style="font-family: 'Montserrat'; display: flex; flex-direction: column; min-height: 100vh;">
    <header>
        <?php require __DIR__ . '/../../app/templates/mainPanelHeader.html.php'; ?>
    </header>

    <main style="flex-grow: 1;">
        <?php if ($_SESSION['module'] == "Colaboradores"): ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php require __DIR__ . '/../../app/templates/forms/formColaborators.html.php' ?>
                    </div>
                    <div class="col ms-5 me-0 pe-0">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <?php require __DIR__ . '/../../app/templates/tables/tablaColaboradores.html.php'; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php echo $_SESSION['message'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif ($_SESSION['module'] == "Animales"): ?>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form id="formAnimal" action="" method="POST">
                            <?php require __DIR__ . '/../../app/templates/forms/formAnimal.html.php'; ?>
                        </form>
                    </div>
                    <div class="col ms-5 me-0 pe-0">
                        <?php require __DIR__ . '/../../app/templates/tables/tableConsultaAnimales.html.php'; ?>
                    </div>
                </div>
            </div>
            
        <?php endif ?>
    </main>

    <footer>
        <?php include __DIR__ . '/../../app/templates/footer.html.php'; ?>
    </footer>
</body>
</html>