<?php
class Caso {
    private $id;
    private $nombre;
    private $ubicacion;
    private $fechaApertura;
    private $fechaCierre;
    private $estado; // true=abierto, false=cerrado

    public function __construct($id, $nombre, $ubicacion, $fechaApertura, $fechaCierre, $estado) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ubicacion = $ubicacion;
        $this->fechaApertura = $fechaApertura;
        $this->fechaCierre = $fechaCierre;
        $this->estado = $estado;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getUbicacion() { return $this->ubicacion; }
    public function getFechaApertura() { return $this->fechaApertura; }
    public function getFechaCierre() { return $this->fechaCierre; }
    public function getEstado() { return $this->estado; }
}