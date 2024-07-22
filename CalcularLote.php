<?php
class CalcularLote {
    private $x, $y, $z, $g, $total;
    private $h;

    // Instancia única de la clase
    private static $instance;

    // Constructor privado para evitar la creación directa de instancias
    private function __construct() { }

    // Método estático para acceder a la única instancia de la clase
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Getters y Setters
    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function getY() {
        return $this->y;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getZ() {
        return $this->z;
    }

    public function setZ($z) {
        $this->z = $z;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getH() {
        return $this->h;
    }

    public function setH($h) {
        $this->h = $h;
    }

    // Métodos de cálculo
    public function calcularConDuplex() {
        $this->g = 2;
        $this->total = ($this->x + $this->y + $this->z) * $this->g * $this->h;
        return $this->total;
    }

    public function calcularSinDuplex() {
        $this->g = 2;
        $this->total = (($this->x + $this->y + $this->z) * $this->g * $this->h) + (($this->x + $this->y + $this->z) * $this->g * $this->h * 0.1);
        return $this->total;
    }
}
?>
