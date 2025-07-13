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
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col ms-3">
                        <div class="card">
                            <div class="card-header">
                                Gestión de colaboradores
                            </div>
                            <div class="card-body">
                                <?php require __DIR__ . '/../../app/templates/forms/formColaborators.html.php' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col ms-3 me-3 pe-0">
                        <div class="container">
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            Listado de colaboradores
                                        </div>
                                        <div class="card-body">
                                            <?php require __DIR__ . '/../../app/templates/tables/tablaColaboradores.html.php'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php echo $_SESSION['message'] ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    include_once __DIR__ . '/../../app/includes/classes/notificacionAdmin.php';
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marcarLeida'], $_POST['notificacionId'])) {
                                        $idNotif = intval($_POST['notificacionId']);
                                        NotificacionAdmin::marcarComoLeida($idNotif);
                                        echo '<div id="notif-leida-alert" class="alert alert-success">Notificación marcada como leída.</div>';
                                        echo '<script>setTimeout(function(){ var el = document.getElementById("notif-leida-alert"); if(el) el.style.display = "none"; }, 5000);</script>';
                                    }
                                    $notificaciones = NotificacionAdmin::obtenerTodas(true);
                                    ?>
                                    <div id="panelNotificacionesAdmin" class="table-responsive mt-2 mb-4 p-3" style="background: #f5f5fa; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); min-height: 60px; max-width: 100%;">
                                        <h5 class="mb-2">Panel de Notificaciones de Administrador</h5>
                                        <div id="notificacionesAdmin">
                                            <?php if (empty($notificaciones)): ?>
                                                <div class="alert alert-secondary m-0">No hay notificaciones nuevas.</div>
                                            <?php else: ?>
                                                <?php foreach ($notificaciones as $notif): ?>
                                                    <div class="alert alert-info mb-2 d-flex justify-content-between align-items-center" style="background: #eaf4fb; border-radius: 8px; border: 1px solid #b6d4fe;">
                                                        <div>
                                                            <strong><?= htmlspecialchars($notif->titulo) ?></strong><br>
                                                            <?= htmlspecialchars($notif->mensaje) ?>
                                                            <div class="text-end text-muted" style="font-size: 0.85em;"><?= date('d/m/Y H:i', strtotime($notif->fecha)) ?></div>
                                                        </div>
                                                        <form method="post" style="margin-left: 16px;">
                                                            <input type="hidden" name="notificacionId" value="<?= $notif->id ?>">
                                                            <button type="submit" name="marcarLeida" class="btn btn-sm btn-success">Leído</button>
                                                        </form>
                                                    </div>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
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
        <?php endif ?>

    </main>

    <footer>
        <?php include __DIR__ . '/../../app/templates/footer.html.php'; ?>
    </footer>
</body>
</html>