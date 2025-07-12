<?php 
// Datos de prueba para la tabla de casos
$casos = [
    ['id' => 1, 'nombre' => 'Pocheco', 'estado' => 'Abierto'],
    ['id' => 2, 'nombre' => 'Hello kitty', 'estado' => 'Cerrado'],
    ['id' => 3, 'nombre' => 'Gato mion', 'estado' => 'Cerrado'],
    ['id' => 4, 'nombre' => 'Adjetivo', 'estado' => 'Abierto']
];
?>

<div class="container table-responsive" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-striped table-hover">
        <thead style="position: sticky; top: 0; background-color: white;">
            <tr>
                <th scope="col">id</th>
                <th scope="col">nombre</th>
                <th scope="col">estado</th>
                <th scope="col">ver</th>
                <th scope="col">eliminar</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach($casos as $caso): ?>
                <tr>
                    <th scope="row"><?php echo $caso['id']; ?></th>
                    <td><?php echo $caso['nombre']; ?></td>
                    <td>
                        <span class="badge 
                            <?php 
                                if($caso['estado'] == 'Abierto') echo 'bg-success';
                                elseif($caso['estado'] == 'Cerrado') echo 'bg-danger';
                            ?>">
                            <?php echo $caso['estado']; ?>
                        </span>
                    </td>
                    <td>
                        <form action="" method="GET">
                            <input type="hidden" name="casoId" value="<?php echo $caso['id']; ?>">
                            <button type="submit" class="btn btn-primary btn-sm hover-scale-up">Ver</button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <input type="hidden" name="casoId" value="<?php echo $caso['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm hover-scale-up">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>