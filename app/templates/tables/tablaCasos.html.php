<?php
require_once __DIR__ . "/../../includes/classes/database.php";

// Obtener casos de la base de datos
Database::connect();

// Manejar errores de conexión
if (!Database::$connected) {
    echo '<div class="alert alert-danger">Error de conexión a la base de datos</div>';
    $casos = [];
} else {
    // Consulta segura con manejo de errores
    try {
        $query = "SELECT c.id, c.nombre, c.estado, c.ubicacion, c.fecha_de_apertura 
                  FROM casos c
                  ORDER BY c.fecha_de_apertura DESC";
        $stmt = Database::$pdo->query($query);
        $casos = $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Error al obtener casos: ' . htmlspecialchars($e->getMessage()) . '</div>';
        $casos = [];
    }
}
?>

<div class="container table-responsive" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-striped table-hover">
        <thead style="position: sticky; top: 0; background-color: white; z-index: 10;">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Estado</th>
                <th scope="col">Ver</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php if (empty($casos)): ?>
                <tr>
                    <td colspan="6" class="text-center py-4">No hay casos registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($casos as $caso): 
                    // Determinar clase según estado
                    $badgeClass = match($caso['estado']) {
                        'abierto' => 'bg-success',
                        'en_proceso' => 'bg-warning',
                        'cerrado' => 'bg-secondary',
                        default => 'bg-info'
                    };
                ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($caso['id'] ?? '') ?></th>
                        <td><?= htmlspecialchars($caso['nombre'] ?? '') ?></td>
                        <td>
                            <span class="badge <?= $badgeClass ?>">
                                <?= htmlspecialchars($caso['estado'] ?? '') ?>
                            </span>
                        </td>
                        <td>
                            <form action="detalle_caso.php" method="GET">
                                <input type="hidden" name="casoId" value="<?= $caso['id'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Ver</button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm btn-edit" 
                                data-id="<?= $caso['id'] ?>"
                                data-nombre="<?= htmlspecialchars($caso['nombre']) ?>"
                                data-ubicacion="<?= htmlspecialchars($caso['ubicacion']) ?>"
                                data-estado="<?= htmlspecialchars($caso['estado']) ?>"
                                data-fecha="<?= $caso['fecha_de_apertura'] ?>">
                                Editar
                            </button>
                        </td>
                        <td>
                            <form action="../../app/includes/scripts/process_casos.php" method="POST" 
                                onsubmit="return confirm('¿Está seguro de eliminar este caso?');">
                                <input type="hidden" name="operation" value="delete">
                                <input type="hidden" name="casoId" value="<?= $caso['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar clic en botones de edición
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const ubicacion = this.getAttribute('data-ubicacion');
            const estado = this.getAttribute('data-estado');
            const fecha = this.getAttribute('data-fecha');
            
            // Llenar el formulario con los datos del caso
            document.querySelector('input[name="nombre"]').value = nombre;
            document.querySelector('input[name="ubicacion"]').value = ubicacion;
            document.querySelector('select[name="estado"]').value = estado;
            document.querySelector('input[name="fecha"]').value = fecha;
            
            // Cambiar operación a actualización
            document.querySelector('input[name="operation"]').value = 'update';
            document.querySelector('input[name="casoId"]').value = id;
            
            // Inhabilitar combo de animales
            document.getElementById('animalSelect').disabled = true;
            
            // Cambiar texto y estilo del botón de submit
            const btnSubmit = document.getElementById('btnSubmit');
            btnSubmit.textContent = 'Guardar cambios';
            btnSubmit.classList.remove('btn-success');
            btnSubmit.classList.add('btn-primary');
            
            // Mostrar botón de cancelar
            document.getElementById('btnCancelEdit').style.display = 'inline-block';
            
            // Desplazar a la sección del formulario
            document.querySelector('#formCasos').scrollIntoView({ behavior: 'smooth' });
        });
    });
});
</script>