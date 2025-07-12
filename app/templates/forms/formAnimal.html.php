<div class="container ps-0 ms-0">
    <div class="row">
        <div class="col-4">
            <label for="tbNombre" class="form-label text-black">Nombre del animal (opcional)</label>
            <input type="text" name="tbNombre" class="form-control border border-dark">
        </div>
        <div class="col">
            <label for="ddCondicion" class="form-label text-black">Condición</label>
            <select name="ddCondicion" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="sano">Sano</option>
                <option value="enfermo">Enfermo</option>
                <option value="lesionado">Lesionado</option>
            </select>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-3">
            <label for="ddSexo" class="form-label text-black">Sexo</label>
            <select name="ddSexo" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
            </select>
        </div>
        <div class="col-3">
            <label for="tbFechaNacimiento" class="form-label text-black">Fecha de nacimiento</label>
            <input type="date" name="tbFechaNacimiento" class="form-control border border-dark">
        </div>
        <div class="col-3">
            <label for="ddEstado" class="form-label text-black">Estado</label>
            <select name="ddEstado" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="adoptado">Adoptado</option>
                <option value="en_adopcion">En adopción</option>
                <option value="perdido">Perdido</option>
            </select>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-3">
            <label for="ddEspecie" class="form-label text-black">Especie</label>
            <select name="ddEspecie" class="form-select border border-dark">
                <option value="">Seleccionar...</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
            </select>
        </div>
        <div class="col-3">
            <label for="tbRaza" class="form-label text-black">Raza</label>
            <input type="text" name="tbRaza" class="form-control border border-dark">
        </div>
        <div class="col-3">
            <label for="tbIdCaso" class="form-label text-black">ID del caso asignado</label>
            <input type="text" name="tbIdCaso" class="form-control border border-dark">
        </div>
        <div class="col-3">
            <label for="tbCedulaColaborador" class="form-label text-black">Cédula del colaborador</label>
            <input type="text" name="tbCedulaColaborador" class="form-control border border-dark">
        </div>
    </div>
    
    <div class="row mt-3 mb-5">
        <div class="col-1 me-3">
            <button type="submit" name="btBuscar" class="btn btn-info text-white">Buscar</button>
        </div>
        <div class="col-1 me-4">
            <button type="submit" name="btRegistrar" class="btn btn-success">Registrar</button>
        </div>
        <div class="col-3">
            <button type="submit" name="btActualizar" class="btn btn-primary">Actualizar datos</button>
        </div>
    </div>
</div>