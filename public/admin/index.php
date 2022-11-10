<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <title>Listado de artículos</title>
</head>
<body>
    <?php
    require '../../src/auxiliar.php';
    $pdo = conectar();
    $sent = $pdo->query("SELECT * FROM articulos ORDER BY codigo");

    ?>

    <!-- Tabla de artículos HTML -->
    <div class="container mx-auto">
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
        </div>
        <a href="insertar.php">Insertar un nuevo artículo</a>
    </div>
    <script src="/js/flowbite.js"></script>
</body>
</html>