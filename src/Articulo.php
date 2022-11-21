<?php

require_once 'auxiliar.php';

class Articulo
{
    use Obtenible;
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
        return static::obtener($id) !== null;
    }

    public static function obtener(int $id, ?PDO $pdo = null): ?static
    {
        $pdo = $pdo ?? conectar();
        $tabla = static::$tabla;
        $sent = $pdo->prepare('SELECT *
                                 FROM $tabla
                                WHERE id = :id');
        $sent->execute([':id' => $id]);
        $fila = $sent->fetch(PDO::FETCH_ASSOC);
        
        return $fila ? new static($fila) : null;
    }
}