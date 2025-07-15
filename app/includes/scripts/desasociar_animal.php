<?php
session_start();

require_once __DIR__ . '/../classes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animalId = $_POST['animalId'] ?? 0;
    $casoId = $_POST['casoId'] ?? 0;

    if (!$animalId) {
        $_SESSION['casos_error'] = "ID de animal inválido";
        header("Location: /Mascotisla/public/pages/detalleCaso.html.php?casoId=$casoId");
        exit();
    }

    Database::connect();

    if (!Database::$connected) {
        $_SESSION['casos_error'] = "Error de conexión a la base de datos";
        header("Location: /Mascotisla/public/pages/detalleCaso.html.php?casoId=$casoId");
        exit();
    }

    try {
    // Actualizar el animal para asignarlo al caso
    $stmt = Database::$pdo->prepare(
        "UPDATE animales 
         SET id_caso = null 
         WHERE id = ?"
    );
    $stmt->execute([$animalId]);

    $_SESSION['casos_message'] = "Animal asociado correctamente al caso";
} catch (PDOException $e) {
    $_SESSION['casos_error'] = "Error al asociar el animal: " . $e->getMessage();
}

    header("Location: /Mascotisla/public/pages/detalleCaso.html.php?casoId=$casoId");
    exit();
}

// Si no es POST, redirigir
header("Location: /Mascotisla/public/pages/mainPanel.html.php?module=Casos");
exit();