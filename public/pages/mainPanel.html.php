<?php 


require __DIR__ . "/../../app/includes/mainPanel.php";
require __DIR__ . "/../../app/includes/formLogic/formColaborators.php";

// --- MANEJO DE FORMULARIOS MEJORADO ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['current_module'])) {
    // Determinar qué módulo está activo basado en el campo oculto
    $currentModule = $_POST['current_module'] ?? '';
    
    // Procesar según el módulo activo
    if ($currentModule === 'Casos') {
        require_once __DIR__ . '/../../app/includes/scripts/process_casos.php';
        exit;
    }
    // Agregar aquí otros módulos si es necesario
}
// --- FIN DEL MANEJO DE FORMULARIOS ---
?>
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
        button, .btn, input[type="button"], input[type="submit"], .hover-scale-up {
            transition: transform 0.3s ease-in-out;
        }

        button:hover, .btn:hover, input[type="button"]:hover, input[type="submit"]:hover, .hover-scale-up:hover {
            transform: scale(1.1);
        }
        
        .scale-down {
            height: auto;
            width: 60%;
        }

        html {
            height: 100%;
        }
        
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: 350px;
        }
    </style>

</head>
<body style="font-family: 'Montserrat'; display: flex; flex-direction: column; min-height: 100vh;">
    <!-- Contenedor para alertas flotantes -->
    <div class="alert-container">
        <?php if (isset($_SESSION['casos_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $_SESSION['casos_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['casos_message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['casos_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $_SESSION['casos_error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['casos_error']); ?>
        <?php endif; ?>
    </div>

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
                                    <?= $_SESSION['message'] ?? '' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION['module'] == "Animales"): ?>
            <div class="container mt-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <?php require __DIR__ . '/../../app/templates/forms/formAnimal.html.php'; ?>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <?php require __DIR__ . '/../../app/templates/tables/tableConsultaAnimales.html.php'; ?>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION['module'] == "Casos"): ?>
            <div class="container mt-4">
                <div class="row">
                    <!-- Formulario a la izquierda -->
                    <div class="col-md-5 pe-4">
                        <?php require __DIR__ . '/../../app/templates/forms/formCasos.html.php'; ?>
                    </div>
                    
                    <!-- Tabla a la derecha -->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0">Listado de Casos</h5>
                            </div>
                            <div class="card-body p-0">
                                <?php require __DIR__ . '/../../app/templates/tables/tablaCasos.html.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <?php include __DIR__ . '/../../app/templates/footer.html.php'; ?>
    </footer>

    <!-- Script de Bootstrap para alertas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>