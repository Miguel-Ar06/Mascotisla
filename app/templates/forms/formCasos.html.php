<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Gestión de Casos</h5>
    </div>
    <div class="card-body">
        <form id="formCasos" action="" method="POST">
            <!-- Campos ocultos esenciales -->
            <input type="hidden" name="current_module" value="Casos">
            <input type="hidden" name="operation" value="insert">
            <input type="hidden" name="casoId" value="">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre del caso *</label>
                    <input type="text" name="nombre" class="form-control border border-dark" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ubicación *</label>
                    <input type="text" name="ubicacion" class="form-control border border-dark" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Estado *</label>
                    <select name="estado" class="form-select border border-dark" required>
                        <option selected disabled hidden value="">Seleccionar...</option>
                        <option value="abierto">Abierto</option>
                        <option value="en_proceso">En proceso</option>
                        <option value="cerrado">Cerrado</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Animal</label>
                    <select name="animal" id="animalSelect" class="form-select border border-dark">
                        <option value="">Seleccionar...</option>
                        <?php
                        // Obtener animales sin caso asignado
                        $animalesSinCaso = [];
                        if (Database::$connected) {
                            try {
                                $queryAnimales = "SELECT id, nombre FROM animales WHERE id_caso IS NULL";
                                $stmtAnimales = Database::$pdo->query($queryAnimales);
                                $animalesSinCaso = $stmtAnimales->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                error_log("Error al obtener animales: " . $e->getMessage());
                            }
                        }

                        foreach ($animalesSinCaso as $animal) {
                            echo '<option value="' . htmlspecialchars($animal['id']) . '">' . htmlspecialchars($animal['nombre']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Cédula Colaborador *</label>
                    <select name="colaborador" class="form-select border border-dark" required>
                        <option value="">Seleccionar...</option>
                        <?php
                        // Obtener todos los colaboradores
                        $colaboradores = [];
                        if (Database::$connected) {
                            try {
                                $queryColaboradores = "SELECT cedula, nombre, apellido FROM colaboradores";
                                $stmtColaboradores = Database::$pdo->query($queryColaboradores);
                                $colaboradores = $stmtColaboradores->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                error_log("Error al obtener colaboradores: " . $e->getMessage());
                            }
                        }

                        foreach ($colaboradores as $colab) {
                            $nombreCompleto = htmlspecialchars($colab['nombre'] . ' ' . $colab['apellido']);
                            echo '<option value="' . htmlspecialchars($colab['cedula']) . '">' . $nombreCompleto . ' (' . htmlspecialchars($colab['cedula']) . ')</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha del caso *</label>
                    <input type="date" name="fecha" class="form-control border border-dark" required>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" id="btnSubmit" class="btn btn-success me-2">Registrar Caso</button>
                    <button type="reset" class="btn btn-secondary me-2" id="btnReset">Limpiar</button>
                    <button type="button" class="btn btn-outline-secondary" id="btnCancelEdit" style="display:none;">
                        Cancelar Edición
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnCancelEdit = document.getElementById('btnCancelEdit');
    const btnReset = document.getElementById('btnReset');
    const btnSubmit = document.getElementById('btnSubmit');
    const form = document.getElementById('formCasos');
    const operationInput = document.querySelector('input[name="operation"]');
    const casoIdInput = document.querySelector('input[name="casoId"]');
    const animalSelect = document.getElementById('animalSelect');

    btnCancelEdit.addEventListener('click', function() {
        operationInput.value = 'insert';
        casoIdInput.value = '';
        btnSubmit.textContent = 'Registrar Caso';
        btnSubmit.classList.remove('btn-primary');
        btnSubmit.classList.add('btn-success');
        form.reset();
        btnCancelEdit.style.display = 'none';
        animalSelect.disabled = false;
    });

    btnReset.addEventListener('click', function() {
        operationInput.value = 'insert';
        casoIdInput.value = '';
        btnSubmit.textContent = 'Registrar Caso';
        btnSubmit.classList.remove('btn-primary');
        btnSubmit.classList.add('btn-success');
        btnCancelEdit.style.display = 'none';
        animalSelect.disabled = false;
    });
    

    operationInput.addEventListener('change', function() {
        if (this.value === 'update') {
            btnCancelEdit.style.display = 'inline-block';
        } else {
            btnCancelEdit.style.display = 'none';
        }
    });
});
</script>