<?php
// Funciones

/**
 * Conexión a la base de datos tienda.
 */
function conectar()
{
    return new PDO('pgsql:host=localhost;dbname=tienda', 'tienda', 'tienda');
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