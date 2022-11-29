<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/output.css" rel="stylesheet">
    <title>Registrarse</title>
</head>

<body>
    <?php
    require_once '../src/auxiliar.php';

    $login = obtener_post('login');
    $password = obtener_post('password');
    $password2 = obtener_post('password2');

    $clases_label = "block mb-2 text-sm font-medium text-blue-700 dark:text-blue-500";
    $clases_input = '';
    $error = false;

    // Funciona pero está feo el código + mejorar $error?
    
    if (isset($login) && isset($password)) {
        if ($password != $password2) {
            // Validación de la repetición de la contraseña
        ?>
            <div class="flex p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Contraseña incorrecta</span>
                <div>
                    <span class="font-medium">Las contraseñas deben ser iguales.</span>
                </div>
            </div>
        <?php
        $error = true;
        }
        if (strlen($login) < 1) {
            // El usuario no puede estar vacío
            ?>
            <div class="flex p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Usuario incorrecto</span>
                <div>
                    <span class="font-medium">El usuario no puede estar vacío.</span>
                </div>
            </div>
        <?php
        $error = true;
        }
        if (strlen($password) < 1) {
            // La contraseña no puede estar vacía
            ?>
            <div class="flex p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Contraseña incorrecta</span>
                <div>
                    <span class="font-medium">La contraseña no puede estar vacía.</span>
                </div>
            </div>
        <?php
        $error = true;
        }
        if (!\App\Tablas\Usuario::existe($login)) {
            if (!$error) {
            // Si pw1=pw2, no existe un usuario con ese nombre,
            // el login y la contraseña no son vacíos (no hay errores); lo crea.
            $pdo = conectar();
            $sent = $pdo->prepare('INSERT INTO usuarios (usuario, password)
                    VALUES (:usuario, crypt(:password, gen_salt(\'bf\', 10)))');
            $sent->execute([':usuario' => $login, ':password' => $password]);
        ?>
            <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Registro exitoso</span>
                <div>
                    <span class="font-medium">Se ha creado la cuenta con éxito.</span>
                </div>
            </div>
        <?php
            }
        } else {
            // Si pw1=pw2 pero el usuario existe, error de que ya existe
            $error = true;
            $clases_label = "text-blue-700 dark:text-blue-500";
            $clases_input = "bg-blue-50 border border-blue-500 text-blue-900 placeholder-blue-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-100 dark:border-blue-400";
        ?>

            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Registro incorrecto</span>
                <div>
                    <span class="font-medium">El nombre de usuario especificado ya existe.</span>
                </div>
            </div>

    <?php
        }
    }

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
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium <?= $clases_label ?>">Repetir contraseña</label>
                    <input type="password" name="password2" id="password2" class="border text-sm rounded-lg block w-full p-2.5 <?= $clases_input ?>">
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrarse</button>
            </form>
        </div>
    </div>
    <script src="/js/flowbite/flowbite.js"></script>
</body>

</html>