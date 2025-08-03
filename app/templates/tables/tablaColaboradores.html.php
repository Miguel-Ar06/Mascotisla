<div class="container table-responsive"  style="max-height: 300px; overflow-y: auto;">
    <table class="table table-striped table-responsive">
        <thead style="position: sticky; top: 0;">
            <tr>
                <!-- <th scope="col">Id</th> -->
                <th scope="col">Cédula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Miembro</th>
                <th scope="col">Admin</th>
                <th scope="col">Ver</th>
                <?php if($deleteable): ?>
                <th scope="col">Eliminar</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php if (empty($colaborators)):?>
                <tr>
                    <td colspan="<?php echo $num_columns; ?>" class="text-center text-muted py-3 bg-light">
                        No hay datos disponibles.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach($colaborators as $colaborator): ?>
                    <tr>
                        <td class="align-middle"><?php echo $colaborator->getIdentification() ?></td>
                        <!-- <th class="align-middle" scope="row"><?php echo $colaborator->getId() ?></th> -->
                        <td class="align-middle"><?php echo $colaborator->getName() . ' ' . $colaborator->getLastName() ?></td>
                        <td class="align-middle">
                            <div style="max-width: 150px; overflow-x: auto; white-space: nowrap;">
                                <?php echo $colaborator->getEmail() ?>
                            </div>
                        </td>
                        <td class="align-middle text-center"><?php boolToSiONo($colaborator->isMember()) ?></td>
                        <td class="align-middle text-center"><?php boolToSiONo($colaborator->isAdmin()) ?></td>
                        <td class="align-middle">
                            <form action="" method="POST">
                                <input type="hidden" name="colaboratorIdentification" value="<?php echo $colaborator->getIdentification() ?>">
                                <input type="hidden" name="colaboratorIsMember" value="<?php echo $colaborator->isMember() ?>">
                                <input type="hidden" name="btRow" value="see">
                                <div><button type="submit" class="btn btn-primary hover-scale-up">Ver</button></div>
                            </form>
                        </td>
                        <td class="align-middle">
                            <form action="" method="POST">
                                <input type="hidden" name="colaboratorIdentification" value="<?php echo $colaborator->getIdentification() ?>">
                                <input type="hidden" name="colaboratorIsMember" value="<?php echo $colaborator->isMember() ?>">
                                <input type="hidden" name="btRow" value="delete">
                                <div><button type="submit" class="btn btn-danger hover-scale-up">Eliminar</button></div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>