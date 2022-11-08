<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
</head>
<body>
    <?php
    require 'auxiliar.php';
    $codigo = obtener_get('codigo');
    $descripcion = obtener_get('descripcion');
    $precio = obtener_get('precio');
    
    // aqui iria el HTML del buscador de productos

    $pdo = conectar();
    $pdo->beginTransaction();
    $pdo->exec('LOCK TABLE articulos IN SHARE MODE');
    $where = '';
    $execute = [];
    $sent = $pdo->prepare("SELECT * FROM articulos $where ORDER BY codigo");
    $sent->execute($execute);
    $pdo->commit();

    ?>

    <!-- Tabla de artículos HTML -->
    <div>
        <table style="margin: auto" border="1">
            <thead>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
            </thead>
            <tbody>
                <?php foreach ($sent as $fila): ?>
                <tr>
                    <td><?= hh($fila['codigo']) ?></td>
                    <td><?= hh($fila['descripcion']) ?></td>
                    <td><?= hh($fila['precio']) ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <a href="insertar.php">Insertar un nuevo artículo</a>
    </div>
</body>
</html>