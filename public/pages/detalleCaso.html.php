<?php
require_once __DIR__ . '/../../app/includes/classes/database.php';
require_once __DIR__ . '/../../app/includes/classes/caso.php';

session_start();

// Obtener el ID del caso de la URL
$casoId = $_GET['casoId'] ?? 0;

Database::connect();

if (!Database::$connected) {
    die("Error de conexión a la base de datos");
}

// Obtener información del caso
$caso = [];
$colaboradorReporte = null;
$animalesAsociados = [];

try {
    // Obtener datos del caso
    $stmtCaso = Database::$pdo->prepare("SELECT * FROM casos WHERE id = ?");
    $stmtCaso->execute([$casoId]);
    $caso = $stmtCaso->fetch(PDO::FETCH_ASSOC);

    if (!$caso) {
        die("Caso no encontrado");
    }

    // Obtener colaborador que reportó el caso
    $stmtColab = Database::$pdo->prepare(
        "SELECT c.cedula, c.nombre, c.apellido 
         FROM reportes_casos_colaboradores r
         JOIN colaboradores c ON r.cedula_colaborador = c.cedula
         WHERE r.id_caso = ?"
    );
    $stmtColab->execute([$casoId]);
    $colaboradorReporte = $stmtColab->fetch(PDO::FETCH_ASSOC);

    // Obtener animales asociados al caso
    $stmtAnimales = Database::$pdo->prepare(
    "SELECT a.id, a.nombre, a.especie, a.raza, a.sexo, a.fecha_de_nacimiento, 
        co.condicion AS condicion
        FROM animales a
        JOIN condiciones co ON a.id_condicion = co.id
        WHERE a.id_caso = ?"
    );
    $stmtAnimales->execute([$casoId]);
    $animalesAsociados = $stmtAnimales->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Obtener animales sin caso asignado
$animalesSinCaso = [];
try {
    $stmtAnimalesSinCaso = Database::$pdo->query(
        "SELECT id, nombre, especie, raza 
         FROM animales 
         WHERE id_caso IS NULL"
    );
    $animalesSinCaso = $stmtAnimalesSinCaso->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejar error
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Caso</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Información del caso</h1>
        <p><strong>Caso:</strong> <?= htmlspecialchars($caso['nombre']) ?></p>
        <p><strong>Reportado por:</strong> 
            <?= $colaboradorReporte ? htmlspecialchars($colaboradorReporte['nombre'] . ' ' . $colaboradorReporte['apellido']) : 'No encontrado' ?>
        </p>
        
        <hr>
        
        <h2>Agregar animal al caso</h2>
        <form action="../../app/includes/scripts/process_asociar_animal_caso.php" method="POST">
            <input type="hidden" name="casoId" value="<?= $casoId ?>">
            <div class="form-group">
                <label for="animalId">Seleccionar animal</label>
                <select name="animalId" id="animalId" class="form-control" required>
                    <option value="">Seleccionar animal...</option>
                    <?php foreach ($animalesSinCaso as $animal): ?>
                        <option value="<?= htmlspecialchars($animal['id']) ?>">
                            <?= htmlspecialchars($animal['nombre']) ?> 
                            (Especie: <?= htmlspecialchars($animal['especie']) ?> - 
                            Raza: <?= htmlspecialchars($animal['raza']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Añadir al caso</button>
        </form>
        
        <hr>
        
        <h2>Animales asociados</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Especie</th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Sexo</th>
                    <th>Nacimiento</th>
                    <th>Condición</th>
                    <th>Fotos</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($animalesAsociados)): ?>
                    <tr>
                        <td colspan="9" class="text-center">No hay animales asociados a este caso.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($animalesAsociados as $animal): ?>
                        <tr>
                            <td><?= htmlspecialchars($animal['id']) ?></td>
                            <td><?= htmlspecialchars($animal['especie']) ?></td>
                            <td><?= htmlspecialchars($animal['nombre']) ?></td>
                            <td><?= htmlspecialchars($animal['raza']) ?></td>
                            <td><?= htmlspecialchars($animal['sexo']) ?></td>
                            <td><?= htmlspecialchars($animal['fecha_de_nacimiento']) ?></td>
                            <td><?= htmlspecialchars($animal['condicion']) ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">Ver fotos</a>
                            </td>
                            <td>
                                <form action="../../app/includes/scripts/desasociar_animal.php" method="POST">
                                    <input type="hidden" name="animalId" value="<?= $animal['id'] ?>">
                                    <input type="hidden" name="casoId" value="<?= $casoId ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        
        <a href="mainPanel.html.php?module=Casos" class="btn btn-secondary">Volver</a>
    </div>
</body>
</html>