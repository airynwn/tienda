<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <title>Historial de compras</title>
</head>

<body>
    <?php
    require '../src/auxiliar.php';
    $userid = unserialize($_SESSION['login'])->id;
    
    $pdo = conectar();
    $sent = $pdo->prepare('SELECT descripcion, cantidad, precio, fecha_compra::timestamp(0) AS fecha
                             FROM articulos a JOIN compras c ON a.id = c.producto_id
                            WHERE usuario_id = :userid
                            ORDER BY fecha_compra DESC');
    $sent->execute([':userid' => $userid]);
    
    ?>
<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
<?php require '../src/_menu.php' ?>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Historial de compras
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Lista de productos que has comprado últimamente.</p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Producto
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Precio
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Cantidad
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Fecha de la compra
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sent as $fila) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= hh($fila['descripcion']) ?>
                        </th>
                        <td class="py-4 px-6">
                            <?= hh($fila['precio']) ?>
                        </td>
                        <td class="py-4 px-6">
                            <?= hh($fila['cantidad']) ?>
                        </td>
                        <td class="py-4 px-6">
                            <?= hh($fila['fecha']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<script src="/js/flowbite/flowbite.js"></script>
</body>
</html>