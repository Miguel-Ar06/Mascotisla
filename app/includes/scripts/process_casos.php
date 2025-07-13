<?php
// 1. Verificar que estamos en el módulo de Casos
if (($_POST['current_module'] ?? '') !== 'Casos') {
    header("Location: ../../app/includes/mainPanel.php");
    exit;
}

// 2. Iniciar sesión
session_start();

// 3. Incluir clases necesarias
require_once __DIR__ . '/../classes/database.php';
require_once __DIR__ . '/../classes/caso.php';

// 4. Procesar operación de inserción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['operation'] ?? '') === 'insert') {
    // Recoger y sanitizar datos
    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $ubicacion = htmlspecialchars($_POST['ubicacion'] ?? '');
    $estado = $_POST['estado'] ?? '';
    $fecha = $_POST['fecha'] ?? date('Y-m-d');
    $colaborador = $_POST['colaborador'] ?? '';

    // Validaciones básicas
    if (empty($nombre) || empty($ubicacion) || empty($estado) || empty($colaborador) || empty($fecha)) {
        $_SESSION['casos_error'] = "Todos los campos obligatorios deben ser completados";
        header("Location: ../../app/includes/mainPanel.php?module=Casos");
        exit();
    }

    // Conexión a la base de datos
    Database::connect();
    
    if (!Database::$connected) {
        $_SESSION['casos_error'] = "Error de conexión a la base de datos";
        header("Location: ../../app/includes/mainPanel.php?module=Casos");
        exit();
    }

    try {
        // Iniciar transacción
        Database::$pdo->beginTransaction();

        // 1. Insertar el caso
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

        // 2. Insertar relación con colaborador
        $queryRel = "INSERT INTO reportes_casos_colaboradores (cedula_colaborador, id_caso) 
                     VALUES (:colaborador, :idCaso)";
        $stmtRel = Database::$pdo->prepare($queryRel);
        $stmtRel->execute([
            ':colaborador' => $colaborador,
            ':idCaso' => $idCaso
        ]);

        // Confirmar transacción
        Database::$pdo->commit();

        $_SESSION['casos_message'] = "Caso registrado exitosamente! ID: $idCaso";
    } catch (PDOException $e) {
        // Revertir en caso de error
        if (Database::$pdo->inTransaction()) {
            Database::$pdo->rollBack();
        }
        
        // Mensaje de error amigable
        $errorMessage = "Error al registrar caso";
        
        // Detalles para depuración (solo en desarrollo)
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

// Si llega aquí sin procesar, redirigir
header("Location: ../../app/includes/mainPanel.php");
exit();
?>