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


# SELECT * FROM usuarios LEFT JOIN roles_usuarios ON usuarios.id = roles_usuarios.usuario_id LEFT JOIN roles ON roles_usuarios.rol_id = roles.id;

# SELECT * FROM roles LEFT JOIN roles_usuarios ON roles.id = roles_usuarios.id LEFT JOIN usuarios ON usuarios.id = roles_usuarios.usuario_id;

# SELECT * FROM usuarios WHERE id NOT IN (SELECT usuario_id FROM roles_usuarios);

# SELECT * FROM roles WHERE id NOT IN (SELECT rol_id FROM roles_usuarios);

# FULL OUTER JOIN
# SELECT id, nombre FROM usuarios WHERE id NOT IN (SELECT usuario_id FROM roles_usuarios)
# UNION ALL
# SELECT id, nombre FROM roles WHERE id NOT IN (SELECT rol_id FROM roles_usuarios)

# SELECT * FROM usuarios LEFT JOIN roles_usuarios ON usuarios.id = roles_usuarios.usuario_id LEFT JOIN roles ON roles_usuarios.rol_id = roles.id WHERE roles.id IS NULL

# SELECT * FROM roles LEFT JOIN roles_usuarios ON roles.id = roles_usuarios.id LEFT JOIN usuarios ON usuarios.id = roles_usuarios.usuario_id WHERE usuarios.id IS NULL

# Crear back de una tabla (Copia todos los datos de una tablas a otra con la misma estructura.)
# INSERT INTO usuarios_backup (id, nombre, email, cedula, estado, password, fecha_creacion) SELECT usuarios.id, usuarios.nombre, usuarios.email, usuarios.cedula, usuarios.estado, usuarios.password, usuarios.fecha_creacion FROM usuarios
# INSERT INTO usuarios_backup (id, nombre, email, cedula, estado, password, fecha_creacion) SELECT * FROM usuarios


CREATE TABLE secretarias (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL
);

CREATE TABLE tipo_contratos (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL
);

CREATE TABLE contratos ( 
    id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    numero_contrato VARCHAR(255) NOT NULL ,
    objeto_contrato VARCHAR(255) NOT NULL , 
    presupuesto BIGINT NOT NULL , 
    fecha_estimada_finalizacion DATETIME NOT NULL , 
    fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    secretaria_id BIGINT NOT NULL , 
    FOREIGN KEY (secretaria_id) REFERENCES secretarias(id)
) ENGINE = InnoDB;

CREATE TABLE contratos_tipos_contratos (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
contrato_id BIGINT NOT NULL,
tipo_contrato_id BIGINT NOT NULL,
FOREIGN KEY (contrato_id) REFERENCES contratos(id),
FOREIGN KEY (tipo_contrato_id) REFERENCES tipo_contratos(id)
);

CREATE TABLE archivos (
    id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    nombre_archivo VARCHAR(255) NOT NULL , 
    descripcion VARCHAR(255) NULL , 
    tamano INT NOT NULL , `mime_type` VARCHAR(100) NOT NULL , 
    fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    contrato_id BIGINT NOT NULL , `url` VARCHAR(255) NOT NULL , 
    FOREIGN KEY (contrato_id) REFERENCES contratos(id)
) ENGINE = InnoDB;