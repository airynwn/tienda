<?php

require_once 'auxiliar.php';

class Articulo
{
    public $id;
    public $codigo;
    public $descripcion;
    public $precio;

    public function __construct($id, $codigo, $descripcion, $precio)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }

    public static function existe(int $id, ?PDO $pdo = null): bool
    {
        // algo ?opcional
        $pdo = $pdo ?? conectar(); //si hay pdo, pdo; sino, conectar
        // coalescer, el primero que no sea nulo
        $sent = $pdo->prepare('SELECT COUNT(*) FROM articulos WHERE id = :id');
        $sent->execute([':id' => $id]); // true si es distinto de 0 aka existe
        return $sent->fetchColumn() !== 0;
    }
}