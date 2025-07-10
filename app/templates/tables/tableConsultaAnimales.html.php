<?php require __DIR__ . '/../../includes/tableLogic/tableAnimals.php' 
// SE NECESITA INCLUIR animal.php EN EL ARCHIVO DONDE SE USE ESTA PLANTILLA
?>

<div class="container table-responsive mb-5"  style="max-height: 400px; overflow-y: auto;">
    <table class="table table-striped mb-5 table-responsive">
        <thead style="position: sticky; top: 0;">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Especie</th>
                <th scope="col">Nombre</th>
                <th scope="col">Raza</th>
                <th scope="col">Sexo</th>
                <th scope="col">Estado</th>
                <th scope="col">Condicion</th>
                <th scope="col">Fotos</th>
                <?php if($deleteable): ?>
                <th scope="col">Eliminar</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach($testAnimals as $animal): ?>
                <tr>
                    <th class="align-middle" scope="row"><?php echo $animal->getId() ?></th>
                    <td class="align-middle"><?php echo $animal->getSpecies() ?></td>
                    <td class="align-middle"><?php echo $animal->getName() ?></td>
                    <td class="align-middle"><?php echo $animal->getBreed() ?></td>
                    <td class="align-middle"><?php echo $animal->getSex() ?></td>
                    <td class="align-middle"><?php echo $animal->getStatus() ?></td>
                    <td class="align-middle"><?php echo $animal->getCondition() ?></td>
                    <td>
                        <form action="" method="GET">
                            <input type="hidden" name="animalId" value="<?php echo $animal->getId() ?>">
                            <div><button type="submit" class="btn btn-primary hover-scale-up">Ver fotos</button></div>
                        </form>
                    </td>
                    <?php if($deleteable == true): ?>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="animalId" value="<?php echo $animal->getId() ?>">
                            <div><button type="submit" class="btn btn-danger hover-scale-up">Eliminar</button></div>
                        </form>
                    </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>