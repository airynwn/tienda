# tienda

front office: portal de los clientes /index.php

back office: portal de la administracion (CRUD) /admin/index.php

projects -> crear nuevo proyecto -> board
workflows -> items added to project -> quitar "issues" de when y activarlo
item reopened -> ta bien, activar
no vamos a trabajar peticiones asi qeu nonse toca nad mas
asociar proyecto: projects -> add project

---

issues (incidencias) : requisito a implementar o a resolver, algo que hay que hacer

new issue -> titulo y comentario (`texto`-> caracteres monoespaciado)
assignee -> asignar una issue a alguien
labels -> etiquetas  (ej: requisito funcional), añadir titulo, descripcion y color
project -> asignar issue al proyecto indicado
milestone -> hitos. el proyecto hay tres hitos: abril, mayo y junio. es una estimacion que se hace al principio de cuando se va a tener hecho (v1, v2, v3). no se pone de momento, es mas para el tfg

al crear una issue: en la ventana de la issue -> projects -> status: todo, y esto se ve en la ventana del proyecto

-- crear una rama para cada incidencia y situarse en ella:

git checkout -b rama

-- borrar rama

git checkout -D rama


daw@alumno:~/Escritorio/tienda$ sudo -u postgres createuser -P tienda
[sudo] contraseña para daw:
could not change directory to "/home/daw/Escritorio/tienda": Permiso denegado
Enter password for new role:
Enter it again:
daw@alumno:~/Escritorio/tienda$ sudo -u postgres createdb -O tienda tienda
could not change directory to "/home/daw/Escritorio/tienda": Permiso denegado
daw@alumno:~/Escritorio/tienda$ psql -h localhost -U tienda -d tienda < tienda.sql
