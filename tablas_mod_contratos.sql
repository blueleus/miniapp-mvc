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
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP ,
    secretaria_id BIGINT,
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
    tamano INT NOT NULL , 
    mime_type VARCHAR(100) NOT NULL ,
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP ,
    contrato_id BIGINT NOT NULL , 
    url VARCHAR(255) NOT NULL ,
    FOREIGN KEY (contrato_id) REFERENCES contratos(id)
) ENGINE = InnoDB;

INSERT INTO `tipo_contratos` (`id`, `nombre`) VALUES (NULL, 'JURIDICO'), (NULL, 'LABORAL'), (NULL, 'INTERVENTORIA'), (NULL, 'ASESORIA');
INSERT INTO `secretarias` (`id`, `nombre`) VALUES (NULL, 'EDUCACION'), (NULL, 'SALUD');