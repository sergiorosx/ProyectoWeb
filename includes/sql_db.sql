CREATE TABLE usuario (
	alias VARCHAR(20) NOT NULL,
	contrasenia VARCHAR(20) NOT NULL,
	nombre_completo VARCHAR(30) NOT NULL,
	correoUnivalle VARCHAR(40) NOT NULL,
	correoFacebook VARCHAR(40) NULL,
	correoTwitter VARCHAR(40) NULL,
	rol VARCHAR(20) NOT NULL,
	tipoDoc VARCHAR(3) NULL,	
	numDoc VARCHAR(20) NULL,
	numCel VARCHAR(20) NULL,
	PRIMARY KEY(alias, correoUnivalle)
);
