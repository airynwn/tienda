# Tienda online
La tienda gestiona un conjunto de artículos que disponen de un código único, una descripción y un precio. Los artículos se pueden ver, insertar, borrar y modificar.

- **Front office** -> Portal de los clientes. `/index.php`
- **Back office** -> Portal de la administracion (CRUD). `/admin/index.php`

- [x] Vista de artículos
  - **Funciones auxiliares**
    - [x] Conexión a la base de datos
    - [x] Obtener parámetro (GET/POST)
    - [x] Output escaping (htmlspecialchars)
  - Index - **SQL**
    - [x] GET de los parámetros a mostrar (excepto ID)
    - [x] Conexión DB, transacción y bloqueo de tabla
    - [x] Preparación y ejecución de la sentencia de selección (where y execute vacíos)
  - Index - **Tabla HTML**
    - [x] **Columnas**: Nombres de los campos de la tabla
    - [x] **Filas**: Recorrer la sentencia de selección por cada columna (+ output escaping)
- [ ] Insertar artículo
  - **Index**
    - [x] Botón `Insertar` bajo la tabla
  - **Funciones auxiliares**
    - [ ] Volver al index (header)
    - [ ] Validar código (13 caracteres alfanuméricos)
    - [ ] Validar descripción (1 - 255 caracteres alfabéticos)
    - [ ] Validar precio (xxxxxxx.xx dígitos)
    - [ ] Comprobar que no exista un artículo con el código introducido
    - [ ] Comprobar si el array de errores no está vacío
    - [ ] Mostrar mensajes de error
  - Insertar - **SQL**
    - [x] POST de los parámetros a usar para la inserción introducidos en el formulario
    - [x] Creación del array de errores
    - [ ] Validación y comprobación de errores
    - [ ] Conexión DB, preparación y ejecución de la sentencia de inserción (+ placeholders) y vuelta al index
  - Insertar - **Formulario HTML**
    - [ ] Formulario POST con un input por cada campo
    - [ ] Botón para enviar datos
    - [ ] Al enviar, mostrar los errores hasta que se solucionen
- [ ] Borrar artículo
  - Index - **Tabla HTML**
    - [ ] Crear una columna `Acciones` con un botón `Borrar` por cada fila
  - Borrar - **SQL**
    - [ ] Confirmar borrado con GET del ID de la fila en un `hidden input` o rechazar (vuelta al index)
    - [ ] POST del ID a borrar
    - [ ] Conexión DB, transacción y bloqueo de tabla
    - [ ] Preparación y ejecución de la sentencia de borrado por ID (+ ID placeholder) y vuelta al index
- [ ] Modificar artículo
  - Index - **Tabla HTML**
    - [ ] Añadir un botón `Modificar` por cada fila en la columna `Acciones`
  - Modificar - **SQL**
    - [ ] GET del ID
    - [ ] POST de los parámetros a modificar introducidos en el formulario
    - [ ] Creación del array de errores
    - [ ] Validación y comprobación de errores (*igual que insertar y sus funciones*)
    - [ ] Conexión DB, preparación y ejecución de la sentencia de modificación según el ID (+ placeholders) 
  - Modificar - **Formulario HTML** (*igual que insertar*)
    - [ ] Formulario POST con input por cada campo, botón de enviar y muestra de errores
------------


# Cómo crear un proyecto
1. **Projects**. Desde un repositorio: `Projects` -> Crear nuevo proyecto -> Elegir template (**board**).
2. **Workflows**. Cambiar o activar las siguientes opciones: 
   - `Items added to project` Quitar "issues" de when y activarlo. 
   - `Item reopened` Activar. 
   - No vamos a trabajar con peticiones, así que de momento no tocamos más.
3. **Asociar proyecto**. `Projects` -> Add project.

## Issues
Las incidencias son requisitos a implementar o problemas a resolver, es decir, algo que está por hacer. Al crear una nueva incidencia se usan las siguientes opciones:

- **New issue**
  -  Título  (*borrar un artículo*).
  - Comentario (*el usuario podrá borrar un artículo desde el panel principal de administración*).
- **Assignee** -> Asignar una issue a alguien (*a uno mismo*).
- **Labels** -> Etiquetas (ej: *requisito funcional*). Se puede añadir título, descripción y color a las etiquetas creadas.
- **Project** -> Asignar issue al proyecto indicado.
- **Milestone** -> Hitos. En principio sólo se usarán en el proyecto final, en el cual hay tres hitos: abril, mayo y junio. Es una estimación que se hace al principio de cuándo se va a tener hecho (v1, v2, v3).

Al crear una issue, entraremos en su página para cambiar `Status: Todo` en la sección `Projects`. Esto se verá reflejado en el board del proyecto.

Una vez creada una incidencia, podemos continuar creando una rama.

## Ramas
La idea es crear una rama para trabajar cada una de las incidencias y fusionarla con la rama principal una vez se haya resuelto la incidencia.

- `git checkout -b rama` Crea la rama `rama` y se sitúa en ella.
- `git push -u origin rama` Envía los archivos locales al repositorio remoto. El `-u origin rama` sólo se pone la primera vez para cada rama para crearla en Github.
- `git pull` Trae los archivos del repositorio remoto al local.
- `git merge main` Desde la rama alternativa de trabajo, se usa para fusionarse con la rama principal para empezar trabajando con sus archivos.
- `git checkout main README.md` Desde una rama alternativa, trae el README de la rama principal.
- [CUIDADO] `git branch -D rama` Fuerza el borrado de la rama `rama`.

## Pull request
Por cada incidencia que se esté trabajando, tras crear la rama, se creará su pull request correspondiente desde Github. Su función es cerrar la incidencia, fusionando los contenidos de la rama alternativa con la rama principal. También permite borrar fácilmente la rama alternativa una vez se ha terminado de trabajar la incidencia.

- Crear pull request `base: main` `compare:rama`.
- **Título**: el mismo que el de la incidencia.
- **Comentario**: `Closes #`, `Fixes #` (seleccionar incidencia).

------------


# Creación de la base de datos
- Crear usuario: `sudo -u postgres createuser -P tienda`
- Crear database: `sudo -u postgres createdb -O tienda tienda`
- Ejecutar las sentencias del archivo SQL: `psql -h localhost -U tienda -d tienda < tienda.sql`

------------


# Resumen
1. Crear incidencia a resolver/implementar
2. Crear rama para dicha incidencia y pushearla
3. Crear el pull request correspondiente
4. Escribir el código que resuelva o implementa la incidencia
5. Cerrar el pull request y mergearlo con main
6. Repetir 1-5 hasta el final
