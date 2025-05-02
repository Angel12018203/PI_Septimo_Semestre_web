--Elimina la BD si ya existe
DROP DATABASE IF EXISTS ReEduca;

--Crea la BD
CREATE DATABASE ReEduca;

--Usar la DB
USE ReEduca;

CREATE TABLE usuarios(
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
	tipo_documento VARCHAR(10) NOT NULL,
	numero_documento VARCHAR(15) NOT NULL UNIQUE,
	nombre_usuario VARCHAR(40) NOT NULL,
	apellido_usuario VARCHAR(40) NOT NULL,
	correo_usuario VARCHAR(80) NOT NULL UNIQUE,
	password_usuario VARCHAR(50) NOT NULL,
	celular	VARCHAR(10),
	departamento VARCHAR(50) NOT NULL,
	ciudad VARCHAR(50) NOT NULL,
	fecha_nac DATE NOT NULL);

CREATE TABLE solicitudes(
	id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	fecha_envio DATE NOT NULL,
	estado_solicitud VARCHAR(15) NOT NULL,
	descripcion TEXT,
	observaciones TEXT,
	fecha_respuesta DATE DEFAULT NULL,
	FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario));

CREATE TABLE modulos(
	id_modulo INT AUTO_INCREMENT PRIMARY KEY,
	nombre_modulo VARCHAR(100) NOT NULL,
	descripcion_modulo VARCHAR(250) NOT NULL
	);
	
CREATE TABLE inscripciones(
	id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT NOT NULL,
	id_modulo INT NOT NULL,
	fecha_inscripcion DATE NOT NULL,
	FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),	
	FOREIGN KEY (id_modulo) REFERENCES modulos(id_modulo),
	UNIQUE(id_usuario,id_modulo)
	);