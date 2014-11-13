CREATE TABLE usuario (
	alias VARCHAR(20) NOT NULL,
	contrasenia VARCHAR(20) NOT NULL,
	nombre_completo VARCHAR(30) NOT NULL,
	correoUnivalle VARCHAR(80) NOT NULL,
	correoFacebook VARCHAR(80) NULL,
	usuarioTwitter VARCHAR(40) NULL,
	rol VARCHAR(20) NOT NULL,
	tipoDoc VARCHAR(3) NULL,
	numDoc VARCHAR(20) NULL,
	numCel VARCHAR(20) NULL,
	PRIMARY KEY(alias, correoUnivalle)
);

CREATE TABLE convocatoria (
	id_convocatoria SERIAL PRIMARY KEY,
	nombre VARCHAR(60),
	descripcion VARCHAR(800),
	fecha_inicio DATE,
	fecha_fin DATE,
	publicada BOOLEAN
);

CREATE TABLE convocatoriaxpropuesta (
	id_convocatoria
	id_propuesta
);

CREATE TABLE propuesta (
	id_propuesta SERIAL PRIMARY KEY
);