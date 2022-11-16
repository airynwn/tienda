<?php

class Carrito
{
    /**
     * @var array $articulos los artículos del carrito
     *                       las claves son los IDs
     *                       los valores son las cantidades
     */
    public $articulos;
    // propiedad dinamica: en psysh por ej
    // $c->pepe = 'hola';
    // propiedades predeterminadas: las que estan definidas en el archivo (estas)
    public function __construct()
    { // crea lista de articulos para meter [id=>cantidad]
        $this->articulos = [];
    }

    public function insertar($id)
    {
        if (!Articulo::existe($id)) { // :: operador de resolucion de ambito - busca el
            throw new ValueError('El artículo no existe.');
        } // metodo estatico existe() de la clase articulo
        // Si ya está el artículo en el carrito le suma 1
        if (isset($this->articulos[$id])) {
            $this->articulos[$id]++;
        } else { // sino mete el primero
            $this->articulos[$id] = 1;
        }
    }

    public function eliminar($id)
    {
        if (isset($this->articulos[$id])) {
            $this->articulos[$id]--; // Si ya está en el carrito le resta 1
            if ($this->articulos[$id] == 0) {
                unset($this->articulos[$id]); // y si quedan 0, lo quita
            }
        } else {
            throw new ValueError('Artículo inexistente en el carrito');
        }
    }

    public function vacio(): bool
    {
        return empty($this->articulos);
    }

    public function getArticulos(): array
    {
        return $this->articulos;
    }

    public function articulos(?PDO $pdo = null)//: array
    { // [ id => [articulo, cantidad] ]
        $pdo = $pdo ?? conectar();
        //$ids = array_keys($this->getArticulos());
        $marcadores = implode(',', array_fill(0, count($this->getArticulos()), '?'));
        $sent = $pdo->prepare("SELECT * FROM articulos
                                        WHERE id in ($marcadores)");
        $sent->execute(array_keys($this->getArticulos()));
        // $sent->execute([':ids' => $ids]);
        $res = [];
        foreach ($sent as $fila) {
            $articulo = new Articulo($fila);
            $id = $articulo->id;
            $res[$id] = [$articulo, $this->getArticulos()[$id]];
        }
        return $res;
    }
}