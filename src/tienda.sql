DROP TABLE IF EXISTS categorias CASCADE;

CREATE TABLE categorias (
    id      bigserial       PRIMARY KEY,
    nombre  varchar(255)    NOT NULL UNIQUE
);

DROP TABLE IF EXISTS articulos CASCADE;

CREATE TABLE articulos (
    id              bigserial      PRIMARY KEY,
    codigo          varchar(13)    NOT NULL UNIQUE,
    descripcion     varchar(255)   NOT NULL, -- nombre del articulo
    precio          numeric(7, 2)  NOT NULL, -- pvp (precio de venta al publico)
    categoria_id    bigint         NOT NULL REFERENCES categorias (id)
);

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
    id          bigserial       PRIMARY KEY,
    usuario     varchar(255)    NOT NULL UNIQUE,
    password    varchar(255)    NOT NULL
);

DROP TABLE IF EXISTS compras CASCADE;

CREATE TABLE compras (
    id              bigserial       PRIMARY KEY,
    usuario_id      bigint          NOT NULL REFERENCES usuarios (id),
    producto_id     bigint          NOT NULL REFERENCES articulos (id),
    cantidad        bigint          NOT NULL,
    fecha_compra    timestamp       NOT NULL
);



-- Carga inicial de datos de prueba:

INSERT INTO categorias (nombre)
    VALUES ('Comida'), ('Videojuegos'), ('Componentes de PC');

INSERT INTO articulos (codigo, descripcion, precio, categoria_id)
    VALUES ('18273892389', 'Yogur piña', 200.50, 1),                -- COMIDA --
           ('83745828273', 'Tigretón', 50.10, 1),
           ('21289812019', 'Fideos chinos', 17.34, 1),
           ('92910290130', 'Mandarinas', 405.25, 1), 
           ('11234392934', 'Pac-Man', 29.99, 2),                    -- VIDEOJUEGOS --
           ('99999912345', 'Pokémon Escarlata', 46.90, 2),
           ('99999999456', 'Pokémon Púrpura', 47.99, 2),
           ('51786128495', 'Disco duro SSD 500 GB', 150.30, 3),     -- COMPONENTES --
           ('73469102340', 'Stick de memoria RAM 16 GB', 100.0, 3),
           ('63210905218', 'AMD Radeon RX 6000', 749.80, 3);

INSERT INTO usuarios (usuario, password)
    VALUES ('admin', crypt('admin', gen_salt('bf', 10))),
           ('pepe', crypt('pepe', gen_salt('bf', 10)));
-- create extension pgcrypto; -- por cada base de datos (extension criptografica para passwords)
-- sudo -u postgres psql template1 -- instalarla en la 
-- alter database template1 refresh collation version; -- para el error de collation version mismatch
-- create extension pgcrypto; -- en template1 y en tienda
-- ahora cada database nueva que se cree ya tendra la extension crypto instalada
-- -- select crypt('pepe', gen_salt('bf', 10));

    