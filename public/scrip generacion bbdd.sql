DROP SCHEMA IF EXISTS INCIENSOSDESEVILLA CASCADE;

CREATE SCHEMA IF NOT EXISTS INCIENSOSDESEVILLA;

CREATE TABLE INCIENSOSDESEVILLA.CATEGORIA(
id SERIAL NOT NULL PRIMARY KEY,
nombre VARCHAR(150) NOT NULL
);

CREATE TABLE INCIENSOSDESEVILLA.PRODUCTO(
id SERIAL NOT NULL PRIMARY KEY,
nombre VARCHAR(100),
id_categoria SMALLINT,
descripcion VARCHAR(255),
precio  NUMERIC(10,2),
stock INT,
valoracion NUMERIC(10,2),
url_foto VARCHAR(500),
id_resenia int
);

CREATE TABLE INCIENSOSDESEVILLA.RESENIA(
id SERIAL NOT NULL PRIMARY KEY,
id_cliente INT NOT NULL,
texto  VARCHAR(500) NOT NULL,
id_producto INT NOT NULL
);


CREATE TABLE INCIENSOSDESEVILLA.LINEAPEDIDO(
id SERIAL NOT NULL PRIMARY KEY,
id_producto INT NOT NULL,
cantidad INT NOT NULL,
precio_unitario NUMERIC(10,2) NOT NULL,
precio_linea NUMERIC(10,2) NOT NULL,
id_pedido INT NOT NULL
);

CREATE TABLE INCIENSOSDESEVILLA.ESTADO(
id SERIAL NOT NULL PRIMARY KEY,
nombre VARCHAR(100) NOT NULL
);

CREATE TABLE INCIENSOSDESEVILLA.PEDIDO(
id SERIAL NOT NULL PRIMARY KEY,
fecha DATE NOT NULL,
total NUMERIC(10,2) NOT NULL,
id_cliente INT NOT NULL,
estado INT NOT NULL
);


CREATE TABLE INCIENSOSDESEVILLA.CLIENTE(
id SERIAL NOT NULL PRIMARY KEY,
nombre VARCHAR(150) NOT NULL,
apellido VARCHAR (150),
correo VARCHAR(100) NOT NULL,
telefono VARCHAR(50) NOT NULL,
id_usuario INT NOT NULL,
dni VARCHAR(50),
direccion VARCHAR(200)
);

CREATE TABLE INCIENSOSDESEVILLA.USUARIO(
id SERIAL NOT NULL PRIMARY KEY,
username VARCHAR(150) NOT NULL,
password VARCHAR(500) NOT NULL,
es_activo BOOLEAN DEFAULT TRUE,
rol SMALLINT NOT NULL
);

--CREACION DE CLAVES EXTERNAS

ALTER TABLE inciensosdesevilla.producto 
ADD CONSTRAINT FK_CATEGORIA_PRODUCTO FOREIGN KEY (id_categoria) REFERENCES INCIENSOSDESEVILLA.CATEGORIA (id);

ALTER TABLE inciensosdesevilla.cliente
ADD CONSTRAINT FK_CLIENTE_USUARIO FOREIGN KEY (id_usuario) REFERENCES INCIENSOSDESEVILLA.USUARIO(id);

ALTER TABLE inciensosdesevilla.pedido
ADD CONSTRAINT FK_CLIENTE_PEDIDO FOREIGN KEY (id_cliente) REFERENCES INCIENSOSDESEVILLA.CLIENTE (id);

ALTER TABLE inciensosdesevilla.resenia 
ADD CONSTRAINT FK_RESENIA_CLIENTE FOREIGN KEY (id_cliente) REFERENCES INCIENSOSDESEVILLA.CLIENTE(id);

ALTER TABLE inciensosdesevilla.lineapedido 
ADD CONSTRAINT FK_LIN_PEDIDO_PEDIDO FOREIGN KEY (id_pedido) REFERENCES INCIENSOSDESEVILLA.PEDIDO(id);

ALTER TABLE inciensosdesevilla.lineapedido 
ADD CONSTRAINT FK_LIN_PEDIDO_PRODUCTO FOREIGN KEY (id_producto) REFERENCES INCIENSOSDESEVILLA.PRODUCTO(id);

ALTER TABLE inciensosdesevilla.resenia 
ADD CONSTRAINT FK_RESENIA_PRODUCTO FOREIGN KEY (id_producto) REFERENCES INCIENSOSDESEVILLA.PRODUCTO(id);

ALTER TABLE inciensosdesevilla.pedido 
ADD CONSTRAINT FK_PEDIDO_ESTADO FOREIGN KEY (estado) REFERENCES INCIENSOSDESEVILLA.ESTADO(id);

ALTER TABLE inciensosdesevilla.producto 
ADD CONSTRAINT FK_PRODUCTO_RESENIA FOREIGN KEY (id_resenia) REFERENCES INCIENSOSDESEVILLA.RESENIA(id);
--INSERT INTO ESTADOS PEDIDO

INSERT INTO inciensosdesevilla.estado (nombre) VALUES ('PENDIENTE');
INSERT INTO inciensosdesevilla.estado (nombre) VALUES ('EN PROCESO');
INSERT INTO inciensosdesevilla.estado (nombre) VALUES ('ENVIADO');

--INSERT INTO CATEGORIA

