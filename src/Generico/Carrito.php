<?php

namespace App\Generico;

use App\Tablas\Articulo;
use ValueError;

class Carrito extends Modelo
{
    private array $lineas;
    // propiedad dinamica: en psysh por ej
    // $c->pepe = 'hola';
    // propiedades predeterminadas: las que estan definidas en el archivo (estas)
    public function __construct()
    { // crea lista de articulos para meter [id=>cantidad]
        $this->lineas = [];
    }

    public function insertar($id)
    {
        if (!($articulo = Articulo::obtener($id))) { // :: operador de resolucion de ambito - busca el
            throw new ValueError('El artículo no existe.');
        } // metodo estatico obtener() de la clase articulo
        // Si ya está el artículo en el carrito le suma 1
        if (isset($this->lineas[$id])) {
            $this->lineas[$id]->incrCantidad();
        } else { // sino mete el primero
            $this->lineas[$id] = new Linea($articulo);
        }
    }

    public function eliminar($id)
    {
        if (isset($this->lineas[$id])) {
            $this->lineas[$id]->decrCantidad(); // Si ya está en el carrito le resta 1
            if ($this->lineas[$id]->getCantidad() == 0) {
                unset($this->lineas[$id]); // y si quedan 0, lo quita
            }
        } else {
            throw new ValueError('Artículo inexistente en el carrito');
        }
    }

    public function vacio(): bool
    {
        return empty($this->lineas);
    }

    public function getLineas(): array
    {
        return $this->lineas;
    }
}