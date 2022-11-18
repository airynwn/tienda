DROP TABLE IF EXISTS articulos CASCADE;

CREATE TABLE articulos (
    id           bigserial      PRIMARY KEY,
    codigo       varchar(13)    NOT NULL UNIQUE,
    descripcion  varchar(255)   NOT NULL, -- nombre del articulo
    precio       numeric(7, 2)  NOT NULL -- pvp (precio de venta al publico)
);

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
    id          bigserial       PRIMARY KEY,
    usuario     varchar(255)    NOT NULL UNIQUE,
    password    varchar(255)    NOT NULL
);

-- Carga inicial de datos de prueba:

INSERT INTO articulos (codigo, descripcion, precio)
    VALUES ('18273892389', 'Yogur piña', 200.50),
           ('83745828273', 'Tigretón', 50.10),
           ('51786128495', 'Disco duro SSD 500 GB', 150.30);

-- create extension pgcrypto; -- por cada base de datos (extension criptografica para passwords)
-- sudo -u postgres psql template1 -- instalarla en la 
-- alter database template1 refresh collation version; -- para el error de collation version mismatch
-- create extension pgcrypto; -- en template1 y en tienda
-- ahora cada database nueva que se cree ya tendra la extension crypto instalada
-- -- select crypt('pepe', gen_salt('bf', 10));

INSERT INTO usuarios (usuario, password)
    VALUES ('pepe', crypt('pepe', gen_salt('bf', 10)));