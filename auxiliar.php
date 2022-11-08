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
    $error[campo][] = $mensaje;
}

functon validar_digitos($numero, $campo, &$error)
{
    if (!ctype_digit($codigo)) {
        insertar_error($campo, 'Los caracteres no son válidos', $error);
    }
    return false;
}

function validar_codigo($codigo, &$error)
{
    
}