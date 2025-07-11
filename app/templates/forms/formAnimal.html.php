<form id="formAnimal" action="" method="POST">
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Nombre del animal (opcional)</label>
            <input type="text" name="tbNombre" class="form-control border border-dark">
        </div>
        <div class="col-md-4">
            <label class="form-label">Condición</label>
            <select name="ddCondicion" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="sano">Sano</option>
                <option value="enfermo">Enfermo</option>
                <option value="lesionado">Lesionado</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <label class="form-label">Sexo</label>
            <select name="ddSexo" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Fecha de nacimiento</label>
            <input type="date" name="tbFechaNacimiento" class="form-control border border-dark">
        </div>
        <div class="col-md-3">
            <label class="form-label">Estado</label>
            <select name="ddEstado" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="adoptado">Adoptado</option>
                <option value="en_adopcion">En adopción</option>
                <option value="perdido">Perdido</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <label class="form-label">Especie</label>
            <select name="ddEspecie" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Raza</label>
            <input type="text" name="tbRaza" class="form-control border border-dark">
        </div>
        <div class="col-md-3">
            <label class="form-label">ID del caso asignado</label>
            <input type="text" name="tbIdCaso" class="form-control border border-dark">
        </div>
        <div class="col-md-3">
            <label class="form-label">Cédula del colaborador</label>
            <input type="text" name="tbCedulaColaborador" class="form-control border border-dark">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <button type="submit" name="btBuscar" class="btn btn-info text-white me-2">Buscar</button>
            <button type="submit" name="btRegistrar" class="btn btn-success me-2">Registrar</button>
            <button type="submit" name="btActualizar" class="btn btn-primary">Actualizar datos</button>
        </div>
    </div>
</form>