<?php

require_once 'Articulo.php';

class Carrito
{
    public $articulos;
    // propiedad dinamica: $c->pepe = 'hola';
    // propiedades predeterminadas: estas
    public function __construct()
    {
        $this->articulos = [];
    }

    public function insertar($id)
    {
        if (!Articulo::existe($id)) {
            throw new ValueError('El artículo no existe.');
        }
        // :: operador de resolucion de ambito, metodo estatico
        // existe de la clase articulo

        if (isset($this->articulos[$id])) {
            $this->articulos[$id]++;
        } else {
            $this->articulos[$id] = 1;
        }
    }

    public function eliminar($id)
    {
        if (isset($this->articulos[$id])) {
            $this->articulos[$id]--;
            if ($this->articulos[$id] == 0) {
                unset($this->articulos[$id]);
            }
        } else {
            throw new ValueError('Artículo inexistente en el carrito');
        }
    }
}