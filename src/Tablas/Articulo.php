<?php

namespace App\Tablas;

use PDO;

class Articulo extends Modelo
{
    // coge lo que hay dentro del trait y lo mete aqui
    protected static string $tabla = 'articulos';

    public $id;
    public $codigo;
    public $descripcion;
    public $precio;

    public function __construct(array $campos)
    {
        $this->id = $campos['id'];
        $this->codigo = $campos['codigo'];
        $this->descripcion = $campos['descripcion'];
        $this->precio = $campos['precio'];
    }

    public static function existe(int $id, ?PDO $pdo = null): bool
    {
        return static::obtener($id, $pdo) !== null;
    }
}