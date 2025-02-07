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
	activo BOOLEAN DEFAULT TRUE
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
	
	ALTER TABLE inciensosdesevilla.resenia 
	ADD CONSTRAINT FK_RESENIA_PRODUCTO FOREIGN KEY (id_producto) REFERENCES INCIENSOSDESEVILLA.PRODUCTO(id);
	
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
		INSERT INTO inciensosdesevilla.usuario (username,password,es_activo,rol) VALUES ('martin','1234',TRUE,2);

	
	
	-- INSERT INTO CLIENTE
	
	INSERT INTO inciensosdesevilla.cliente (correo,direccion,dni,id_usuario,nombre,apellido,telefono) VALUES ('antoniomastin@gmail.com','Calle Condes de Bustillo , 41','26214215L',2,'Antonio','Martin Gonzalez','696325014');
	INSERT INTO inciensosdesevilla.cliente (correo,direccion,dni,id_usuario,nombre,apellido,telefono) VALUES ('migueldom@gmail.com','Calle Condes de Barcelona, 41','54286301L',2,'Miguel','Dominguez Marin','696325016');

	-- INSERT INTO PRODUCTO
	
	INSERT INTO inciensosdesevilla.producto (id, nombre, id_categoria, descripcion, precio, stock, valoracion, url_foto) VALUES
	(1, 'Arco del Postigo', 1, 'Incienso de aroma muy cofrade inspirado por el gestor de la mejor cuenta cofrade en redes sociales.', 3.90, 15, 0.50, 'https://inciensosdesevilla.es/174-large_default/arco-del-postigo.jpg'),
	(2, 'Arenas del Camino', 1, 'Incienso de verano con un aroma suave inspirado en los caminos del Rocío. ', 3.90, 16, 2.20, 'https://inciensosdesevilla.es/177-large_default/arenas-del-camino.jpg'),
	(3, 'Aroma de la Cava', 1, 'Tenemos antre nosotros un incienso con notas dulces y florales en representación a la dulzura de la Virgen del Patrocinio y con olor intenso, amaderado y cofrade en representación al Cristo de la Expiración.  ', 3.90, 4, 4.30, 'https://inciensosdesevilla.es/175-large_default/incienso-aroma-de-la-cava.jpg'),
	(4, 'Calle Águilas', 1, 'Incienso de aroma afrutado con un ligero toque ácido. De aroma muy atractivo.', 3.90, 14, 0.40, 'https://inciensosdesevilla.es/432-large_default/calle-aguilas.jpg'),
	(5, 'Cuaresma', 1, 'Incienso de aroma suave, de humo medio y ligero aroma acanelado.', 3.90, 27, 2.70, 'https://inciensosdesevilla.es/219-large_default/cuaresma.jpg'),
	(6, 'Epifanía', 1, 'Incienso navideño dedicado a la ofrenda realizada por los Reyes Magos a Jesús, es decir, la Epifanía. Sus principales componentes son representación de los tres regalos entregados:', 3.90, 7, 4.80, 'https://inciensosdesevilla.es/221-large_default/epifania.jpg'),
	(7, 'Expiración', 1, 'Este incienso es el más suave dentro de la gama de los intensos. Ideal para quemar en casa para los amantes de lo "cofrade rancio"', 3.90, 31, 4.70, 'https://inciensosdesevilla.es/222-large_default/expiracion.jpg'),
	(8, 'Gaspar', 1, 'Incienso muy dulce y navideño.  Recuerda su aroma al de la Navidad: sus dulces, su ambiente...  Ideal para quemar en casa.', 3.90, 15, 1.30, 'https://inciensosdesevilla.es/237-large_default/gaspar.jpg'),
	(9, 'Gólgotha', 1, 'Incienso con aroma suave de la gama seria con un pequeño toque de dulzor floral.', 3.90, 43, 3.10, 'https://inciensosdesevilla.es/724-large_default/golgotha.jpg'),
	(10, 'Iglesia', 1, 'Es el más suave de nuestros inciensos.  Con un ligerísimo toque avainillado que apenas tapa el olor del incienso puro de primera calidad.', 3.90, 46, 4.70, 'https://inciensosdesevilla.es/223-large_default/iglesia.jpg'),
	(11, 'Lote Inicio', 1, 'Lote inicio compuesto por un paquete de carbón, 1 paquete de incienso de 40 g de nuestra carta a tu elección y unas pinzas.  Todo por 6€', 7.00, 36, 3.10, 'https://inciensosdesevilla.es/1534-large_default/lote-inicio.jpg'),
	(12, 'Magna Sevilla', 1, 'El incienso cofrade estrenado en nuestro aniversario de la calle Águilas y que dedicamos a la Magna que se celebrará en Sevilla el día 8 de diciembre.', 3.90, 22, 4.60, 'https://inciensosdesevilla.es/1516-large_default/magna-sevilla.jpg'),
	(13, 'Málaga Bendita', 1, 'Incienso en grano inspirado en la Semana Santa malagueña.  De olor intenso y dulce, con aroma a jazmín de las biznagas, y a brisa del mar.  Humo abundante.', 3.90, 29, 3.60, 'https://inciensosdesevilla.es/166-large_default/malaga-bendita.jpg'),
	(14, 'Mi Madrugá', 1, 'Incienso inspirado en la Madrugada sevillana.  Lleva un ingrediente representando a cada hermandad de la noche más hermosa del año.', 3.90, 0, 4.90, 'https://inciensosdesevilla.es/225-large_default/mi-madruga.jpg'),
	(15, 'Noches de Bronce', 1, 'Este incienso está dedicado a la que fue la Voz de Bronce en la Hermandad de los Gitanos, Juanma Martín.  De olor intenso, con canela y clavo y ciertas notas florales dedicadas a la Virgen de las Angustias.', 3.90, 41, 4.30, 'https://inciensosdesevilla.es/433-large_default/noches-de-bronce.jpg'),
	(16, 'Palio', 1, 'Incienso mayoritariamente molido, con aromas florales y dulces.  Humo denso', 3.90, 47, 0.00, 'https://inciensosdesevilla.es/226-large_default/palio.jpg'),
	(17, 'Pasión por Cádiz', 1, 'Nuestro incienso dedicado a la Tacita de Plata tiene un aroma dulce, acanelado y con un humo intenso.  ', 3.90, 14, 0.40, 'https://inciensosdesevilla.es/227-large_default/pasion-por-cadiz.jpg'),
	(18, 'Púrpura', 1, 'Incienso de aroma seco dedicado al que fuera cardenal de Sevilla durante mucho tiempo: Monseñor Amigo.   Estéticamente podemos observar su color marrón en representación al espíritu franciscano y púrpura por su arzobispado.', 3.90, 44, 3.80, 'https://inciensosdesevilla.es/176-large_default/incienso-purpura.jpg'),
	(19, 'Rezaré', 1, 'Incienso inspirado en la canción del mítico músico sevillano Silvio.  De aroma dulce y floral.  Es un incienso con bastante humo y de olor intenso.', 3.90, 5, 4.20, 'https://inciensosdesevilla.es/437-large_default/rezare.jpg'),
	(20, 'ROMA', 1, 'Incienso dedicado a los Armaos.  De aroma muy cofrade,', 3.90, 12, 0.00, 'https://inciensosdesevilla.es/434-large_default/roma.jpg'),
	(21, 'Ruan', 1, 'Incienso inspirado en la hermandad de El Silencio de Sevilla y más concretamente en sus "Nazarenos de Sevilla"  El color negro mate con cierto brillo salteado caracteriza estéticamente este producto.  Su olor intenso, seco, de cofradía austera.  Muy del gusto de los cofrades "rancios". ', 3.90, 20, 1.50, 'https://inciensosdesevilla.es/228-large_default/ruan.jpg'),
	(22, 'Sagrada Familia', 1, 'Incienso de aroma suave y acanelado.  Ideal para quemar en Navidad y para los amantes de los inciensos que no sean intensos ni con mucho humo', 3.90, 0, 3.00, 'https://inciensosdesevilla.es/229-large_default/sagrada-familia.jpg'),
	(23, 'Semana Santa 2020', 1, 'Durante la pasada Semana Santa hicimos este incienso para compensar a todos aquéllos que no pudieron tener incienso en su fecha.  De ahí salió este incienso que se ha convertido ya en un mito de Inciensos de Sevilla y que ahora sacamos a la venta como homenaje y agradecimiento a todos nuestros seguidores fieles.', 3.90, 17, 2.20, 'https://inciensosdesevilla.es/231-large_default/semana-santa-2020.jpg'),
	(24, 'Sor Ángela', 1, 'NO DESC', 3.90, 29, 4.00, 'https://inciensosdesevilla.es/230-large_default/sor-angela.jpg'),
	(25, 'Spes Nostra', 1, 'Incienso de aroma floral intenso. Es muy estilo de Virgen.', 3.90, 1, 1.60, 'https://inciensosdesevilla.es/233-large_default/spes-nostra.jpg'),
	(26, 'Stabat Mater', 1, 'Incienso de intensidad elevada, de los preferidos para los "rancios" con aroma fuerte acanelado.  Uno de los favoritos de los amigos de Inciensos de Sevilla', 3.90, 19, 4.10, 'https://inciensosdesevilla.es/234-large_default/stabat-mater.jpg'),
	(27, 'Stella Maris', 1, 'Incienso tipo clásico, con notas amaderadas, marinas y de un aroma muy cofrade.  Dedicado a la Virgen del Carmen.', 3.90, 41, 3.80, 'https://inciensosdesevilla.es/235-large_default/stella-maris.jpg'),
	(28, 'Veracruz', 1, 'Es nuestro incienso con más aroma a canela.  Propio para hermandades de las llamadas serias. Ideal para los amantes de los olores a canela.', 3.90, 14, 1.30, 'https://inciensosdesevilla.es/236-large_default/veracruz.jpg'),
	(29, '¡A la Gloria!', 1, 'Incienso cofrade de aroma cítrico, color azul cielo y humo intenso.', 3.90, 30, 4.20, 'https://inciensosdesevilla.es/173-large_default/a-la-gloria.jpg'),
	(30, 'Aladino', 1, 'Incensario de barro pintado a mano en color metalizado, por su aspecto recuerda a la lampara de aladino', 12.50, 39, 4.70, 'https://inciensosdesevilla.es/831-large_default/aladino.jpg'),
	(31, 'Arabesco', 1, 'Incensario cofrade con muy buena aireación para el carbón.  Muy recomendado para dejar la pastilla y no preocuparse de que se apague.', 7.90, 16, 5.00, 'https://inciensosdesevilla.es/300-large_default/arabesco.jpg'),
	(32, 'Armao', 1, 'Incensario con la figura de un Armao.  Por la estrechez de su lecho para este incensario se recomiendan las pastillas de 33 mm, incluso medio carboncillo va mejor para que se oxigene bien para la combustión, y por ser de lecho bajo se recomienda poner protección', 12.50, 7, 0.10, 'https://inciensosdesevilla.es/415-large_default/armao.jpg'),
	(33, 'Artesano', 1, 'Incensario fabricado y decorado a mano. Al ser totalmente artesanal puede cambiar el dibujo y la forma final.', 12.50, 44, 4.50, 'https://inciensosdesevilla.es/348-large_default/artesano.jpg'),
	(34, 'Bombo', 1, 'Incensario cerámico hecho y pintado a mano con forma de bombo.  ', 10.90, 39, 2.60, 'https://inciensosdesevilla.es/368-large_default/bombo.jpg'),
	(35, 'Bombonera', 1, 'NO DESC', 7.90, 2, 4.90, 'https://inciensosdesevilla.es/290-large_default/bombonera.jpg'),
	(36, 'Botafumeiro', 1, 'Incensario metálico con forma de botafumeiro.', 85.00, 15, 2.70, 'https://inciensosdesevilla.es/380-large_default/botafumeiro.jpg'),
	(37, 'Chimenea', 1, 'Incensario rememorando las chimeneas de la Isla de la Cartuja.  Este es uno de los incensarios que más humo echan por la corriente que se forma entre el orificio laterial y la boca del incensario.', 7.90, 22, 3.00, 'https://inciensosdesevilla.es/534-large_default/chimenea.jpg'),
	(38, 'Chimenea Decorada', 1, 'Incensario inspirado en las antiguas chimeneas de hornos cerámicos.', 10.50, 14, 3.50, 'https://inciensosdesevilla.es/438-large_default/chimenea-decorada.jpg'),
	(39, 'Chimenea Paisajes', 1, 'Chimenea con paisajes típicos de ciudades andaluzas.', 17.90, 17, 1.30, 'https://inciensosdesevilla.es/340-large_default/chimenea-paisajes.jpg'),
	(40, 'Chimenea pintada a mano', 1, 'Incensario de gran tamaño pintado a mano con tu Titular favorito.  ', 45.90, 32, 2.80, 'https://inciensosdesevilla.es/388-large_default/incensario-pintado-a-mano.jpg'),
	(41, 'Chimenea XL con escudo', 1, 'Incensario con el dibujo de tu hermandad.  Escoge el color y el escudo con el que quieres que te lo decoremos y tendrás un bonito recuerdo de tu hermandad.', 29.90, 31, 0.20, 'https://inciensosdesevilla.es/387-large_default/chimenea-xl-con-escudo.jpg'),
	(42, 'Chimenea XL con nazareno/penitente', 1, 'El tradicional incensario de chimenea, en la versión XL, al que le pintamos el nazareno o penitente que nos pidas.  Adjunta una foto del nazareno ó describe cómo es y lo tendrás 100% personalizado.', 29.90, 43, 0.50, 'https://inciensosdesevilla.es/386-large_default/chimenea-xl-con-nazareno-penitente.jpg'),
	(43, 'Copita', 1, 'Pequeño incensario esmaltado. Sólo es válido para pastilla de 33mm o media pastilla de 40mm. ', 7.50, 32, 4.20, 'https://inciensosdesevilla.es/321-large_default/copita.jpg'),
	(44, 'Corneta', 1, 'Incensario con forma de corneta.  ', 10.90, 50, 1.50, 'https://inciensosdesevilla.es/370-large_default/corneta.jpg'),
	(45, 'Costalero', 1, 'Incensario con forma de costalero.  Este incensario, por el reducido diámetro de su base, sólo acepta pastillas de carbón pequeñas.  Incluso va mejor con media pastilla.', 10.50, 18, 2.80, 'https://inciensosdesevilla.es/373-large_default/costalero.jpg'),
	(46, 'Cruz de Mayo', 1, 'Incensario cerámico recordando las Cruces de Mayo.  Cada cruz es diferente en color y diseño.', 13.50, 15, 1.40, 'https://inciensosdesevilla.es/442-large_default/cruz-de-mayo.jpg'),
	(47, 'Don Bosco', 1, 'Incensario cerámico hecho y pintado a mano con la imagen de Don Bosco.  Este incensario, al ser de lecho bajo necesita protección para no quemar el mueble.', 12.50, 27, 2.00, 'https://inciensosdesevilla.es/418-large_default/don-bosco.jpg'),
	(48, 'Enfermería', 1, 'Simpático incensario que puede convertirse en el regalo ideal para esos enfermeros que tenemos cerca y son tan cofrades.  Un poco de incienso y su carbón correspondiente y listo.', 10.50, 40, 4.40, 'https://inciensosdesevilla.es/394-large_default/enfermeria.jpg'),
	(49, 'Escritorio', 1, 'Incensario cerámico compacto.  Contiene 3 cajitas, una para guardar el incienso, otra para el carbón y la tercera es la que actúa como incensario.  Es personalizable en color y texto.', 29.90, 30, 2.60, 'https://inciensosdesevilla.es/445-large_default/escritorio.jpg'),
	(50, 'Esencia', 1, 'Incensario con decoraciones cobrizas en relieve.  Pintado a mano.', 11.20, 32, 2.30, 'https://inciensosdesevilla.es/344-large_default/esencia.jpg'),
	(51, 'Fray Leopoldo', 1, 'Incensario con la imagen de Fray Leopoldo.', 11.50, 1, 2.30, 'https://inciensosdesevilla.es/375-large_default/fray-leopoldo.jpg'),
	(52, 'Giralda', 1, 'Incensario con la forma de la Giralda.  En este incensario sólo se pueden colocar las pastillas de carbón de 33mm de diámetro o inferior.  Por ser un incensario de lecho bajo, es necesario poner protección bajo el mismo para evitar quemar los muebles.', 11.20, 37, 1.80, 'https://inciensosdesevilla.es/611-large_default/giralda.jpg'),
	(53, 'Guardia Civil', 1, 'Incensario cerámico con forma de guardia civil.  Por ser de lecho bajo es recomendable poner un protector en la base que evite quemar el mueble.', 10.90, 0, 1.80, 'https://inciensosdesevilla.es/444-large_default/guardia-civil.jpg'),
	(54, 'Huevo de Pascua decorado', 1, 'Incensario cerámico con forma de huevo de pascua pintado y decorado a mano con pintura cobriza en relieve. ', 10.90, 37, 2.80, 'https://inciensosdesevilla.es/345-large_default/huevo-de-pascua-decorado.jpg'),
	(55, 'Incensario con asa', 1, 'Incensario metálico de sobremesa', 27.90, 23, 2.80, 'https://inciensosdesevilla.es/383-large_default/incensario-con-asa.jpg'),
	(56, 'Incensario de cadenas', 1, 'Incensarios de metal con cadenas. Disponibles en color dorado y níquel.  ', 43.00, 19, 3.70, 'https://inciensosdesevilla.es/377-large_default/incensario-de-metal.jpg'),
	(57, 'Incensario Santiago', 1, 'Incensario de latón con cadenas.  Muy buena opción para tener metálico en casa.', 59.00, 23, 3.20, 'https://inciensosdesevilla.es/820-large_default/incensario-santiago.jpg'),
	(58, 'Legionario', 1, 'Incensario con la figura de un legionario.  Este incensario, por su escaso diámetro en el lecho se recomienda usar con pastillas de 33mm e incluso media pastilla para la buena oxigenación del carbón.', 10.50, 2, 1.00, 'https://inciensosdesevilla.es/414-large_default/legionario.jpg'),
	(59, 'Magisterio', 1, 'Incensario con forma de maestros.  Ideal para regalar a ese maestro que tienes tan cerca y que es tan cofrade.  Con un poco de incienso y su carbón, el regalo perfecto.', 10.90, 21, 0.10, 'https://inciensosdesevilla.es/391-large_default/magisterio.jpg'),
	(60, 'Mamá Margarita', 1, 'Incensario cerámico con la forma de la popular madre de Don Bosco.  Hecho y pintado a mano.  Este incensario, al ser de lecho bajo, necesita algún tipo de protección bajo su base para no quemar los muebles.', 10.90, 8, 0.80, 'https://inciensosdesevilla.es/419-large_default/mama-margarita.jpg'),
	(61, 'María Auxiliadora', 1, 'Incensario representando a María Auxiliadora.  Hecho y pintado a mano.', 12.90, 20, 3.50, 'https://inciensosdesevilla.es/417-large_default/maria-auxiliadora.jpg'),
	(62, 'Medicina', 1, 'Simpático incensario con forma de médico.  Un buen regalo para ese médico cofrade que tienes cerca.', 10.50, 11, 1.40, 'https://inciensosdesevilla.es/392-large_default/medicina.jpg'),
	(63, 'Monumento Virgen del Rocío', 1, 'NO DESC', 10.50, 48, 2.90, 'https://inciensosdesevilla.es/399-large_default/monumento-virgen-del-rocio.jpg'),
	(64, 'Músico Tres Caídas', 1, 'Incensario con la forma del músico de la Banda Tres Caídas de Triana.', 11.20, 50, 3.80, 'https://inciensosdesevilla.es/431-large_default/musico-tres-caidas.jpg'),
	(65, 'Músico Virgen de los Reyes', 1, 'Incensario con la forma de músico Virgen de los Reyes. ', 11.20, 34, 2.00, 'https://inciensosdesevilla.es/430-large_default/musico-virgen-de-los-reyes.jpg'),
	(66, 'Nazareno/Penitente', 1, 'Incensario nazareno/penitente. Incensario clásico en el que debemos tener precaución por tener el lecho bajo. Puede quemar el mueble si no se pone una protección debajo.', 7.90, 40, 3.80, 'https://inciensosdesevilla.es/315-large_default/nazarenopenitente.jpg'),
	(67, 'Nazareno/penitente especial - personalizado', 1, 'Incensario cerámico con forma de nazareno o penitente.  Se puede personalizar según si es de capa, cola, esparto o escapulario.', 29.50, 13, 2.70, 'https://inciensosdesevilla.es/622-large_default/nazarenopenitente-especial-personalizado.jpg'),
	(68, 'Pasión', 1, 'Incensario decorado con dibujos cobrizos en relieve.', 11.50, 27, 1.90, 'https://inciensosdesevilla.es/342-large_default/pasion.jpg'),
	(69, 'Policía Nacional', 1, 'Incensario cerámico con forma de policía nacional. Hecho y pintado a mano.  Este incensariol por su reducido diámetro de base, es recomendable utilizarlo con pastillas de carbón de 33 e incluso con media pastilla.', 10.50, 5, 3.10, 'https://inciensosdesevilla.es/420-large_default/policia-nacional.jpg'),
	(70, 'PORTA INCENSARIOS', 1, 'Porta incensarios fabricado en metal dorado.  Muy resistente.  Dispone de dispositivo para colocar la naveta y para colgar el incensario.', 295.00, 18, 0.00, 'https://inciensosdesevilla.es/20-large_default/porta-incensarios.jpg'),
	(71, 'Protección Civil', 1, 'Incensario cerámico hecho y pintado a mano con la forma de agente de protección civil', 10.50, 10, 2.40, 'https://inciensosdesevilla.es/209-large_default/proteccion-civil.jpg'),
	(72, 'Quinqué', 1, 'Incensario cerámico con forma de quinqué.  Por ser de lecho bajo es recomendable poner algún tipo de protección en su base para no queamar los muebles.', 7.50, 44, 0.40, 'https://inciensosdesevilla.es/451-large_default/quinque.jpg'),
	(73, 'Resolana', 1, 'Incensario de torno pintado a mano.', 12.50, 22, 4.50, 'https://inciensosdesevilla.es/821-large_default/resolana.jpg'),
	(74, 'Reyes Magos', 1, 'NO DESC', 24.90, 24, 1.90, 'https://inciensosdesevilla.es/252-large_default/reyes-magos.jpg'),
	(75, 'Romano', 1, 'Incensario cerámico hecho y pintado a mano con forma de romano.', 9.50, 25, 0.30, 'https://inciensosdesevilla.es/443-large_default/romano.jpg'),
	(76, 'San Antonio', 1, 'Incensario con la imagen de San Antonio.', 11.50, 33, 1.90, 'https://inciensosdesevilla.es/374-large_default/san-antonio.jpg'),
	(77, 'Seise', 1, 'Incensario en barro pintado a mano con forma de los famosos seises de la Catedral de Sevilla.  ', 27.50, 27, 0.60, 'https://inciensosdesevilla.es/256-large_default/seise.jpg'),
	(78, 'Sevilla', 1, 'NO DESC', 13.90, 42, 4.80, 'https://inciensosdesevilla.es/406-large_default/sevilla.jpg'),
	(79, 'Sevilla -serie especial-', 1, 'Incensario cofrade personalizable.  Con estilo que recuerda a la Plaza de España, puedes escoger el color y el texto con los que se decora. Este incensario se tarda en fabricar de 10 a 15 días. ', 17.90, 8, 2.10, 'https://inciensosdesevilla.es/404-large_default/sevilla-serie-especial-.jpg'),
	(80, 'Sevilla personalizado', 1, 'Incensario cofrade.   Este incensario es personalizable.  Debes escoger el color de las líneas y texto que ponemos.', 15.70, 9, 4.00, 'https://inciensosdesevilla.es/410-large_default/sevilla-personalizado.jpg'),
	(81, 'Sevilla y Triana', 1, 'Conjunto compuesto por incensario, caja de carbón (grande o pequeña) y caja de incienso.', 28.50, 35, 1.80, 'https://inciensosdesevilla.es/412-large_default/sevilla-y-triana.jpg'),
	(82, 'Sol', 1, 'Incensario cerámico hecho y pintado a mano con la forma de músico de la Banda del Sol.', 11.50, 43, 0.70, 'https://inciensosdesevilla.es/416-large_default/sol.jpg'),
	(83, 'Sor Ángela', 1, 'Incensario cerámico hecho y fabricado a mano con la imagen de la santa sevillana.  Al igual que con el incienso que lleva su nombre, hemos querido poner Sor Ángela y no Santa Ángela por ser el nombre con el que la sigue conociendo el pueblo sevillano.', 11.50, 44, 4.90, 'https://inciensosdesevilla.es/376-large_default/sor-angela.jpg'),
	(84, 'Tambor', 1, 'Incensario con forma de tambor.', 9.90, 14, 3.10, 'https://inciensosdesevilla.es/366-large_default/tambor.jpg'),
	(85, 'Tambor con caja china', 1, 'Este incensario, al ser de lecho bajo es recomendable ponerle alguna protección debajo para no quemar los muebles.', 10.90, 6, 0.00, 'https://inciensosdesevilla.es/367-large_default/tambor-con-caja-china.jpg'),
	(86, 'Tamboril', 1, 'Curioso incensario con forma de tambor rociero.  Este incensario, al ser de lecho bajo se recomienda colocarle debajo de la base algún protector para proteger los muebles de quemaduras.', 9.90, 15, 4.40, 'https://inciensosdesevilla.es/397-large_default/tamboril.jpg'),
	(87, 'Tamborilero', 1, 'Incensario de barro representando a un tamborilero.  Al ser este incensario de lecho bajo se recomienda poner algún protector en su base para no quemar el mueble', 13.90, 10, 1.60, 'https://inciensosdesevilla.es/441-large_default/tamborilero.jpg'),
	(88, 'Torre del Oro', 1, 'Incensario con las formas de la mítica torre sevillana.  Este incensario, al ser de lecho bajo, necesita protección debajo del mismo para no dañar los muebles.', 10.50, 38, 3.30, 'https://inciensosdesevilla.es/278-large_default/torre-del-oro.jpg'),
	(89, 'U.M.E.', 1, 'Incensario cerámico con forma de militar de la UME.  Hecho y pintado a mano. Al ser de lecho bajo es recomendable el uso de protector en su base para evitar quemaduras en el mueble', 10.50, 35, 0.50, 'https://inciensosdesevilla.es/446-large_default/ume.jpg'),
	(90, 'Virgen de los Reyes', 1, 'Incensario representando a la patrona de Sevilla. ', 18.90, 21, 4.80, 'https://inciensosdesevilla.es/328-large_default/virgen-de-los-reyes.jpg'),
	(91, 'Virgen del Rocío', 1, 'Te presentamos este incensario en barro inspirado en la Virgen del Rocío.  Al ser un incensario de lecho bajo debe ponerse un protector en su base para no quemar los muebles.', 14.50, 19, 2.10, 'https://inciensosdesevilla.es/440-large_default/virgen-del-rocio.jpg'),
	(92, 'Cartel "Calle Águilas 2022"', 4, 'Cartel en A3 conmemorativo del aniversario de nuestra tienda en calle Águilas.  Imagen titular:  El Cachorro.', 0.01, 42, 3.40, 'https://inciensosdesevilla.es/560-large_default/cartel-calle-aguilas-2022.jpg'),
	(93, 'Cartel Arco del Postigo 2024', 4, 'NO DESC', 0.01, 30, 2.90, 'https://inciensosdesevilla.es/793-large_default/cartel-arco-del-postigo-2024.jpg'),
	(94, 'Cartel Calle Águilas 2021', 4, 'Cartel en A3 conmemorativo de la inauguración de nuestra tienda de la calle Águilas, 14.  Imagen titular Gran Poder.  Foto tomada por Sebas Gallardo en la Basílica el día del besamanos.', 0.01, 1, 2.70, 'https://inciensosdesevilla.es/562-large_default/cartel-calle-aguilas.jpg'),
	(95, 'L1 Domingo-Lunes', 4, 'Fotografías de alta calidad impresas en lienzo y montado en bastidor de madera.  Todo con una calidad excepcional.', 38.00, 0, 4.70, 'https://inciensosdesevilla.es/1074-large_default/l1-domingo-lunes.jpg'),
	(96, 'L2 Martes-Miércoles', 4, 'Fotografías de alta calidad impresas en lienzo y montado en bastidor de madera.  Todo con una calidad excepcional.', 38.00, 9, 1.50, 'https://inciensosdesevilla.es/1077-large_default/l2-martes-miercoles.jpg'),
	(97, 'L3 Jueves-Madrugada', 4, 'Fotografías de alta calidad impresas en lienzo y montado en bastidor de madera.  Todo con una calidad excepcional.', 38.00, 0, 1.20, 'https://inciensosdesevilla.es/1131-large_default/l3-jueves-madrugada.jpg'),
	(98, 'L4 Viernes Sábado y Domingo', 4, 'Fotografías de alta calidad impresas en lienzo y montado en bastidor de madera.  Todo con una calidad excepcional.', 38.00, 26, 3.50, 'https://inciensosdesevilla.es/1173-large_default/l4-viernes-sabado-y-domingo.jpg'),
	(99, 'L5 Glorias', 4, 'Fotografías de alta calidad impresas en lienzo y montado en bastidor de madera.  Todo con una calidad excepcional.', 38.00, 11, 1.40, 'https://inciensosdesevilla.es/1189-large_default/l5-glorias.jpg'),
	(100, 'Láminas Rígidas de Cádiz', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 19.90, 7, 0.70, 'https://inciensosdesevilla.es/1377-large_default/laminas-rigidas-de-cadiz.jpg'),
	(101, 'Láminas Rígidas de Córdoba', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 19.90, 30, 4.50, 'https://inciensosdesevilla.es/1441-large_default/laminas-rigidas-de-cordoba.jpg'),
	(102, 'Láminas rígidas de Málaga', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 19.90, 7, 3.80, 'https://inciensosdesevilla.es/1313-large_default/laminas-rigidas-de-malaga.jpg'),
	(103, 'Las fotos de la Magna', 4, 'Fotos de los Titulares de penitencia que participaron. En la Magna. Gran Poder, Cachorro, Esperanza de Triana y Macarena', 3.00, 3, 4.90, 'https://inciensosdesevilla.es/1550-large_default/las-fotos-de-la-magna.jpg'),
	(104, 'Las fotos de las Esperanzas', 4, 'Foto de todas las Esperanzas de penitencia de Sevilla', 3.00, 10, 3.70, 'https://inciensosdesevilla.es/1549-large_default/las-fotos-de-las-esperanzas.jpg'),
	(105, 'Lienzos de Cádiz', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 38.00, 14, 0.00, 'https://inciensosdesevilla.es/1385-large_default/lienzos-de-cadiz.jpg'),
	(106, 'Lienzos de Córdoba', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 38.00, 21, 1.70, 'https://inciensosdesevilla.es/1453-large_default/lienzos-de-cordoba.jpg'),
	(107, 'Lienzos de Málaga', 4, 'Fotografías de alta calidad impresas en lienzo y montado en bastidor de madera.  Todo con una calidad excepcional.', 38.00, 33, 3.20, 'https://inciensosdesevilla.es/1298-large_default/lienzos-de-malaga.jpg'),
	(108, 'LR1 Domingo-Lunes', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 19.90, 20, 1.80, 'https://inciensosdesevilla.es/1078-large_default/lr1-domingo-lunes.jpg'),
	(109, 'LR2 Martes-Miércoles', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 19.90, 31, 4.00, 'https://inciensosdesevilla.es/1076-large_default/lr2-martes-miercoles.jpg'),
	(110, 'LR3 Jueves-Madrugada', 4, 'Fotografías de alta calidad impresas en lienzo y montado en bastidor de madera.  Todo con una calidad excepcional.', 19.90, 37, 4.10, 'https://inciensosdesevilla.es/1105-large_default/lr3-jueves-madrugada.jpg'),
	(111, 'LR4 Viernes-Sábado-Resurrección', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 19.90, 11, 4.50, 'https://inciensosdesevilla.es/1157-large_default/lr4-viernes-sabado-resurreccion.jpg'),
	(112, 'LR5 Glorias', 4, 'Escoge el tamaño elegido y de nuestro catálogo la foto que más te guste (están ordenadas por día) y posteriormente pon la letra y número que corresponge en la personalización.  Nos encargamos del resto', 19.90, 4, 2.30, 'https://inciensosdesevilla.es/1194-large_default/lr5-glorias.jpg'),
	(113, 'Corona Ancla', 3, 'Corona realizada en impresión 3D.  Disponible en plateada y dorada.  Producto bajo pedido.  Tiempo de fabricación entorno a 72 horas.', 16.40, 17, 5.00, 'https://inciensosdesevilla.es/586-large_default/corona-ancla.jpg'),
	(114, 'Corona Destellos', 3, 'Corona realizada en impresión 3D.  Disponible en plateada y dorada.  Producto bajo pedido.  Tiempo de fabricación entorno a 72 horas.', 16.40, 11, 2.50, 'https://inciensosdesevilla.es/1486-large_default/corona-destellos.jpg'),
	(115, 'Corona metal hecha a mano', 3, 'Corona de metal hecha a mano.  100% artesana.  Tiempo de fabricación hasta 1 mes.', 95.00, 46, 4.50, 'https://inciensosdesevilla.es/1505-large_default/corona-metal-hecha-a-mano.jpg'),
	(116, 'Diadema', 3, 'Diadema fabricada en 3D.  Se realizan bajo pedido, en máximo 72 horas las tenemos hechas.', 13.90, 15, 2.20, 'https://inciensosdesevilla.es/588-large_default/diadema.jpg'),
	(117, 'Dolorosa para vestir', 3, 'Dolorosa para vestir de 60 cm de altura.  Brazos articulados de gran calidad. Producto por encargo.  Si tienes prisa, ponte en contacto con nosotros para indicarte fechas de entrega previstas.', 560.00, 8, 1.10, 'https://inciensosdesevilla.es/469-large_default/dolorosa-para-vestir.jpg'),
	(118, 'Virgen con niño', 3, 'Virgen de candelero de 60 cm de alto. Se trata de una Virgen de gloria con niño en sus brazos.  Totalmente articulada y lista para vestir.', 590.00, 38, 1.10, 'https://inciensosdesevilla.es/1483-large_default/virgen-con-nino.jpg'),
	(119, 'Virgen de Gloria', 3, 'Virgen gloriosa de 60 cm de alto.  ', 560.00, 48, 2.20, 'https://inciensosdesevilla.es/1480-large_default/virgen-de-gloria.jpg'),
	(120, 'Cruces de guía personalizada', 2, 'Magnífico cuadro para regalar con la cruz de guía de tu hermandad.  Danos la foto de la cruz de guía, el escudo, color y nombre de la hermandad y te hacemos un cuadro que será el mejor obsequio para ese cofrade.', 190.00, 47, 4.80, 'https://inciensosdesevilla.es/727-large_default/cruces-de-guia-personalizada.jpg'),
	(121, 'Maquetas cofrades', 2, 'Te presentamos uno de nuestros últimos y exitosos productos dentro de Cuaresma de Sevilla, las maquetas cofrades.  Poco a poco iremos subiendo distintas maquetas ya realizadas.  Si quieres tener una maqueta personalizada de tu iglesia o capilla, ponte en contacto con nosotros para darte presupuesto.', 30.00, 46, 1.60, 'https://inciensosdesevilla.es/457-large_default/maquetas-cofrades.jpg'),
	(122, 'Relieve de Triana', 2, 'Elemento decorativo en base al puente de Triana y las cofradías del barrio. Escoge qué paso quieres que aparezca y te lo hacemos.', 32.90, 28, 4.40, 'https://inciensosdesevilla.es/610-large_default/relieve-de-triana.jpg'),
	(123, 'Teja cofrade personalizada', 2, 'Tejas cofrades decoradas.  Danos la fachada de tu iglesia, las imágenes de tus titulares y hacemos una preciosa teja artística de tu hermandad.  Puede ser cualquier iglesia de cualquier lugar de España', 55.00, 28, 3.70, 'https://inciensosdesevilla.es/453-large_default/teja-cofrade-personalizada.jpg'),
	(124, 'Tejas cofrades', 2, 'Tejas cofrades inspiradas en hermandades.  Poco a poco iremos subiendo más. Producto bajo pedido.  Plazo de entrega aproximada aproximado 2 semanas.', 59.00, 11, 1.30, 'https://inciensosdesevilla.es/454-large_default/tejas-cofrades.jpg');

	
		INSERT INTO INCIENSOSDESEVILLA.RESENIA (id_cliente, texto, id_producto) VALUES
	(1, 'Un incienso de gran calidad, con un aroma que dura bastante tiempo. Totalmente recomendado.', 101),
	(2, 'El olor es muy agradable y recuerda a la Semana Santa. Sin duda, volveré a comprarlo.', 102),
	(1, 'Este incienso tiene una fragancia intensa pero no invasiva. Ideal para momentos de meditación.', 103),
	(2, 'Me encantó su aroma, pero la duración podría ser un poco mayor. Aun así, muy bueno.', 104),
	(1, 'La mejor elección para los amantes del incienso tradicional. Un producto excelente.', 105),
	(2, 'Huele muy bien, aunque esperaba que fuera un poco más fuerte. Aún así, es una buena compra.', 106),
	(1, 'Un incienso con notas dulces y especiadas que lo hacen único. Volveré a comprarlo.', 107),
	(2, 'Excelente calidad y una fragancia que envuelve todo el ambiente de forma sutil.', 108);

		SELECT * FROM inciensosdesevilla.producto p ;
		
		SELECT * FROM inciensosdesevilla.cliente c ;

	
	    SELECT *
        FROM inciensosdesevilla.Producto p
        WHERE p.id_categoria = 1
        ORDER BY p.precio;
	
	
	
	
	
	

