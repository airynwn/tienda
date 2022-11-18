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
    require_once '../src/auxiliar.php';

    $login = obtener_post('login');
    $password = obtener_post('password');

    $clases_label = "block mb-2 text-sm font-medium text-blue-700 dark:text-blue-500";
    $clases_input = '';
    $error = false;

    if (isset($login, $password)) {
        if ($usuario = Usuario::comprobar($login, $password)) {
            // Loguear al usuario
            $_SESSION['login'] = serialize($usuario);
            return volver();
        } else {
            // Mostrar error de validación
            $error = true;
            $clases_label = "text-blue-700 dark:text-blue-500";
            $clases_input = "bg-blue-50 border border-blue-500 text-blue-900 placeholder-blue-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-100 dark:border-blue-400";
    ?>

            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Login incorrecto</span>
                <div>
                    <span class="font-medium">El usuario y/o la contraseña introducidos no son válidos</span>
                </div>
            </div>

    <?php
        }
    }
// MIRAR QUE NO VAN BIEN LOS COLORES
    ?>
    <div class="container mx-auto">
        <?php require '../src/_menu.php' ?>
        <div class="mx-72">
            <form action="" method="POST">
                <div class="mb-6">
                    <label for="login" class="block mb-2 text-sm font-medium <?= $clases_label ?>">Nombre de usuario</label>
                    <input type="text" name="login" id="login" class="border text-sm rounded-lg block w-full p-2.5 <?= $clases_input ?>">
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium <?= $clases_label ?>">Contraseña</label>
                    <input type="password" name="password" id="password" class="border text-sm rounded-lg block w-full p-2.5 <?= $clases_input ?>">
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
            </form>
        </div>
    </div>
    <script src="/js/flowbite/flowbite.js"></script>
</body>

</html>