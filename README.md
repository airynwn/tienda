# Tienda online
La tienda gestiona un conjunto de artículos que disponen de un código único, una descripción y un precio. Los artículos se pueden ver, insertar, borrar y modificar.

- **Front office** --> Portal de los clientes. `/index.php`
- **Back office** --> Portal de la administracion (CRUD). `/admin/index.php`

- [x] Vista de artículos
- [ ] Insertar artículo
- [ ] Borrar artículo
- [ ] Modificar artículo

------------


# Cómo crear un proyecto
1. **Projects**. Desde un repositorio: `Projects` -> Crear nuevo proyecto -> Elegir template (**board**).
2. **Workflows**. Cambiar o activar las siguientes opciones: 
   - `Items added to project` Quitar "issues" de when y activarlo. 
   - `Item reopened` Activar. 
   - No vamos a trabajar con peticiones, así que de momento no tocamos más.
3. **Asociar proyecto**. `Projects` --> Add project.

## Issues
Las incidencias son requisitos a implementar o problemas a resolver, es decir, algo que está por hacer. Al crear una nueva incidencia se usan las siguientes opciones:

- **New issue**
  -  Título  (*borrar un artículo*).
  - Comentario (*el usuario podrá borrar un artículo desde el panel principal de administración*).
- **Assignee** --> Asignar una issue a alguien (*a uno mismo*).
- **Labels** --> Etiquetas (ej: *requisito funcional*). Se puede añadir título, descripción y color a las etiquetas creadas.
- **Project** --> Asignar issue al proyecto indicado.
- **Milestone** --> Hitos. En principio sólo se usarán en el proyecto final, en el cual hay tres hitos: abril, mayo y junio. Es una estimación que se hace al principio de cuándo se va a tener hecho (v1, v2, v3).

Al crear una issue, entraremos en su página para cambiar `Status: Todo` en la sección `Projects`. Esto se verá reflejado en el board del proyecto.

Una vez creada una incidencia, podemos continuar creando una rama.

## Ramas
La idea es crear una rama para trabajar cada una de las incidencias y fusionarla con la rama principal una vez se haya resuelto la incidencia.

- `git checkout -b rama` Crea la rama `rama` y se sitúa en ella.
- `git push -u origin rama` Envía los archivos locales al repositorio remoto. El `-u origin rama` sólo se pone la primera vez para cada rama para crearla en Github.
- `git pull` Trae los archivos del repositorio remoto al local.
- `git merge main` Desde la rama alternativa de trabajo, se usa para fusionarse con la rama principal para empezar trabajando con sus archivos.
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
