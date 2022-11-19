<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <title>Portal</title>
</head>

<body>
    <?php
    require_once '../src/auxiliar.php'; // carga el autoloader, que cargara  en todos
    // hay que serializar para no meter objeto en una sesion
    $carrito = unserialize(carrito());

    $pdo = conectar();
    $sent = $pdo->query("SELECT * FROM articulos ORDER BY codigo");
    // en el link de añadir al carrito meter el id(?)
    // carrito = variable de sesion
    ?>
    <div class="container mx-auto">
        <?php require '../src/_menu.php' ?>
        <?php require '../src/_alert_compra.php' ?>
        <div class="flex">
            <main class="flex-1 grid grid-cols-3 gap-4 justify-center justify-items-center">
                <?php foreach ($sent as $fila) : ?>
                    <div class="p-6 max-w-xs min-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= hh($fila['descripcion']) ?></h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?= hh($fila['descripcion']) ?></p>
                        <a href="/insertar_en_carrito.php?id=<?= $fila['id'] ?>" class="inline-flex items-center py-2 px-3.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Añadir al carrito
                            <svg aria-hidden="true" class="ml-3 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                <?php endforeach ?>
            </main>

            <?php if (!$carrito->vacio()) : ?>
                <aside class="flex flex-col items-center w-1/4" aria-label="Sidebar">
                    <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                        <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th scope="col" class="py-3 px-6">Descripción</th>
                                <th scope="col" class="py-3 px-6">Cantidad</th>
                                <th scope="col" class="py-3 px-6">Precio</th>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($carrito->articulos() as $id => $pareja) :
                                ?>
                                    <?php [$articulo, $cantidad] = $pareja; ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6"><?= $articulo->descripcion ?></td>
                                        <td class="py-4 px-6 text-center"><?= $cantidad ?></td>
                                        <td class="py-4 px-6 text-center"><?= $precioprod = $articulo->precio * $cantidad ?></td>
                                    </tr>
                                <?php
                                    $total += $precioprod;
                                endforeach;
                                ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" style="display:flex; flex-direction:row-reverse">
                                    <td class="py-4 px-6 text-right">Total: <?= $total ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <a href="/vaciar_carrito.php" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Vaciar carrito</a>
                        <a href="/comprar.php" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Comprar</a>
                    </div>
                </aside>
            <?php endif ?>
        </div>
    </div>

    <?php
    $sent = $pdo->query('SELECT descripcion, precio, sum(cantidad) AS suma
                    FROM articulos a JOIN compras c
                    ON a.id = c.producto_id
                    GROUP BY descripcion, precio
                    ORDER BY suma DESC');
    ?>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Productos más solicitados
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Aquí encontrarás una lista de nuestos productos más queridos por los clientes acompañados de su precio.</p>
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
                        Número de compras totales
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
                            <?= hh($fila['suma']) ?>

                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script src="/js/flowbite/flowbite.js"></script>
</body>

</html>