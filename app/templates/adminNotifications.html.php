<?php
include_once __DIR__ . '/../includes/classes/notificacionAdmin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marcarLeida'], $_POST['notificacionId'])) 
{
    $idNotif = intval($_POST['notificacionId']);
    NotificacionAdmin::marcarComoLeida($idNotif);
    echo '<div id="notif-leida-alert" class="alert alert-success">Notificación marcada como leída.</div>';
    echo '<script>setTimeout(function(){ var el = document.getElementById("notif-leida-alert"); if(el) el.style.display = "none"; }, 5000);</script>';
}

$notificaciones = NotificacionAdmin::obtenerTodas(true);
?>

<div id="panelNotificacionesAdmin" class="table-responsive mt-2 mb-4 p-3 border border-tertiary" style="background: #f5f5fa; border-radius: 12px; min-height: 60px; max-width: 100%;">
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
                                    