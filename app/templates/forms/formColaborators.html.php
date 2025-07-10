<form id="formColaborator" action="" method="POST">
    <div class="container ps-0 ms-0">
        <div class="row">
            <div class="col-4">
                <label for="tbCedula" class="form-label text-black">Cédula</label>
                <input type="number" required placeholder="Ej: 31000000" min="0" step="1" name="tbCedula" class="form-control border border-dark">
            </div>
            <div class="col">
                <label for="tbName" class="form-label text-black">Nombre</label>
                <input type="text" required  name="tbName" class="form-control border border-dark">
            </div>
            <div class="col">
                <label for="tbLastName" class="form-label text-black">Apellido</label>
                <input type="text" required  name="tbLastName" class="form-control border border-dark">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-5">
                <label for="tbPhone" class="form-label text-black">Teléfono/s</label>
                <input type="tel" required placeholder="Ej: 0416-0000000,0424-0000000" name="tbPhone" class="form-control border border-dark">
            </div>
            <div class="col">
                <label for="tbDetails" class="form-label text-black">Detalles (opcional)</label>
                <input type="text" name="tbDetails"placeholder="Ej: Ofrece hogar temporal" class="form-control border border-dark">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <input type="checkbox" name="ckMember" class="form-check-input border border-dark">
                <label for="ckMember" class="form-check-label">Nuevo miembro</label>
            </div>
        </div>
        <div id="dvExtraFields" style="display: none;">
            <div class="row mt-3">
                <div class="col">
                    <label for="tbEmail" class="form-label text-black">Correo electrónico</label>
                    <input type="email" name="tbEmail" class="form-control border border-dark">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="tbPassword" class="form-label text-black">Contraseña</label>
                    <input type="password" name="tbPassword" class="form-control border border-dark">
                </div>
                <div class="col">
                    <label for="tbPasswordConfirm" class="form-label text-black">Confirmar contraseña</label>
                    <input type="password" name="tbPasswordConfirm" class="form-control border border-dark">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="tbCity" class="form-label text-black">Ciudad/Pueblo/Localidad</label>
                    <input type="text" name="tbCity" class="form-control border border-dark">
                </div>
                <div class="col">
                    <label for="tbStreet" class="form-label text-black">Calle</label>
                    <input type="text" name="tbStreet" class="form-control border border-dark">
                </div>
                <div class="col">
                    <label for="ddMunicipality" class="form-label text-black">Municipio</label>
                    <select class="form-select border border-dark" aria-label="Default select example" name="ddMunicipality">
                        <option value="" disabled selected hidden> </option>
                        <option value="Antolin">Antolín</option>
                        <option value="Arismendi">Arismendi</option>
                        <option value="Antonio Diaz">Antonio Diaz</option>
                        <option value="Garcia">García</option>
                        <option value="Gomez">Gómez</option>
                        <option value="Maneiro">Maneiro</option>
                        <option value="Marcano">Marcano</option>
                        <option value="Marinio">Mariño</option>
                        <option value="Macanao">Macanao</option>
                        <option value="Tubores">Tubores</option>
                        <option value="Villalba">Villalba</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="col">
                        <label for="tbReference" class="form-label text-black">Punto de referencia (opcional)</label>
                        <input type="text" name="tbReference" placeholder="Ej: Frente al kiosco ----" class="form-control border border-dark">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <input type="checkbox" name="ckIsAdmin" class="form-check-input border border-dark">
                    <label for="ckIsAdmin" class="form-check-label">Es Administrador</label>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-5 justify-content-betweenn">
            <div class="col">
                <input type="submit" name="btSubmitColaborador" class="btn btn-success" value="Registrar">
            </div>
            <div class="col text-end">
                <input type="submit" name="btSubmitColaborador" class="btn btn-primary" value="Actualizar">
            </div>
        </div>
    </div>
</form>