<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar un nuevo artículo</title>
</head>
<body>
    <?php
    require 'auxiliar.php';
    $codigo = obtener_post('codigo');
    $descripcion = obtener_post('descripcion');
    $precio = obtener_post('precio');
    $test = "hola";
    $pdo = conectar();
    $error = [];
    validar_codigo($codigo, $error);
    validar_digitos($descripcion, 'descripcion', $error);
    validar_longitud()

    // TODO
    // validar el codigo
    // validar la descripcion
    // validar el precio

    // si no hay errores, insertar articulo

    
    ?>
</body>
</html>