<?php
require_once "app/includes/classes/database.php";

Database::connect();

echo "Estado de conexión: " . (Database::$connected ? 'CONECTADO' : 'FALLÓ');
echo "<br>Mensaje: " . Database::$outputStatus;
echo "<br>Versión de PDO: " . (class_exists('PDO') ? PDO::getAttribute(PDO::ATTR_SERVER_VERSION) : 'PDO no existe');