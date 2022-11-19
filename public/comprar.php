<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <?php
    require '../src/auxiliar.php';


    $userid = unserialize($_SESSION['login'])->id;
    $carrito = unserialize(carrito());
    $values = obtener_post('values');

    $pdo = conectar();

    if (isset($values)) { //si vengo de mi mismo...
        $alert = true;
        $values = substr($values, 0, strlen($values) - 1);
        $sent = $pdo->query('INSERT INTO compras
                        (usuario_id, producto_id, cantidad, fecha_compra)
                        VALUES' . $values);


        unset($_SESSION['carrito']);
        $_SESSION['compra'] = 'Compra realizada con éxito.';
        return volver();
        // sacar los id de las compras cuyo timestamp sea now (?)
    }

    ?>
    <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Producto
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Cantidad
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Precio
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($carrito->articulos() as $id => $pareja) :
                    [$articulo, $cantidad] = $pareja;
                    $values = $values . '(' . implode(',', [$userid, $id, $cantidad, 'current_timestamp']) . '),';
                ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $articulo->descripcion ?>
                        </th>
                        <td class="py-4 px-6">
                            <?= $cantidad ?>
                        </td>
                        <td class="py-4 px-6">
                            <?= $precioprod = $articulo->precio * $cantidad ?>
                        </td>
                    </tr>


                <?php
                    $total += $precioprod;
                endforeach;
                ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Total
                    </th>
                    <td></td>
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= $total ?>
                    </td>
            </tbody>
        </table>
    </div>

    <div>
        <form action="" method="POST">
            <input type="hidden" name="values" value="<?= $values ?>">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Comprar</button>
        </form>
        <a href="/vaciar_carrito.php" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancelar compra</a>
    </div>
    <script src="/js/flowbite/flowbite.js"></script>
</body>

</html>