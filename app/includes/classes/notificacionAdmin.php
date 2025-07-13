<?php
class NotificacionAdmin {
    public $id, $titulo, $mensaje, $fecha, $leida;

    public function __construct($id, $titulo, $mensaje, $fecha, $leida) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->fecha = $fecha;
        $this->leida = $leida;
    }

    public static function obtenerTodas($soloNoLeidas = false) {
        include_once __DIR__ . '/database.php';
        Database::connect();
        $sql = "SELECT * FROM notificaciones_admin";
        if ($soloNoLeidas) $sql .= " WHERE leida = 0";
        $sql .= " ORDER BY fecha DESC";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $notificaciones = [];
        foreach ($rows as $row) {
            $notificaciones[] = new NotificacionAdmin(
                $row['id'], $row['titulo'], $row['mensaje'], $row['fecha'], $row['leida']
            );
        }
        return $notificaciones;
    }

    public static function crear($titulo, $mensaje) {
        include_once __DIR__ . '/database.php';
        Database::connect();
        $stmt = Database::$pdo->prepare("INSERT INTO notificaciones_admin (titulo, mensaje) VALUES (?, ?)");
        $stmt->execute([$titulo, $mensaje]);
    }
    public static function marcarComoLeida($id) {
        include_once __DIR__ . '/database.php';
        Database::connect();
        $stmt = Database::$pdo->prepare("UPDATE notificaciones_admin SET leida = 1 WHERE id = ?");
        $stmt->execute([$id]);
    }
}