<style> 
    .accordion-item .accordion-collapse 
    {
        position: absolute; /* Takes the element out of normal flow */
        width: 100%; /* Ensures it spans the width of its parent (.accordion-wrapper) */
        z-index: 10; /* Ensures it appears above other content on the page */
        top: 100%; /* Positions it directly below the accordion header */
        left: 0; /* Aligns it to the left edge of its parent */

        /* Optional: Add styles for visual separation and readability */
        background-color: white; /* Essential to cover content behind it */
        border: 1px solid #000000ff; /* Matches your form's border style */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
        padding: 1rem; /* Add some padding around the content within the body */

        /* Optional: If content can be very long, make it scrollable */
        max-height: 250px; /* Limit the expanded height */
        overflow-y: auto; /* Add vertical scrollbar if content exceeds max-height */

        /* Ensure transitions are smooth */
        transition: height 0.35s ease; /* Adjust transition property if you need it to animate smoothly */
    }

    /* If you need to make space for content that comes *immediately* after the whole form
    and would be hidden by the accordion. This is usually managed by margins/paddings
    on the elements *outside* of the accordion. */
    .content-after-form 
    {
        margin-top: 250px;  /*Example: Add enough space for the accordion to overlap */
    }

</style>

<form id="formAnimal" action="" method="POST">
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Nombre del animal</label>
            <input required type="text" name="tbNombre" class="form-control border border-dark">
        </div>
        <div class="col-md-4">
            <label class="form-label">Condición</label>
            <select name="ddCondicion" class="form-select border border-dark">
                <option selected hidden value=""> </option>
                <?php foreach($allConditions as $currentCondition): ?>
                    <option value="<?php echo $currentCondition; ?>"><?php echo $currentCondition; ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <label class="form-label">Sexo</label>
            <select required name="ddSexo" class="form-select border border-dark">
                <option selected hidden value=""></option>
                <option value="macho">Macho</option>
                <option value="hembra">Hembra</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Fecha de nacimiento (o aprox.)</label>
            <input required type="date" name="tbFechaNacimiento" class="form-control border border-dark">
        </div>
        <div class="col-md-3 pt-1">
            <label for="bsAccoridon">Estado/s </label>
            <div name="accordionWrapper" class="position-relative">
            <div name="bsAccordion" class="accordion border border-dark" id="accordionStatus">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed pt-2 pb-2" style="transform: none !important;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionStatuses">
                        <div class="accordion-body p-0">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col"><strong>Puede contar varios estados:</strong></div>
                                </div>
                                <?php foreach($allStatuses as $currentStatus): ?>
                                    <div class="row">
                                        <div class="col">
                                            <input type="checkbox" name="ckStatus[]" value="<?php echo $currentStatus ?>" class=" me-2 form-check-input border border-dark"
                                            <label class="form-check-label"><?php echo $currentStatus?></label>
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
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <label class="form-label">Especie</label>
            <select required name="ddEspecie" class="form-select border border-dark">
                <option hidden selected value=""> </option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Raza</label>
            <input required placeholder="Ej: callejero" type="text" name="tbRaza" class="form-control border border-dark">
        </div>
        <div class="col-md-3">
            <label class="form-label">ID del caso asignado (opcional)</label>
            <input type="text" name="tbIdCaso" class="form-control border border-dark">
        </div>
        <div class="col-md-3">
            <label class="form-label">Cédula del colaborador</label>
            <input type="text" name="tbCedulaColaborador" class="form-control border border-dark">
        </div>
    </div>
    
    <div class="row mt-5 mb-3">
        <div class="col-1 me-3">
            <button type="submit" name="btForm" value="buscar" class="btn btn-info text-white">Buscar</button>
        </div>
        <div class="col-1 me-4">
            <button type="submit" name="btForm" value="registrar" class="btn btn-success">Registrar</button>
        </div>
        <div class="col-3">
            <button type="submit" name="btForm" value="actualizar" class="btn btn-primary">Actualizar datos</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
