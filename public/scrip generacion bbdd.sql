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
	descripcion VARCHAR(500),
	precio  DECIMAL(10,2),
	stock INT,
	valoracion NUMERIC(10,2),
	url_foto VARCHAR(500),
	id_resenia INT
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
	precio_unitario  DECIMAL(10, 2) NOT NULL,
	precio_linea  DECIMAL(10, 2) NOT NULL,
	id_pedido INT NOT NULL
	);
	
	CREATE TABLE INCIENSOSDESEVILLA.ESTADO(
	id SERIAL NOT NULL PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL
	);
	
	CREATE TABLE INCIENSOSDESEVILLA.PEDIDO(
	id SERIAL NOT NULL PRIMARY KEY,
	fecha DATE NOT NULL,
	total  DECIMAL(10, 2) NOT NULL,
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
	
INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('¡A la Gloria!', 'Incienso cofrade de aroma cítrico, color azul cielo y humo intenso', 4.99, 45, 4.2, 1, 'https://inciensosdesevilla.es/173-large_default/a-la-gloria.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Arco del Postigo', 'Incienso de aroma muy cofrade inspirado por el gestor de la mejor cuenta cofrade en redes sociales', 4.50, 32, 4.5, 1, 'https://inciensosdesevilla.es/174-large_default/arco-del-postigo.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Arenas del Camino', 'Incienso de verano con un aroma suave inspirado en los caminos del Rocío', 4.75, 28, 4.3, 1, 'https://inciensosdesevilla.es/177-large_default/arenas-del-camino.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Aroma de la Cava', 'Incienso con notas dulces y florales en representación a la dulzura de la Virgen del Patrocinio y con olor intenso, amaderado y cofrade en representación al Cristo de la Expiración', 5.25, 15, 4.8, 1, 'https://inciensosdesevilla.es/175-large_default/incienso-aroma-de-la-cava.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Calle Águilas', 'Incienso de aroma afrutado con un ligero toque ácido. De aroma muy atractivo', 4.99, 22, 4.1, 1, 'https://inciensosdesevilla.es/432-large_default/calle-aguilas.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Cuaresma', 'Incienso de aroma suave, de humo medio y ligero aroma acanelado', 4.50, 40, 4.0, 1, 'https://inciensosdesevilla.es/219-large_default/cuaresma.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Epifanía', 'Incienso navideño dedicado a la ofrenda realizada por los Reyes Magos a Jesús, es decir, la Epifanía. Sus principales componentes son representación de los tres regalos entregados', 5.50, 18, 4.7, 1, 'https://inciensosdesevilla.es/221-large_default/epifania.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Expiración', 'Incienso más suave dentro de la gama de los intensos. Ideal para quemar en casa para los amantes de lo "cofrade rancio"', 4.75, 25, 4.2, 1, 'https://inciensosdesevilla.es/222-large_default/expiracion.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Gaspar', 'Incienso muy dulce y navideño. Recuerda su aroma al de la Navidad: sus dulces, su ambiente. Ideal para quemar en casa', 5.25, 20, 4.6, 1, 'https://inciensosdesevilla.es/237-large_default/gaspar.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Gólgota', 'Incienso con aroma suave de la gama seria con un pequeño toque de dulzor floral', 4.99, 30, 4.3, 1, 'https://inciensosdesevilla.es/724-large_default/golgotha.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Iglesia', 'Es el más suave de nuestros inciensos. Con un ligerísimo toque avainillado que apenas tapa el olor del incienso puro de primera calidad', 4.50, 35, 4.4, 1, 'https://inciensosdesevilla.es/223-large_default/iglesia.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Lote Inicio', 'Lote inicio compuesto por un paquete de carbón, 1 paquete de incienso de 40 g de nuestra carta a tu elección y unas pinzas. Todo por 6€', 6.00, 50, 4.9, 1, 'https://inciensosdesevilla.es/1534-large_default/lote-inicio.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Magna Sevilla', 'Incienso cofrade estrenado en nuestro aniversario de la calle Águilas y que dedicamos a la Magna que se celebrará en Sevilla el día 8 de diciembre', 5.50, 15, 4.8, 1, 'https://inciensosdesevilla.es/1516-large_default/magna-sevilla.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Málaga Bendita', 'Incienso en grano inspirado en la Semana Santa malagueña. De olor intenso y dulce, con aroma a jazmín de las biznagas, y a brisa del mar. Humo abundante', 5.25, 28, 4.5, 1, 'https://inciensosdesevilla.es/166-large_default/malaga-bendita.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Mi Madrugá', 'Incienso inspirado en la Madrugada sevillana. Lleva un ingrediente representando a cada hermandad de la noche más hermosa del año', 5.75, 20, 4.9, 1, 'https://inciensosdesevilla.es/225-large_default/mi-madruga.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Noches de Bronce', 'Incienso dedicado a la que fue la Voz de Bronce en la Hermandad de los Gitanos, Juanma Martín. De olor intenso, con canela y clavo y ciertas notas florales dedicadas a la Virgen de las Angustias', 5.25, 25, 4.6, 1, 'https://inciensosdesevilla.es/433-large_default/noches-de-bronce.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Palio', 'Incienso mayoritariamente molido, con aromas florales y dulces. Humo denso', 4.75, 30, 4.2, 1, 'https://inciensosdesevilla.es/226-large_default/palio.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Pasión por Cádiz', 'Incienso dedicado a la Tacita de Plata tiene un aroma dulce, acanelado y con un humo intenso', 5.25, 22, 4.4, 1, 'https://inciensosdesevilla.es/227-large_default/pasion-por-cadiz.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Púrpura', 'Incienso de aroma seco dedicado al que fuera cardenal de Sevilla durante mucho tiempo: Monseñor Amigo. Estéticamente podemos observar su color marrón en representación al espíritu franciscano y púrpura por su arzobispado', 5.50, 18, 4.7, 1, 'https://inciensosdesevilla.es/176-large_default/incienso-purpura.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Rezaré', 'Incienso inspirado en la canción del mítico músico sevillano Silvio. De aroma dulce y floral. Es un incienso con bastante humo y de olor intenso', 5.25, 25, 4.5, 1, 'https://inciensosdesevilla.es/437-large_default/rezare.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('ROMA', 'Incienso dedicado a los Armaos. De aroma muy cofrade', 4.99, 30, 4.3, 1, 'https://inciensosdesevilla.es/434-large_default/roma.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Ruan', 'Incienso inspirado en la hermandad de El Silencio de Sevilla y más concretamente en sus "Nazarenos de Sevilla". El color negro mate con cierto brillo salteado caracteriza estéticamente este producto. Su olor intenso, seco, de cofradía austera. Muy del gusto de los cofrades "rancios"', 5.50, 20, 4.8, 1, 'https://inciensosdesevilla.es/228-large_default/ruan.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Sagrada Familia', 'Incienso de aroma suave y acanelado. Ideal para quemar en Navidad y para los amantes de los inciensos que no sean intensos ni con mucho humo', 4.75, 35, 4.2, 1, 'https://inciensosdesevilla.es/229-large_default/sagrada-familia.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Semana Santa 2020', 'Incienso creado para compensar a todos aquéllos que no pudieron tener incienso en su fecha. De ahí salió este incienso que se ha convertido ya en un mito de Inciensos de Sevilla y que ahora sacamos a la venta como homenaje y agradecimiento a todos nuestros seguidores fieles', 5.99, 15, 4.9, 1, 'https://inciensosdesevilla.es/231-large_default/semana-santa-2020.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Sor Ángela', 'SIN DESCRIPCION', 4.50, 25, 3.9, 1, 'https://inciensosdesevilla.es/230-thickbox_default/sor-angela.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Spes Nostra', 'Incienso de aroma floral intenso. Es muy estilo de Virgen', 4.75, 28, 4.4, 1, 'https://inciensosdesevilla.es/233-large_default/spes-nostra.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Stabat Mater', 'Incienso de intensidad elevada, de los preferidos para los "rancios" con aroma fuerte acanelado. Uno de los favoritos de los amigos de Inciensos de Sevilla', 5.50, 20, 4.8, 1, 'https://inciensosdesevilla.es/234-large_default/stabat-mater.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Stella Maris', 'Incienso tipo clásico, con notas amaderadas, marinas y de un aroma muy cofrade. Dedicado a la Virgen del Carmen', 4.99, 25, 4.5, 1, 'https://inciensosdesevilla.es/235-large_default/stella-maris.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Veracruz', 'Incienso con más aroma a canela. Propio para hermandades de las llamadas serias. Ideal para los amantes de los olores a canela', 4.75, 30, 4.3, 1, 'https://inciensosdesevilla.es/236-large_default/veracruz.jpg');

INSERT INTO inciensosdesevilla.producto (nombre, descripcion, precio, stock, valoracion, id_categoria, url_foto) VALUES ('Aladino', 'Incensario de barro pintado a mano en color metalizado, por su aspecto recuerda a la lampara de aladino',4.99,50,4,2,'https://inciensosdesevilla.es/831-large_default/aladino.jpg');
	
	SELECT * FROM inciensosdesevilla.producto p 
	
	
	
	
	
	
	
