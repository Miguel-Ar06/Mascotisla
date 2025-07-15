<?php 
if (session_status() == "PHP_SESSION_NONE")
{
    session_start();
}
require_once __DIR__ . "/../classes/animal.php";
require_once __DIR__ . "/../classes/database.php";
Database::connect();

$animalId = " ";
$name = " ";
$condition = " ";
$sex = " ";
$birth = " ";
$selectedStatuses = [];
$species = " ";
$breed = " ";
$caseId = " ";
$photos = [];
$colaboratorCedula = " ";

$allStatuses = [];
$allConditions = [];

Database::executeQuery("SELECT condicion FROM condiciones;");
foreach (Database::$result as $row)
{
    $allConditions[] = $row['condicion'];
}

Database::executeQuery("SELECT estado FROM estados;");
foreach (Database::$result as $row)
{
    $allStatuses[] = $row['estado'];
}

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['btForm']) && $_POST['btForm'] == "registrar")
    {
        registerAnimal();
        $_SESSION['message'] = '<div class="fs-4 text-success">Animal registrado corréctamente</div>';
        $_SESSION['messageShown'] = false;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    if (isset($_POST['btForm']) && $_POST['btForm'] == "actualizar")
    {
        updateAnimal();
        $_POST['animalId'] = $_POST['animalId'] ?? $_SESSION['selectedAnimal']['id'];
        getAnimalData();

        $_SESSION['message'] = '<div class="fs-4 text-success">Animal actualizado corréctamente</div>';
        $_SESSION['messageShown'] = false;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    if (isset($_POST['btTable']) && $_POST['btTable'] == "eliminar")
    {
        deleteAnimal();
        $_SESSION['message'] = '<div class="fs-4 text-success">Animal eliminado corréctamente</div>';
        $_SESSION['messageShown'] = false;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    if (isset($_POST['btTable']) && $_POST['btTable'] == "ver")
    {
        getAnimalData();
        $_SESSION['message'] = '<div class="fs-4">Tip: puede editar los datos y presionar "actualizar"</div>';
        $_SESSION['animalShown'] = false;
        $_SESSION['messageShown'] = false;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    if (isset($_POST['btTable']) && $_POST['btTable'] == "fotos")
    {
        $_SESSION['messageShown'] = false;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

//
// FUNCIONES DEL FORULARIO
//

function registerAnimal()
{
    global $animalId, $name, $condition, $sex, $birth, $selectedStatuses, $species, $breed, $caseId, $colaboratorCedula, $photos;

    $name = htmlspecialchars($_POST['tbNombre'] ?? " ");

    $condition = htmlspecialchars($_POST['ddCondicion'] ?? " ");
    $query = "SELECT id FROM condiciones WHERE condicion LIKE ?;";
    Database::safeExecute($query, [$condition]);
    $conditionId = Database::$result[0]['id'];

    $sex = htmlspecialchars($_POST['ddSexo'] ?? " ");
    $birth = htmlspecialchars($_POST['tbFechaNacimiento'] ?? " ");
    $selectedStatuses = $_POST['ckStatus'] ?? [];
    $species = htmlspecialchars($_POST['ddEspecie'] ?? " ");
    $breed = htmlspecialchars($_POST['tbRaza'] ?? " ");
    $caseId = htmlspecialchars($_POST['tbIdCaso'] ?? " ");

    $colaboratorCedula = htmlspecialchars($_POST['tbCedulaColaborador'] ?? " ");
    $query = "SELECT * FROM colaboradores WHERE cedula LIKE ?;";
    Database::safeExecute($query, [$colaboratorCedula]);
    if (count(Database::$result) < 1)
    {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error: no existe colaborador con esa cédula</div>';
        $_SESSION['messageShown'] = false;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
        return;
    }

    // $photos = getPhotos();

    // insertar el animal
    $query = "INSERT INTO animales(nombre, especie, raza, sexo, fecha_de_nacimiento, id_caso, id_condicion, cedula_colaborador) VALUES
                (?,?,?,?,?,?,?,?);";
    Database::safeExecute($query, [$name, $species, $breed, $sex, $birth, ($caseId === '' ? null : $caseId), $conditionId, $colaboratorCedula]);

    $animalId = Database::lastInsertId();

    // insertar sus estados
    registerStatuses($animalId, $selectedStatuses);
}

function registerStatuses($animalId, $selectedStatuses)
{
    foreach ($selectedStatuses as $status) 
    {
        $statusTrimmed = trim($status);
        $query = "INSERT INTO estados_animales (id_animal, id_estado)
                    SELECT a.id, e.id
                        FROM animales a CROSS JOIN estados e 
                        WHERE a.id = ? AND e.estado LIKE ?;";
        
        Database::safeExecute($query, [$animalId, $statusTrimmed]);
    }
}

function getAnimalData()
{
    global $animalId, $name, $condition, $sex, $birth, $selectedStatuses, $species, $breed, $caseId, $colaboratorCedula, $photos;
    $selectedId = $_POST['animalId'] ?? " ";

    if (empty($selectedId)) 
    {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error: No se proporcionó un ID de animal para ver.</div>';
        $_SESSION['messageShown'] = false; 
        return; // Exit the function immediately
    }

    $animalStatuses = [];

    $query = "SELECT estado 
                FROM estados
                JOIN estados_animales ea ON ea.id_estado = estados.id
                JOIN animales ON ea.id_animal = animales.id
                WHERE animales.id = ?;";
    Database::safeExecute($query, [$selectedId]);

    foreach (Database::$result as $actualStatus)
    {
        $animalStatuses[] = $actualStatus['estado'];
    }

    $query = "SELECT animales.id AS id, nombre, sexo, fecha_de_nacimiento, raza, especie, id_caso, condicion, cedula_colaborador
                FROM animales
                JOIN condiciones ON animales.id_condicion = condiciones.id
                WHERE animales.id = ?;";

    Database::safeExecute($query, [$selectedId]);

    if (empty(Database::$result))
    {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Animal no encontrado</div>';
        return;
    }

    $foundAnimal = Database::$result[0];

    $selectedId = $foundAnimal['id'];
    $name = $foundAnimal['nombre'];
    $condition = $foundAnimal['condicion'];
    $sex = $foundAnimal['sexo'];
    $birth = $foundAnimal['fecha_de_nacimiento'];
    $species = $foundAnimal['especie'];
    $breed = $foundAnimal['raza'];
    $caseId = $foundAnimal['id_caso'];
    if ($caseId == null)
    {
        $caseId = " ";
    }
    $colaboratorCedula = $foundAnimal['cedula_colaborador'];

    $_SESSION['selectedAnimal'] = 
    [
        'id' => $selectedId,
        'name' => $name,
        'condition' => $condition,
        'sex' => $sex,
        'birth' => $birth,
        'statuses' => $animalStatuses,
        'species' => $species,
        'breed' => $breed,
        'caseId' => $caseId,
        'colaboratorCedula' => $colaboratorCedula
    ];
}

function getPhotos()
{

}

function deleteAnimal()
{
    $animalIdToDelete = $_POST['animalId'] ?? null;

    if (empty($animalIdToDelete)) 
    {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error: No se proporcionó un ID de animal para eliminar.</div>';
        $_SESSION['messageShown'] = false;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
        return;
    }

    try 
    {
        // 1. Delete related records from `estados_animales` first
        $query = "DELETE FROM estados_animales WHERE id_animal = ?;";
        Database::safeExecute($query, [$animalIdToDelete]);

        // 2. Delete related records from `fotos_animales` (assuming this table exists for getPhotos)
        $query = "DELETE FROM fotos WHERE id_animal = ?;";
        Database::safeExecute($query, [$animalIdToDelete]);

        // 4. Finally, delete the animal from the `animales` table
        $query = "DELETE FROM animales WHERE id = ?;";
        Database::safeExecute($query, [$animalIdToDelete]);

    } 
    catch (PDOException $e) 
    {
        // Handle database errors during deletion
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error al eliminar el animal: ' . $e->getMessage() . '</div>';
    }
}

function updateAnimal()
{
    // Get and sanitize all POST data
    $animalId = $_POST['animalId'] ?? '';
    $name = trim($_POST['tbNombre'] ?? '');
    $conditionName = trim($_POST['ddCondicion'] ?? '');
    $sex = trim($_POST['ddSexo'] ?? '');
    $birth = trim($_POST['tbFechaNacimiento'] ?? '');
    $selectedStatuses = $_POST['ckStatus'] ?? [];
    $species = trim($_POST['ddEspecie'] ?? '');
    $breed = trim($_POST['tbRaza'] ?? '');
    $caseId = trim($_POST['tbIdCaso'] ?? '');
    $colaboratorCedula = trim($_POST['tbCedulaColaborador'] ?? '');

    // Validate required fields
    if (empty($animalId)) {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error: ID del animal no proporcionado para actualizar.</div>';
        $_SESSION['messageShown'] = false;
        return;
    }
    if ($name === '' || $conditionName === '' || $sex === '' || $species === '' || $breed === '' || $colaboratorCedula === '') {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error: Todos los campos obligatorios deben estar llenos.</div>';
        $_SESSION['messageShown'] = false;
        return;
    }

    // Get condition ID
    $query = "SELECT id FROM condiciones WHERE condicion = ?;";
    Database::safeExecute($query, [$conditionName]);
    if (empty(Database::$result)) {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error: La condición seleccionada no es válida.</div>';
        $_SESSION['messageShown'] = false;
        return;
    }
    $conditionId = Database::$result[0]['id'];

    // Validate colaborator
    $query = "SELECT cedula FROM colaboradores WHERE cedula = ?;";
    Database::safeExecute($query, [$colaboratorCedula]);
    if (empty(Database::$result)) {
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error: No existe colaborador con esa cédula.</div>';
        $_SESSION['messageShown'] = false;
        return;
    }

    // Start transaction for atomic update
    try {
        Database::$pdo->beginTransaction();

        // Update animal
        $query = "UPDATE animales SET 
                    nombre = ?, 
                    especie = ?, 
                    raza = ?, 
                    sexo = ?, 
                    fecha_de_nacimiento = ?, 
                    id_caso = ?, 
                    id_condicion = ?, 
                    cedula_colaborador = ?
                  WHERE id = ?;";
        Database::safeExecute($query, [
            $name,
            $species,
            $breed,
            $sex,
            $birth,
            ($caseId === '' ? null : $caseId),
            $conditionId,
            $colaboratorCedula,
            $animalId
        ]);

        // Update statuses
        $query = "DELETE FROM estados_animales WHERE id_animal = ?;";
        Database::safeExecute($query, [$animalId]);
        foreach ($selectedStatuses as $status) {
            $query = "INSERT INTO estados_animales (id_animal, id_estado)
                        SELECT ?, e.id FROM estados e WHERE e.estado = ?;";
            Database::safeExecute($query, [$animalId, trim($status)]);
        }

        Database::$pdo->commit();

        $_SESSION['message'] = '<div class="fs-4 text-success">Animal actualizado correctamente.</div>';
        $_SESSION['messageShown'] = false;
    } catch (Exception $e) {
        Database::$pdo->rollBack();
        $_SESSION['message'] = '<div class="fs-4 text-danger">Error al actualizar el animal: ' . htmlspecialchars($e->getMessage()) . '</div>';
        $_SESSION['messageShown'] = false;
    }
}

function updateStatuses($animalId, $selectedStatuses)
{
    $query = "DELETE FROM estados_animales WHERE id_animal = ?;";
    Database::safeExecute($query, [$animalId]);

    registerStatuses($animalId, $selectedStatuses); 
}