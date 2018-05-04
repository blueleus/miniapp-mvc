CREATE TABLE `nexura`.`roles` (
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