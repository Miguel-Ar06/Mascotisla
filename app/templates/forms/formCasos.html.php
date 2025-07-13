<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Gestión de Casos</h5>
    </div>
    <div class="card-body">
        <form id="formCasos" action="" method="POST">
            <!-- Campos ocultos esenciales -->
            <input type="hidden" name="current_module" value="Casos">
            <input type="hidden" name="operation" value="insert">

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
                        <option value="">Seleccionar...</option>
                        <option value="abierto">Abierto</option>
                        <option value="en_proceso">En proceso</option>
                        <option value="cerrado">Cerrado</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Animal</label>
                    <select name="animal" class="form-select border border-dark">
                        <option value="">Seleccionar...</option>
                        <option value="Gauss">Gauss</option>
                        <option value="Pablo Pancho">Pablo Pancho</option>
                        <option value="Patroclo">Patroclo</option>
                        <option value="Adjetivo">Adjetivo</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Cédula Colaborador *</label>
                    <select name="colaborador" class="form-select border border-dark" required>
                        <option value="">Seleccionar...</option>
                        <option value="31648782">Angel Marin</option>
                        <option value="98765432">Miguel Arismendi</option>
                        <option value="45678912">Alejandro Hernández</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha del caso *</label>
                    <input type="date" name="fecha" class="form-control border border-dark" required>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success me-2">Registrar Caso</button>
                    <button type="reset" class="btn btn-secondary me-2">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
</div>