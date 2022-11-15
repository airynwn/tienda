<?php

require_once 'Articulo.php';

class Carrito
{
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
}