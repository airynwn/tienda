<?php

// spl_autoload_register(function ($class) {
//     require_once $class . '.php';
// });
require __DIR__ . '/../vendor/autoload.php';
// he tenido que añadir __DIR__ . '/ (...) para que vaya

// Funciones

/**
 * Conexión a la base de datos tienda.
 */
function conectar()
{
    return new \PDO('pgsql:host=localhost;dbname=tienda', 'tienda', 'tienda');
}

function obtener_parametro($par, $array)
{
    return isset($array[$par]) ? trim($array[$par]) : null;
}

function obtener_get($par)
{
    return obtener_parametro($par, $_GET);
}

function obtener_post($par)
{
    return obtener_parametro($par, $_POST);
}

function hh($x)
{
    return htmlspecialchars($x ?? '', ENT_QUOTES | ENT_SUBSTITUTE);
}

function dinero($s)
{
    return number_format($s, 2, ',', ' ') . ' €';
}

function volver()
{
    header("Location: /index.php");
}

function volver_admin()
{
    header("Location: /admin/");
}

function redirigir_login()
{
    header('Location: /login.php');
}

function carrito()
{ // crea un carrito por cada sesion nueva
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = serialize(new \App\Generico\Carrito());
    } // y si ya existe lo devuelve
    return $_SESSION['carrito'];
}

function carrito_vacio()
{
    $carrito = unserialize(carrito());

    return $carrito->vacio();
}

function insertar_error($campo, $mensaje, &$error)
{
    if (!isset($error[$campo])) {
        $error[$campo] = [];
    }
    $error[$campo][] = $mensaje;
}



function validar_digitos($dig, $campo, &$error)
{
    if (!ctype_digit($dig)) {
        insertar_error($campo, 'Los caracteres no son válidos', $error);
    }
    return false;
}

function validar_longitud($cadena, $campo, $min, $max, &$error)
{
    $long = mb_strlen($cadena);

    if ($long < $min || $long > $max) {
        insertar_error(
            $campo,
            'La longitud del campo es incorrecta',
            $error
        );
    }
}

function validar_codigo($codigo, &$error)
{
    validar_longitud($codigo, 'codigo', 1, 13, $error);
    if (!isset($error['codigo'])) {
        // comprobar si existe ya un articulo con ese codigo
    }
}