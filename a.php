<?php
// tailwindcss.com/docs/installation
// sudo apt install npm 
// dentro del directorio del proyecto (raiz):
// npm install -D tailwindcss
// node_modules no se mete en el commit -> se mete en gitignore
// npx tailwindcss init
// se crea la carpeta public donde se mete lo que va a publicar del server web al exterior
// ej: no queremos meter el sql, ni el auxiliar...
// fuera tambien va la carpeta que seria admin/comunes con su auxiliar.php y se renombra a adminauxiliars
// se mete las cosa que no se quieren publicar en una carpet anueva: src
// y gitignore tailwind etc se queda en la raiz
// php -S 127.0.0.1:8000 -t public
// crear el src/input.css con el contenido que pone
// crear carpeta public/css
// npx tailwindcss -i ./src/input.css -o .public/css/output.css --watch
// muchas cosas...
// github.com/themesberg/flowbite -- flowbite.com
// npm install -D flowbite
// 

// 11-11
/*

cd <public/js
</ ln -s ../../node_modules/flowbite/dist flowbite

*/