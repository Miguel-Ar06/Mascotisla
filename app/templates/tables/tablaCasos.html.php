<?php
require_once __DIR__ . "/../../includes/classes/database.php";

Database::connect();

if (!Database::$connected) {
    echo '<div class="alert alert-danger">Error de conexión a la base de datos</div>';
    $casos = [];
} else {
    try {
        $query = "SELECT c.id, c.nombre, 
                  CASE WHEN c.estado = 1 THEN 'abierto' ELSE 'cerrado' END as estado, 
                  c.ubicacion, c.fecha_de_apertura,
                  (SELECT r.cedula_colaborador 
                   FROM reportes_casos_colaboradores r 
                   WHERE r.id_caso = c.id LIMIT 1) as colaborador
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
                    $badgeClass = match(strtolower($caso['estado'])) {
                        'abierto' => 'bg-success',
                        'cerrado' => 'bg-secondary',
                        default => 'bg-info'
                    };
                ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($caso['id'] ?? '') ?></th>
                        <td><?= htmlspecialchars($caso['nombre'] ?? '') ?></td>
                        <td>
                            <span class="badge <?= $badgeClass ?>">
                                <?= ucfirst(htmlspecialchars($caso['estado'] ?? '')) ?>
                            </span>
                        </td>
                        <td>
                            <form action="../../public/pages/detalleCaso.html.php" method="GET">
                                <input type="hidden" name="casoId" value="<?= $caso['id'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Ver</button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm btn-edit" 
                                data-id="<?= $caso['id'] ?>"
                                data-nombre="<?= htmlspecialchars($caso['nombre']) ?>"
                                data-ubicacion="<?= htmlspecialchars($caso['ubicacion']) ?>"
                                data-estado="<?= strtolower($caso['estado']) === 'abierto' ? 'abierto' : 'cerrado' ?>"
                                data-fecha="<?= $caso['fecha_de_apertura'] ?>"
                                data-colaborador="<?= $caso['colaborador'] ?>">
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
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const ubicacion = this.getAttribute('data-ubicacion');
            const estado = this.getAttribute('data-estado');
            const fecha = this.getAttribute('data-fecha');
            const colaborador = this.getAttribute('data-colaborador');

            document.querySelector('input[name="nombre"]').value = nombre;
            document.querySelector('input[name="ubicacion"]').value = ubicacion;
            document.querySelector('select[name="estadoCaso"]').value = estado;
            document.querySelector('input[name="fecha"]').value = fecha;
            document.querySelector('select[name="colaborador"]').value = colaborador;
            
            document.querySelector('input[name="operation"]').value = 'update';
            document.querySelector('input[name="casoId"]').value = id;

            document.getElementById('animalSelect').disabled = true;
            
            const btnSubmit = document.getElementById('btnSubmit');
            btnSubmit.textContent = 'Guardar cambios';
            btnSubmit.classList.remove('btn-success');
            btnSubmit.classList.add('btn-primary');
            
            document.getElementById('btnCancelEdit').style.display = 'inline-block';
            
            document.querySelector('#formCasos').scrollIntoView({ behavior: 'smooth' });
        });
    });
});
</script>