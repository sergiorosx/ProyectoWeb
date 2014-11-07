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
	Nombre Varchar(60) UNIQUE,
	Descripcion Varchar(800),
	Fecha_Inicio Date,
	Fecha_FIn Date,
	Publicada Boolean
);
