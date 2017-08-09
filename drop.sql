# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.2.1                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          adminCaptur.dez                                 #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2017-08-06 22:02                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `imagenes_cantones` DROP FOREIGN KEY `cantones_imagenes_cantones`;

ALTER TABLE `establecimientos` DROP FOREIGN KEY `cantones_establecimientos`;

ALTER TABLE `eventos` DROP FOREIGN KEY `cantones_eventos`;

# ---------------------------------------------------------------------- #
# Drop table "eventos"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `eventos` MODIFY `evento_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `eventos` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `eventos`;

# ---------------------------------------------------------------------- #
# Drop table "radares"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `radares` MODIFY `radar_id` INTEGER(10) NOT NULL;

# Drop constraints #

ALTER TABLE `radares` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `radares`;

# ---------------------------------------------------------------------- #
# Drop table "establecimientos"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `establecimientos` MODIFY `establecimiento_id` INTEGER(10) NOT NULL;

# Drop constraints #

ALTER TABLE `establecimientos` ALTER COLUMN `tipo` DROP DEFAULT;

ALTER TABLE `establecimientos` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `establecimientos`;

# ---------------------------------------------------------------------- #
# Drop table "imagenes_cantones"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `imagenes_cantones` MODIFY `id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `imagenes_cantones` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `imagenes_cantones`;

# ---------------------------------------------------------------------- #
# Drop table "cantones"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `cantones` MODIFY `cantonid` INTEGER(2) NOT NULL;

# Drop constraints #

ALTER TABLE `cantones` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `cantones`;

# ---------------------------------------------------------------------- #
# Drop table "passwordreset"                                             #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `passwordreset`;

# ---------------------------------------------------------------------- #
# Drop table "usuarios"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `usuarios` MODIFY `id` INTEGER(5) NOT NULL;

# Drop constraints #

ALTER TABLE `usuarios` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `usuarios`;
