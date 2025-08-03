<div class="container table-responsive mb-5"  style="max-height: 400px; overflow-y: auto;">
    <table class="table table-striped table-responsive">
        <thead style="position: sticky; top: 0;">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Especie</th>
                <th scope="col">Nombre</th>
                <th scope="col">Raza</th>
                <th scope="col">Sexo</th>
                <th scope="col">Condición</th>
                <th scope="col">Info.</th>
                <th scope="col">Fotos</th>
                <?php if($_SESSION["userIsAdmin"]): ?>
                <th scope="col">Eliminar</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php if (empty($animals)):?>
                <tr>
                    <td colspan="<?php echo $num_columns; ?>" class="text-center text-muted py-3 bg-light">
                        No hay datos disponibles.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach($animals as $animal): ?>
                    <tr>
                        <th class="align-middle" scope="row"><?php echo $animal->getId() ?></th>
                        <td class="align-middle"><?php echo $animal->getSpecies() ?></td>
                        <td class="align-middle"><?php echo $animal->getName() ?></td>
                        <td class="align-middle"><?php echo $animal->getBreed() ?></td>
                        <td class="align-middle"><?php echo $animal->getSex() ?></td>
                        <td class="align-middle"><?php echo $animal->getCondition() ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="animalId" value="<?php echo $animal->getId() ?>">
                                <div><button name="btTable" value="ver" type="submit" class="btn btn-secondary hover-scale-up">Ver info.</button></div>
                            </form>
                        </td>
                        <td>
                            <form action="" method="GET">
                                <input type="hidden" name="animalId" value="<?php echo $animal->getId() ?>">
                                <div><button name="btTable" value="fotos" type="submit" class="btn btn-primary hover-scale-up">Ver fotos</button></div>
                            </form>
                        </td>
                        <?php if($_SESSION["userIsAdmin"]): ?>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="animalId" value="<?php echo $animal->getId() ?>">
                                <div><button name="btTable" value="eliminar" type="submit" class="btn btn-danger hover-scale-up">Eliminar</button></div>
                            </form>
                        </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>