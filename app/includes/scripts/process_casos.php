<?php

session_start();

require_once __DIR__ . '/../classes/database.php';
require_once __DIR__ . '/../classes/caso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'insert') {
    if (($_POST['current_module'] ?? '') !== 'Casos') {
        header("Location: ../../app/includes/mainPanel.php");
        exit;
    }

    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $ubicacion = htmlspecialchars($_POST['ubicacion'] ?? '');
    $estado = $_POST['estado'] ?? '';
    $fecha = $_POST['fecha'] ?? date('Y-m-d');
    $colaborador = $_POST['colaborador'] ?? '';
    $idAnimal = $_POST['animal'] ?? null; 

    if (empty($nombre) || empty($ubicacion) || empty($estado) || empty($colaborador) || empty($fecha) || empty($idAnimal)) {
        $_SESSION['casos_error'] = "Todos los campos obligatorios deben ser completados";
        header("Location: ../../public/pages/mainPanel.html.php?module=Casos");
        exit();
    }

    Database::connect();
    
    if (!Database::$connected) {
        $_SESSION['casos_error'] = "Error de conexión a la base de datos";
        header("Location: ../../public/pages/mainPanel.html.php?module=Casos");
        exit();
    }

    try {
        Database::$pdo->beginTransaction();

        $queryCaso = "INSERT INTO casos (nombre, ubicacion, fecha_de_apertura, estado) 
                      VALUES (:nombre, :ubicacion, :fecha, :estado)";
        $stmtCaso = Database::$pdo->prepare($queryCaso);
        $stmtCaso->execute([
            ':nombre' => $nombre,
            ':ubicacion' => $ubicacion,
            ':fecha' => $fecha,
            ':estado' => $estado
        ]);
        
        $idCaso = Database::$pdo->lastInsertId();

        $queryRel = "INSERT INTO reportes_casos_colaboradores (cedula_colaborador, id_caso) 
                     VALUES (:colaborador, :idCaso)";
        $stmtRel = Database::$pdo->prepare($queryRel);
        $stmtRel->execute([
            ':colaborador' => $colaborador,
            ':idCaso' => $idCaso
        ]);

        if (!empty($idAnimal)) {
            $queryUpdateAnimal = "UPDATE animales SET id_caso = :idCaso WHERE id = :idAnimal";
            $stmtUpdateAnimal = Database::$pdo->prepare($queryUpdateAnimal);
            $stmtUpdateAnimal->execute([
                ':idCaso' => $idCaso,
                ':idAnimal' => $idAnimal
            ]);
        }

        Database::$pdo->commit();

        $_SESSION['casos_message'] = "Caso registrado exitosamente! ID: $idCaso";
    } catch (PDOException $e) {
        if (Database::$pdo->inTransaction()) {
            Database::$pdo->rollBack();
        }
        
        $errorMessage = "Error al registrar caso";
        
        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
            $errorMessage .= ": " . $e->getMessage();
        }
        
        $_SESSION['casos_error'] = $errorMessage;
    } catch (Exception $e) {
        $_SESSION['casos_error'] = "Error inesperado: " . $e->getMessage();
    }

    header("Location: ../../public/pages/mainPanel.html.php?module=Casos");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'update') {
    $casoId = $_POST['casoId'] ?? 0;
    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $ubicacion = htmlspecialchars($_POST['ubicacion'] ?? '');
    $estado = $_POST['estado'] ?? '';
    $fecha = $_POST['fecha'] ?? date('Y-m-d');
    $colaborador = $_POST['colaborador'] ?? '';

    if (empty($nombre) || empty($ubicacion) || empty($estado) || empty($colaborador) || empty($fecha) || empty($casoId)) {
        $_SESSION['casos_error'] = "Todos los campos obligatorios deben ser completados";
        header("Location: /Mascotisla/public/pages/mainPanel.html.php?module=Casos");
        exit();
    }

    Database::connect();
    
    if (!Database::$connected) {
        $_SESSION['casos_error'] = "Error de conexión a la base de datos";
        header("Location: /Mascotisla/public/pages/mainPanel.html.php?module=Casos");
        exit();
    }

    try {
        Database::$pdo->beginTransaction();

        $queryCaso = "UPDATE casos 
                      SET nombre = :nombre, ubicacion = :ubicacion, 
                          fecha_de_apertura = :fecha, estado = :estado 
                      WHERE id = :id";
        $stmtCaso = Database::$pdo->prepare($queryCaso);
        $stmtCaso->execute([
            ':nombre' => $nombre,
            ':ubicacion' => $ubicacion,
            ':fecha' => $fecha,
            ':estado' => $estado,
            ':id' => $casoId
        ]);

        $queryDeleteRel = "DELETE FROM reportes_casos_colaboradores WHERE id_caso = :idCaso";
        $stmtDeleteRel = Database::$pdo->prepare($queryDeleteRel);
        $stmtDeleteRel->execute([':idCaso' => $casoId]);
        
        $queryRel = "INSERT INTO reportes_casos_colaboradores (cedula_colaborador, id_caso) 
                     VALUES (:colaborador, :idCaso)";
        $stmtRel = Database::$pdo->prepare($queryRel);
        $stmtRel->execute([
            ':colaborador' => $colaborador,
            ':idCaso' => $casoId
        ]);


        Database::$pdo->commit();

        $_SESSION['casos_message'] = "Caso actualizado exitosamente!";
    } catch (PDOException $e) {

        if (Database::$pdo->inTransaction()) {
            Database::$pdo->rollBack();
        }
        
        $errorMessage = "Error al actualizar caso";
        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
            $errorMessage .= ": " . $e->getMessage();
        }
        
        $_SESSION['casos_error'] = $errorMessage;
    } catch (Exception $e) {
        $_SESSION['casos_error'] = "Error inesperado: " . $e->getMessage();
    }

    header("Location: /Mascotisla/public/pages/mainPanel.html.php?module=Casos");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'delete') {
    $casoId = $_POST['casoId'] ?? 0;

    if (empty($casoId)) {
        $_SESSION['casos_error'] = "ID de caso inválido";
        header("Location: ../../public/pages/mainPanel.html.php?module=Casos");
        exit();
    }

    Database::connect();

    if (!Database::$connected) {
        $_SESSION['casos_error'] = "Error de conexión a la base de datos";
        header("Location: ../../public/pages/mainPanel.html.php?module=Casos");
        exit();
    }

    try {
        Database::$pdo->beginTransaction();

        $queryDesvincularAnimales = "UPDATE animales SET id_caso = NULL WHERE id_caso = :casoId";
        $stmtDesvincular = Database::$pdo->prepare($queryDesvincularAnimales);
        $stmtDesvincular->execute([':casoId' => $casoId]);

        $queryEliminarReportes = "DELETE FROM reportes_casos_colaboradores WHERE id_caso = :casoId";
        $stmtReportes = Database::$pdo->prepare($queryEliminarReportes);
        $stmtReportes->execute([':casoId' => $casoId]);

        $queryEliminarCaso = "DELETE FROM casos WHERE id = :casoId";
        $stmtCaso = Database::$pdo->prepare($queryEliminarCaso);
        $stmtCaso->execute([':casoId' => $casoId]);

        Database::$pdo->commit();

        $_SESSION['casos_message'] = "Caso eliminado exitosamente!";
    } catch (PDOException $e) {
        if (Database::$pdo->inTransaction()) {
            Database::$pdo->rollBack();
        }
        $errorMessage = "Error al eliminar el caso";
        if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
            $errorMessage .= ": " . $e->getMessage();
        }
        $_SESSION['casos_error'] = $errorMessage;
    }

    header("Location: /Mascotisla/public/pages/mainPanel.html.php?module=Casos");
    exit();
}


header("Location: ../../app/includes/mainPanel.php");
exit();
?>