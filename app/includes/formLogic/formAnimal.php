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
}

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

    $photos = getPhotos();

    // insertar el animal
    $query = "INSERT INTO animales(nombre, especie, raza, sexo, fecha_de_nacimiento, id_caso, id_condicion, cedula_colaborador) VALUES
                (?,?,?,?,?,?,?,?);";
    Database::safeExecute($query, [$name, $species, $breed, $sex, $birth, ($caseId === '' ? null : $caseId), $conditionId, $colaboratorCedula]);

    $animalId = Database::lastInsertId();

    // insertar sus estados
    registerStatuses();
}

function registerStatuses()
{
    global $selectedStatuses, $animalId;

    foreach ($selectedStatuses as $status) 
    {
        $query = "INSERT INTO estados_animales (id_animal, id_papel)
                    SELECT a.id, e.id
                        FROM animales a CROSS JOIN estados e -- CROSS JOIN combina cada fila de c con cada fila de p
                        WHERE a.id = ? AND e.estado LIKE ?;";
        
        Database::safeExecute($query, [$animalId, $status]);
    }
}

function getPhotos()
{

}