INSERT INTO inciensosdesevilla.categoria (nombre) VALUES ('INCIENSO');
INSERT INTO inciensosdesevilla.categoria (nombre) VALUES ('ARTESANIA');
INSERT INTO inciensosdesevilla.categoria (nombre) VALUES ('IMAGINERIA');
INSERT INTO inciensosdesevilla.categoria (nombre) VALUES ('FOTOGRAFIA');

-- INSERT INTO USUARIO

INSERT INTO inciensosdesevilla.usuario (username,password,es_activo,rol) VALUES ('admin','admin',TRUE,1);
INSERT INTO inciensosdesevilla.usuario (username,password,es_activo,rol) VALUES ('antonio','1234',TRUE,2);

-- INSERT INTO CLIENTE

INSERT INTO inciensosdesevilla.cliente (correo,direccion,dni,id_usuario,nombre,apellido,telefono) VALUES ('antoniomastin@gmail.com','Calle Condes de Bustillo , 41','26214215L',2,'Antonio','Martin Gonzalez','696325014');

-- INSERT INTO PRODUCTO

INSERT INTO inciensosdesevilla.producto (nombre,descripcion,precio,stock,valoracion,id_categoria)
VALUES ('Arenas del camino','Incienso de verano con un aroma suave inspirado en los caminos del Rocío.',3.90,50,4.2,1);

INSERT INTO inciensosdesevilla.producto (nombre,descripcion,precio,stock,valoracion,id_categoria)
VALUES ('Arco del postigo','Incienso de aroma muy cofrade inspirado por el gestor de la mejor cuenta cofrade en redes sociales.',3.90,50,4.2,1);

INSERT INTO inciensosdesevilla.producto (nombre,descripcion,precio,stock,valoracion,id_categoria)
VALUES ('Aromas de la cava','Tenemos antre nosotros un incienso con notas dulces y florales en representación a la dulzura de la Virgen del Patrocinio y con olor intenso, amaderado y cofrade en representación al Cristo de la Expiración.',3.90,50,4.2,1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Calle Águilas', 'Un incienso con una fragancia que evoca los recuerdos y tradiciones de la calle Águilas.', 3.90, 50, 4.2, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Cuaresma', 'Aromas intensos y especiados que representan la esencia de la cuaresma sevillana.', 3.90, 50, 4.5, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Epifanía', 'Notas frescas y dulces que conmemoran la llegada de los Reyes Magos.', 3.90, 50, 4.0, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Expiración', 'Incienso amaderado y profundo, inspirado en el Cristo de la Expiración.', 3.90, 50, 4.3, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Gaspar', 'Fragancia cálida con un toque oriental, en honor a uno de los Reyes Magos.', 3.90, 50, 4.1, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Gólgotha', 'Aromas fuertes y penetrantes que evocan el monte Gólgotha.', 3.90, 50, 4.0, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Iglesia', 'Clásico aroma a incienso de iglesia, con notas resinosas y especiadas.', 3.90, 50, 4.6, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Lote Inicio', 'Selección de inciensos para quienes inician en el mundo cofrade.', 3.90, 50, 4.2, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Magna Sevilla', 'Fragancia intensa y majestuosa, como las procesiones en la Semana Santa sevillana.', 3.90, 50, 4.5, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Málaga Bendita', 'Dulces y frescas notas que rememoran la belleza de Málaga en Semana Santa.', 3.90, 50, 4.4, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Mi Madrugá', 'Aromas que capturan la esencia y el misterio de la madrugada cofrade.', 3.90, 50, 4.7, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Noches de Bronce', 'Incienso con notas cálidas y envolventes, inspirado en las noches sevillanas.', 3.90, 50, 4.3, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Palio', 'Fragancia floral y delicada, representando el paso bajo palio.', 3.90, 50, 4.6, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Pasión por Cádiz', 'Notas marinas y especiadas, inspiradas en la Semana Santa gaditana.', 3.90, 50, 4.1, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Púrpura', 'Aroma intenso y elegante, asociado con el color de la penitencia.', 3.90, 50, 4.5, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Rezaré', 'Fragancia sutil y espiritual que invita a la meditación y la oración.', 3.90, 50, 4.3, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('ROMA', 'Notas clásicas y elegantes, como la ciudad eterna.', 3.90, 50, 4.4, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Ruan', 'Aromas oscuros y profundos, inspirados en el tejido del ruan.', 3.90, 50, 4.2, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Sagrada Familia', 'Fragancia cálida y familiar, como su propio nombre indica.', 3.90, 50, 4.6, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Semana Santa 2020', 'Aromas nostálgicos que evocan la Semana Santa más especial.', 3.90, 50, 4.1, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Sor Ángela', 'Notas suaves y dulces, inspiradas en la bondad de Sor Ángela.', 3.90, 50, 4.7, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Spes Nostra', 'Fragancia delicada y espiritual, dedicada a la esperanza.', 3.90, 50, 4.4, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Stabat Mater', 'Aromas intensos y solemnes que reflejan la pasión de María.', 3.90, 50, 4.5, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Stella Maris', 'Notas frescas y salinas, inspiradas en la Virgen del Carmen.', 3.90, 50, 4.3, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('Veracruz', 'Aromas amaderados y resinosos que rememoran la cruz de Cristo.', 3.90, 50, 4.6, 1);

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria)
VALUES ('¡A la Gloria!', 'Fragancia vibrante y alegre, que celebra la gloria de la Semana Santa.', 3.90, 50, 4.7, 1);



SELECT * FROM inciensosdesevilla.producto p 







