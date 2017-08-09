# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.2.1                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          adminCaptur.dez                                 #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2017-08-06 22:02                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Tables                                                                 #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "usuarios"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `usuarios` (
    `id` INTEGER(5) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(40) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(40) NOT NULL,
    CONSTRAINT `PK_usuarios` PRIMARY KEY (`id`)
);

# ---------------------------------------------------------------------- #
# Add table "passwordreset"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `passwordreset` (
    `email` VARCHAR(40) NOT NULL,
    `token` VARCHAR(40) NOT NULL
);

# ---------------------------------------------------------------------- #
# Add table "cantones"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `cantones` (
    `cantonid` INTEGER(2) NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(40) NOT NULL,
    `descripcion` TEXT,
    CONSTRAINT `PK_cantones` PRIMARY KEY (`cantonid`)
);

# ---------------------------------------------------------------------- #
# Add table "imagenes_cantones"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `imagenes_cantones` (
    `url` VARCHAR(300) NOT NULL,
    `texto` VARCHAR(100),
    `cantonid` INTEGER(2),
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`)
);

# ---------------------------------------------------------------------- #
# Add table "establecimientos"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `establecimientos` (
    `establecimiento_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `nombre_establecimiento` VARCHAR(100) NOT NULL,
    `direccion` VARCHAR(150),
    `latitud` VARCHAR(40),
    `longitud` VARCHAR(40),
    `pagina_web` VARCHAR(300),
    `facebook` VARCHAR(300),
    `twitter` VARCHAR(300),
    `youtube` VARCHAR(300),
    `google` VARCHAR(300),
    `descripcion` TEXT,
    `imagen_portada` VARCHAR(300),
    `tipo` ENUM('gastronomia','turismo','alojamiento') DEFAULT 'turismo',
    `cantonid` INTEGER(2),
    CONSTRAINT `PK_establecimientos` PRIMARY KEY (`establecimiento_id`)
);

# ---------------------------------------------------------------------- #
# Add table "radares"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `radares` (
    `radar_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `latitud` VARCHAR(40) NOT NULL,
    `longitud` VARCHAR(40) NOT NULL,
    `addr` VARCHAR(200) NOT NULL,
    CONSTRAINT `PK_radares` PRIMARY KEY (`radar_id`)
);

# ---------------------------------------------------------------------- #
# Add table "eventos"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `eventos` (
    `evento_id` INTEGER NOT NULL AUTO_INCREMENT,
    `fecha_evento` VARCHAR(100) NOT NULL,
    `hora_evento` VARCHAR(50),
    `titulo_evento` VARCHAR(150) NOT NULL,
    `descripcion_corta` VARCHAR(200) NOT NULL,
    `descripcion` TEXT,
    `direccion` VARCHAR(150),
    `imagen` VARCHAR(300) NOT NULL,
    `cantonid` INTEGER(2),
    `fecha_publicacion` DATETIME NOT NULL,
    CONSTRAINT `PK_eventos` PRIMARY KEY (`evento_id`)
);

# ---------------------------------------------------------------------- #
# Foreign key constraints                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `imagenes_cantones` ADD CONSTRAINT `cantones_imagenes_cantones` 
    FOREIGN KEY (`cantonid`) REFERENCES `cantones` (`cantonid`);

ALTER TABLE `establecimientos` ADD CONSTRAINT `cantones_establecimientos` 
    FOREIGN KEY (`cantonid`) REFERENCES `cantones` (`cantonid`);

ALTER TABLE `eventos` ADD CONSTRAINT `cantones_eventos` 
    FOREIGN KEY (`cantonid`) REFERENCES `cantones` (`cantonid`);
