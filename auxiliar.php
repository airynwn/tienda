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

