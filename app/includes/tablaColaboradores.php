<?php

// colaboradores de prueba para ir creando la plantilla generadora de tablas
$testColaborators = 
[
    new User(1, 'John', 'Doe', 'keoland', '123456', 'john@gmail.com', '0000', true, true),
    new User(2, 'Jane', 'Doe', '', '123457', 'jane@gmail.com', '0000', false, false),
    new User(3, 'Joe', 'Doe', 'keoland', '123458', 'joe@gmail.com', '0000', true, false)
];

$editable = false;
$deleteable = true;

function boolToSiONo($boolean)
{
    if ($boolean == true)
    {
        echo 'Si';
    }
    else
    {
        echo 'No';
    }
}
?>

<div class="container table-responsive mb-5"  style="max-height: 400px; overflow-y: auto;">
    <table class="table table-striped mb-5 table-responsive">
        <thead style="position: sticky; top: 0;">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dirección</th>
                <th scope="col">Cédula</th>
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
            <?php foreach($testColaborators as $colaborator): ?>
                <tr>
                    <th class="align-middle" scope="row"><?php echo $colaborator->getId() ?></th>
                    <td class="align-middle"><?php echo $colaborator->getName() . ' ' . $colaborator->getLastName() ?></td>
                    <td class="align-middle"><?php echo $colaborator->getAddress() ?></td>
                    <td class="align-middle"><?php echo $colaborator->getIdentification() ?></td>
                    <td class="align-middle"><?php echo $colaborator->getEmail() ?></td>
                    <td class="align-middle"><?php boolToSiONo($colaborator->isMember()) ?></td>
                    <td class="align-middle"><?php boolToSiONo($colaborator->isAdmin()) ?></td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="colaboratorId" value="<?php echo $colaborator->getId() ?>">
                            <div><button type="submit" class="btn btn-primary hover-scale-up">Ver</button></div>
                        </form>
                    </td>
                    <?php if($deleteable == true): ?>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="colaboratorId" value="<?php echo $colaborator->getId() ?>">
                            <div><button type="submit" class="btn btn-danger hover-scale-up">Eliminar</button></div>
                        </form>
                    </td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>