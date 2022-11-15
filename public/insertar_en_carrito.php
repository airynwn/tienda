<?php

session_start();

require '../src/Carrito.php';
require '../src/auxiliar.php';

try {
    $id = obtener_get('id');
    if ($id === null) {
        return volver();
    }

    $carrito = unserialize(carrito());
    $carrito->insertar($id);
    $_SESSION['carrito'] = serialize($carrito);

} catch (ValueError $e) {
    //todo alert con mensaje de error
}

volver();