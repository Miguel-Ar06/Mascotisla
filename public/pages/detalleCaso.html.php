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
    <link rel="icon" href="../images/Logo Favicon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header propio -->
    <nav class="navbar navbar-dark" style="background-color: #343a40; margin-bottom: 1.5rem;">
        <span class="navbar-brand mb-0 h1">Detalle del Caso</span>
    </nav>

    <div class="container mt-4">
        <!-- Información del caso con diseño personalizado -->
        <div class="rounded shadow-sm p-4 mb-4" style="background: linear-gradient(90deg, #e3e6ed 80%, #f8f9fa 100%); border-left: 8px solid #343a40;">
            <h1 class="mb-3" style="color:#343a40; font-weight:bold;">Información del caso</h1>
            <p><strong>Caso:</strong> <span style="color:#343a40;"><?= htmlspecialchars($caso['nombre']) ?></span></p>
            <p><strong>Reportado por:</strong> 
                <span style="color:#343a40;"><?= $colaboradorReporte ? htmlspecialchars($colaboradorReporte['nombre'] . ' ' . $colaboradorReporte['apellido']) : 'No encontrado' ?></span>
            </p>
        </div>

        <!-- Agregar animal al caso con diseño personalizado -->
        <div class="rounded shadow-sm p-4 mb-4" style="background: linear-gradient(90deg, #f8f9fa 80%, #e3e6ed 100%); border-left: 8px solid #28a745;">
            <h2 class="mb-3" style="color:#28a745; font-weight:bold;">Agregar animal al caso</h2>
            <form action="../../app/includes/scripts/process_asociar_animal_caso.php" method="POST">
                <input type="hidden" name="casoId" value="<?= $casoId ?>">
                <div class="form-group mb-3">
                    <label for="animalId" style="font-weight:500;">Seleccionar animal</label>
                    <select name="animalId" id="animalId" class="form-control" required>
                        <option value="">Seleccionar animal...</option>
                        <?php foreach ($animalesSinCaso as $animal): ?>
                            <option value="<?= htmlspecialchars($animal['id']) ?>">
                                <?= htmlspecialchars($animal['nombre']) ?> 
                                (<?= htmlspecialchars($animal['especie']) ?> - 
                                <?= htmlspecialchars($animal['raza']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Añadir al caso</button>
            </form>
        </div>
        
        <hr>
        
        <h2>Animales asociados</h2>
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                <!-- Eliminado el texto de la barra negra -->
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-striped mb-0">
                        <thead style="position: sticky; top: 0;">
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
                                    <td colspan="9" class="text-center text-muted py-3 bg-light">
                                        No hay animales asociados a este caso.
                                    </td>
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
                                            <form action="<?php echo __DIR__ . '/../../app/includes/scripts/desasociar_animal.php'; ?>" method="POST">
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
                </div>
            </div>
        </div>
        
        <a href="mainPanel.html.php?module=Casos" class="btn btn-secondary">Volver</a>
    </div>

    <!-- Footer propio -->
    <footer>
        <?php include __DIR__ . '/../../app/templates/footer.html.php'; ?>
    </footer>
</body>
</html>