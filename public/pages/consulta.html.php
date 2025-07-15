<?php require_once __DIR__ . "/../../app/includes/classes/database.php"?>
<?php require __DIR__ . "/../../app/includes/tableLogic/tableAnimals.php"?>
<?php require __DIR__ . "/../../app/includes/formLogic/formAnimal.php";?>

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

        .accordion-item .accordion-collapse 
        {
            position: absolute; /* Takes the element out of normal flow */
            width: 100%; /* Ensures it spans the width of its parent (.accordion-wrapper) */
            z-index: 10; /* Ensures it appears above other content on the page */
            top: 100%; /* Positions it directly below the accordion header */
            left: 0; /* Aligns it to the left edge of its parent */

            /* Optional: Add styles for visual separation and readability */
            background-color: white; /* Essential to cover content behind it */
            border: 1px solid #000000ff; /* Matches your form's border style */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
            padding: 1rem; /* Add some padding around the content within the body */

            /* Optional: If content can be very long, make it scrollable */
            max-height: 250px; /* Limit the expanded height */
            overflow-y: auto; /* Add vertical scrollbar if content exceeds max-height */

            /* Ensure transitions are smooth */
            transition: height 0.35s ease; /* Adjust transition property if you need it to animate smoothly */
        }

        /* If you need to make space for content that comes *immediately* after the whole form
        and would be hidden by the accordion. This is usually managed by margins/paddings
        on the elements *outside* of the accordion. */
        .content-after-form 
        {
            margin-top: 250px;  /*Example: Add enough space for the accordion to overlap */
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

<form method="GET" class="mb-4">
    <div class="row justify-content-center p-5 gx-4 align-items-end">
        <!-- Filtro Nombre -->
        <div class="col-md-2">
            <label class="form-label">Nombre</label>
            <input type="text" name="tbName" class="form-control border border-dark" 
                   value="<?= htmlspecialchars($_GET['tbName'] ?? '') ?>">
        </div>
        
        <!-- Filtro Condición -->
        <div class="col-md-2">
            <label class="form-label">Condición</label>
            <select name="ddCondicion" class="form-select border border-dark">
                <option value="">Todo</option>
                <?php foreach($allConditions as $currentCondition): ?>
                    <option value="<?= $currentCondition ?>" 
                        <?= (($_GET['ddCondicion'] ?? '') === $currentCondition) ? 'selected' : '' ?>>
                        <?= $currentCondition ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        
        <!-- Filtro Sexo -->
        <div class="col-md-2">
            <label class="form-label">Sexo</label>
            <select name="ddSex" class="form-select border border-dark">
                <option value="">Todos</option>
                <option value="Macho" <?= (($_GET['ddSex'] ?? '') === "Macho") ? 'selected' : '' ?>>Macho</option>
                <option value="Hembra" <?= (($_GET['ddSex'] ?? '') === "Hembra") ? 'selected' : '' ?>>Hembra</option>
            </select>
        </div>
        
        <!-- Filtro Estados -->
        <div class="col-md-3">
            <label>Estado/s</label>
            <div class="accordion border border-dark" id="accordionStatus">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#collapseStatus" 
                                aria-expanded="false" aria-controls="collapseStatus">
                            Seleccionar estados
                        </button>
                    </h2>
                    <div id="collapseStatus" class="accordion-collapse collapse" 
                         data-bs-parent="#accordionStatus">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ckStatus[]" 
                                       value="Todo" id="checkAll"
                                       <?= in_array('Todo', $_GET['ckStatus'] ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="checkAll">Todo</label>
                            </div>
                            <?php foreach($allStatuses as $status): ?>
                                <div class="form-check">
                                    <input class="form-check-input status-check" type="checkbox" 
                                           name="ckStatus[]" value="<?= $status ?>" 
                                           id="status<?= $status ?>"
                                           <?= in_array($status, $_GET['ckStatus'] ?? []) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="status<?= $status ?>">
                                        <?= $status ?>
                                    </label>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Botón Buscar -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
</form>

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
        <!-- Script para manejar el checkbox "Todo" -->
        <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.status-check');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        document.querySelectorAll('.status-check').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    document.getElementById('checkAll').checked = false;
                } else {
                    // Verificar si todos están seleccionados
                    const allChecked = [...document.querySelectorAll('.status-check')]
                        .every(checkbox => checkbox.checked);
                        
                    document.getElementById('checkAll').checked = allChecked;
                }
            });
        });
        </script>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
