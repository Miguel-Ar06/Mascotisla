<?php
require_once __DIR__ . "/../classes/caso.php";

// Casos de prueba
$testCasos = [
    new Caso(1, "Rescate en Av. Principal", "Av. Principal #123", "2023-05-15", null, true),
    new Caso(2, "Perro abandonado", "Calle Secundaria #456", "2023-06-20", "2023-07-10", false),
    new Caso(3, "Gato atrapado en árbol", "Parque Central", "2023-07-01", null, true),
    new Caso(4, "Animales en mal estado", "Zona Industrial", "2023-07-05", null, true)
];

$editable = false;
$deleteable = true;

function formatEstado($estado) {
    return $estado ? '<span class="badge bg-success">Abierto</span>' : '<span class="badge bg-secondary">Cerrado</span>';
}
?>