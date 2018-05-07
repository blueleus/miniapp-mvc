CREATE DATABASE nexura CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE roles (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL
);

CREATE TABLE usuarios (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
cedula VARCHAR(255),
estado INT(1) DEFAULT '1',
password VARCHAR(255) NOT NULL,
fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE roles_usuarios (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
rol_id BIGINT NOT NULL,
usuario_id BIGINT NOT NULL,
FOREIGN KEY (rol_id) REFERENCES roles(id),
FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE INDEX index_nombre ON usuarios (nombre);
CREATE INDEX index_email ON usuarios (email);
CREATE INDEX index_cedula ON usuarios (cedula);

INSERT INTO roles (nombre) VALUES ('ADMIN');
INSERT INTO roles (nombre) VALUES ('INVITADO');CREATE TABLE `nexura`.`roles` (
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `nombre` VARCHAR(30) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE `nexura`.`usuarios` (
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `nombre` VARCHAR(255) NOT NULL ,
    `email` VARCHAR(255) NOT NULL ,
    `cedula` VARCHAR(255) NOT NULL ,
    `estado` INT(1) NULL DEFAULT '1' ,
    `fecha_creacion` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ,
    `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`),
    INDEX `index_nombre` (`nombre`), UNIQUE `index_email` (`email`)) ENGINE = InnoDB;

CREATE TABLE `nexura`.`roles_usuarios` (
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `rol_id` BIGINT NOT NULL ,
    `usuario_id` BIGINT NOT NULL ,
    PRIMARY KEY (`id`),
    FOREIGN KEY (rol_id) REFERENCES roles(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE = InnoDB;