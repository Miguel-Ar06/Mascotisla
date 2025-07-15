<?php
// RUTAS CORRECTAS - VERIFICAR ESTRUCTURA DE DIRECTORIOS
require_once __DIR__ . '/../../includes/classes/database.php';
require_once __DIR__ . '/../../includes/classes/animal.php';

// Conectar a la base de datos
Database::connect();

// Obtener parámetros de búsqueda
$searchName = $_GET['tbName'] ?? '';
$condition = $_GET['ddCondicion'] ?? '';
$sex = $_GET['ddSex'] ?? '';
$statuses = $_GET['ckStatus'] ?? [];

// Construir consulta SQL base
$query = "SELECT a.id, a.nombre, a.especie, a.raza, c.condicion, a.sexo, a.fecha_de_nacimiento 
          FROM animales a
          JOIN condiciones c ON a.id_condicion = c.id
          WHERE 1=1";

$params = [];

// Aplicar filtros
if (!empty($searchName)) {
    $query .= " AND a.nombre LIKE ?";
    $params[] = "%$searchName%";
}

if (!empty($condition)) {
    $query .= " AND c.condicion = ?";
    $params[] = $condition;
}

if (!empty($sex)) {
    $query .= " AND a.sexo = ?";
    $params[] = $sex;
}

// Manejar filtro de estados
if (!empty($statuses) && !in_array('Todo', $statuses)) {
    $query .= " AND EXISTS (
        SELECT 1 FROM estados_animales ea
        JOIN estados e ON ea.id_estado = e.id
        WHERE ea.id_animal = a.id AND e.estado IN (";
    
    $placeholders = implode(',', array_fill(0, count($statuses), '?'));
    $query .= $placeholders . "))";
    
    $params = array_merge($params, $statuses);
}

// Agrupar por animal
$query .= " GROUP BY a.id";

// Ejecutar consulta
if (!empty($params)) {
    Database::safeExecute($query, $params);
} else {
    Database::executeQuery($query);
}

$animalsData = Database::$result;

// Crear objetos Animal
$animals = [];
foreach ($animalsData as $animalData) {
    // Obtener estados del animal
    $statusQuery = "SELECT e.estado 
                    FROM estados_animales ea
                    JOIN estados e ON ea.id_estado = e.id
                    WHERE ea.id_animal = ?";
    Database::safeExecute($statusQuery, [$animalData['id']]);
    $animalStatuses = array_column(Database::$result, 'estado');

    $animal = new Animal(
        $animalData['id'],
        $animalData['especie'],
        $animalData['nombre'],
        $animalData['raza'],
        $animalData['condicion'],
        $animalStatuses,
        $animalData['sexo'],
        [], // Fotos
        $animalData['fecha_de_nacimiento']
    );
    
    $animals[] = $animal;
}

// Obtener todas las condiciones para el dropdown
Database::executeQuery("SELECT condicion FROM condiciones");
$allConditions = array_column(Database::$result, 'condicion');

// Obtener todos los estados para el dropdown
Database::executeQuery("SELECT estado FROM estados");
$allStatuses = array_column(Database::$result, 'estado');

// Variables para la tabla
$deleteable = false; // Cambiar según permisos
$num_columns = 8;   // Número de columnas en la tabla
?>