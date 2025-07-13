<?php require_once __DIR__ . "/../../includes/formLogic/formColaborators.php" ?>

<form id="formColaborator" action="" method="POST">
    <div class="container ps-0 ms-0">
        <div class="row">
            <div class="col-4">
                <label for="tbCedula" class="form-label text-black" >Cédula</label>
                <input type="number" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['cedula'] ?? '') ?>" required placeholder="Ej: 31000000" min="0" step="1" name="tbCedula" class="form-control border border-dark">
            </div>
            <div class="col">
                <label for="tbName" class="form-label text-black">Nombre</label>
                <input type="text" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['name'] ?? '') ?>" required  name="tbName" class="form-control border border-dark">
            </div>
            <div class="col">
                <label for="tbLastName" class="form-label text-black">Apellido</label>
                <input type="text" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['lastName'] ?? '') ?>" required  name="tbLastName" class="form-control border border-dark">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-5">
                <label for="tbPhone" class="form-label text-black">Teléfono</label>
                <input type="tel" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['phonesStr'] ?? '') ?>" required placeholder="Ej: 0416-0000000" name="tbPhone" class="form-control border border-dark">
            </div>
            <div class="col">
                <label for="tbDetails" class="form-label text-black">Detalles (opcional)</label>
                <input type="text" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['details'] ?? '') ?>" name="tbDetails"placeholder="Ej: Organiza jornadas de adopción" class="form-control border border-dark">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="accordion border border-dark" id="accordionRoles">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" style="transform: none !important;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Papeles/Roles (opcional)
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionRoles">
                            <div class="accordion-body">
                                <div class="container">
                                    <div class="row mb-2">
                                        <div class="col"><strong>Puede contar con 1 o más papeles:</strong></div>
                                    </div>
                                    <?php foreach($roles as $role): ?>
                                        <div class="row">
                                            <div class="col">
                                                <input type="checkbox" name="ckRole[]" value="<?php echo $role ?>"
                                                    class="form-check-input border border-dark"
                                                    <?php if (!empty($_SESSION['colaboratorShown']['selectedRoles']) && in_array($role, $_SESSION['colaboratorShown']['selectedRoles'])) echo 'checked'; ?>>
                                                <label class="form-check-label"><?php echo $role?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <input type="checkbox" <?php if (!empty($_SESSION['colaboratorShown']['isMember'])) echo 'checked'; ?> name="ckMember" class="form-check-input border border-dark">
                <label for="ckMember" class="form-check-label">Es miembro</label>
            </div>
        </div>
        <div id="dvExtraFields" style="display: none;">
            <div class="row mt-3">
                <div class="col">
                    <label for="tbEmail" class="form-label text-black">Correo electrónico</label>
                    <input type="email" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['email'] ?? '') ?>" name="tbEmail" class="form-control border border-dark">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="tbPassword" class="form-label text-black">Contraseña</label>
                    <input minlength="8" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['password'] ?? '') ?>" type="password" name="tbPassword" class="form-control border border-dark">
                </div>
                <div class="col">
                    <label for="tbPasswordConfirm" class="form-label text-black">Confirmar contraseña</label>
                    <input minlength="8" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['passwordConfirm'] ?? '') ?>" type="password" name="tbPasswordConfirm" class="form-control border border-dark">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="tbCity" class="form-label text-black">Ciudad/Pueblo/Localidad</label>
                    <input type="text" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['city'] ?? '') ?>" name="tbCity" class="form-control border border-dark">
                </div>
                <div class="col">
                    <label for="tbStreet" class="form-label text-black">Calle</label>
                    <input type="text" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['street']?? '') ?>" name="tbStreet" class="form-control border border-dark">
                </div>
                <div class="col">
                    <label for="ddMunicipality" class="form-label text-black">Municipio</label>
                    <select class="form-select border border-dark" aria-label="Default select example" name="ddMunicipality">
                        <option value="" disabled selected hidden> </option>
                        <option value="Antolín" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Antolín') echo 'selected'; ?>>Antolín</option>
                        <option value="Arismendi" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Arismendi') echo 'selected'; ?>>Arismendi</option>
                        <option value="Díaz" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Díaz') echo 'selected'; ?>>Díaz</option>
                        <option value="García" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'García') echo 'selected'; ?>>García</option>
                        <option value="Gómez" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Gómez') echo 'selected'; ?>>Gómez</option>
                        <option value="Maneiro" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Maneiro') echo 'selected'; ?>>Maneiro</option>
                        <option value="Marcano" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Marcano') echo 'selected'; ?>>Marcano</option>
                        <option value="Mariño" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Mariño') echo 'selected'; ?>>Mariño</option>
                        <option value="Macanao" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Macanao') echo 'selected'; ?>>Macanao</option>
                        <option value="Tubores" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Tubores') echo 'selected'; ?>>Tubores</option>
                        <option value="Villalba" 
                            <?php if (($_SESSION['colaboratorShown']['municipality'] ?? '') == 'Villalba') echo 'selected'; ?>>Villalba</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="col">
                        <label for="tbReference" class="form-label text-black">Punto de referencia (opcional)</label>
                        <input type="text" value="<?php echo htmlspecialchars($_SESSION['colaboratorShown']['referencePoint'] ?? '') ?>" name="tbReference" placeholder="Ej: Frente al kiosco ----" class="form-control border border-dark">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <input type="checkbox" <?php if (!empty($_SESSION['colaboratorShown']['isAdmin'])) echo 'checked'; ?> name="ckIsAdmin" class="form-check-input border border-dark">
                    <label for="ckIsAdmin" class="form-check-label">Es Administrador</label>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3 justify-content-betweenn">
            <div class="col">
                <input type="submit" name="btSubmitColaborador" class="btn btn-success" value="Registrar">
            </div>
            <div class="col text-end">
                <input type="submit" name="btSubmitColaborador" class="btn btn-primary" value="Actualizar">
            </div>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>