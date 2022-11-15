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
        return static::obtener($id) !== null;
    }

    public static function obtener(int $id, ?PDO $pdo = null): ?static
    {
        $pdo = $pdo ?? conectar();
        $sent = $pdo->prepare('SELECT *
                                 FROM articulos
                                WHERE id = :id');
        $sent->execute([':id' => $id]);
        $fila = $sent->fetch(PDO::FETCH_ASSOC);
        if ($fila === null) {
            return null;
        }
        return new static($fila);
    }
}