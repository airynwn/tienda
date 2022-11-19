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
    $sent = $pdo->prepare('SELECT nombre, descripcion, precio, sum(cantidad) AS suma
                            FROM categorias c JOIN articulos a
                            ON c.id = a.categoria_id
                            JOIN compras b
                            ON b.producto_id = a.id
                            WHERE nombre = (
                                SELECT nombre
                                FROM categorias c JOIN articulos a
                                ON c.id = a.categoria_id
                                JOIN compras b
                                ON b.producto_id = a.id
                                WHERE usuario_id = :userid
                                ORDER BY fecha_compra DESC
                                LIMIT 1)
                            GROUP BY nombre, descripcion, precio
                            ORDER BY suma DESC
                            LIMIT 2');
    $sent->execute([':userid' => $userid]);
    // Categoría, Producto y Precio cuya categoría sea la misma que la del último producto comprado.
    // Cosas a cambiar: El último producto comprado es random si la última vez se compró más de un producto
    
    ?>
<div class="overflow-x-auto relative shadow-md sm:rounded-lg">
<?php require '../src/_menu.php' ?>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Productos recomendados
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Estos son los productos que te recomendamos en función de tus últimas compras. Son los dos productos más vendidos de su categoría.</p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Categoría
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Producto
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Precio
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sent as $fila) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= hh($fila['nombre']) ?>
                        </th>
                        <td class="py-4 px-6">
                            <?= hh($fila['descripcion']) ?>
                        </td>
                        <td class="py-4 px-6">
                            <?= hh($fila['precio']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<script src="/js/flowbite/flowbite.js"></script>
</body>
</html>