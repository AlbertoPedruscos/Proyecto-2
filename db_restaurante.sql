DROP DATABASE db_restaurante;

CREATE DATABASE db_restaurante;

USE db_restaurante;

/* Tabla de roles */
CREATE TABLE tbl_roles(
    id_roles INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre_rol VARCHAR(20) NOT NULL
);

/* Tabla de usuarios */
CREATE TABLE tbl_users(
    id_user INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user VARCHAR(20) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    contra VARCHAR(120) NOT NULL,
    salario INT(6) NOT NULL,
    telefono INT(9) NOT NULL,
    rol INT
);

/* Tabla de tipos de sala que tenemos */
CREATE TABLE tbl_tipos_salas(
    id_tipos INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_tipos VARCHAR(20) NOT NULL,
    aforo INT (2)
);

/* Tabla numero de salas */
CREATE TABLE tbl_salas(
    id_sala INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_tipos_sala INT NOT NULL,
    nombre_sala VARCHAR(20) NOT NULL,
    habilitado BINARY(1) NOT NULL
);
/* Tabla de mesas */
CREATE TABLE tbl_mesas(
    id_mesa INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_mesa VARCHAR(20) NOT NULL,
    sillas INT (2) NOT NULL,
    id_estado_mesa INT NOT NULL,
    id_camarero INT,
    id_sala_mesa INT NOT NULL,
    hora DATE
);
/* Tabla de estado para la mesa */
CREATE TABLE tbl_estado(
    id_estado INT NOT NULL PRIMARY KEY,
    estado_nombre VARCHAR(20) NOT NULL
);

ALTER TABLE tbl_mesas
ADD CONSTRAINT fk_salas_mesas
FOREIGN KEY (id_sala_mesa)
REFERENCES tbl_salas(id_sala);

ALTER TABLE tbl_users
ADD CONSTRAINT fk_users_roles
FOREIGN KEY (rol)
REFERENCES tbl_roles(id_roles);

ALTER TABLE tbl_salas
ADD CONSTRAINT fk_salas_tipos_salas
FOREIGN KEY (id_tipos_sala)
REFERENCES tbl_tipos_salas(id_tipos);

ALTER TABLE tbl_mesas
ADD CONSTRAINT fk_mesas_camareros
FOREIGN KEY (id_camarero)
REFERENCES tbl_users(id_user);

ALTER TABLE tbl_mesas
ADD CONSTRAINT fk_mesas_estado
FOREIGN KEY (id_estado_mesa)
REFERENCES tbl_estado(id_estado);

CREATE TABLE tbl_historial (
    id_historial INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_mesa INT NOT NULL,
    id_sala INT NOT NULL,
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES tbl_users(id_user),
    FOREIGN KEY (id_mesa) REFERENCES tbl_mesas(id_mesa),
    FOREIGN KEY (id_sala) REFERENCES tbl_salas(id_sala)
);
/*_________________________________ Roles _________________________________*/
INSERT INTO tbl_roles VALUES (1,'admin');
INSERT INTO tbl_roles VALUES (2,'camarero');
INSERT INTO tbl_roles VALUES (3,'mantenimiento');
/*_________________________________ Estado _________________________________*/
INSERT INTO tbl_estado VALUES (1,'Ocupado');
INSERT INTO tbl_estado VALUES (2,'Libre');
INSERT INTO tbl_estado VALUES (3,'Reservado');
INSERT INTO tbl_estado VALUES (4,'Mantenimiento');
/*_________________________________ Tipos de sala _________________________________*/
INSERT INTO tbl_tipos_salas VALUES (1,'Terraza',24);
INSERT INTO tbl_tipos_salas VALUES (2,'Comedor',72);
INSERT INTO tbl_tipos_salas VALUES (3,'Sala_privada',16);
/*_________________________________ Salas _________________________________*/
/* Terraza */
INSERT INTO tbl_salas VALUES (1,1,'1',1);
INSERT INTO tbl_salas VALUES (2,1,'2',1);
INSERT INTO tbl_salas VALUES (3,1,'3',1);
/* Comedor */
INSERT INTO tbl_salas VALUES (4,2,'1',1);
INSERT INTO tbl_salas VALUES (5,2,'2',1);
/* Sala privada */
INSERT INTO tbl_salas VALUES (6,3,'1',1);
INSERT INTO tbl_salas VALUES (7,3,'2',1);
INSERT INTO tbl_salas VALUES (8,3,'3',1);
INSERT INTO tbl_salas VALUES (9,3,'4',1);
/* _________________________________ Usuarios _________________________________*/
INSERT INTO tbl_users VALUES (1,'Admin', 'Admin', '$2y$10$eQV9jOJPHQq9X/gY.LUCb.LxlmQaSwyHLOT88AEyQ/55UggDpEbd6', 10000, 123456789, 1);
/*_________________________________ Mesas de sala privada _________________________________*/
INSERT INTO tbl_mesas VALUES (1,'Sp1_M1',16, 2, NULL, 6, NULL);
INSERT INTO tbl_mesas VALUES (2,'Sp2_M2',16, 2, NULL, 7, NULL);
INSERT INTO tbl_mesas VALUES (3,'Sp3_M3',16, 2, NULL, 8, NULL);
INSERT INTO tbl_mesas VALUES (4,'Sp4_M4',16, 2, NULL, 9, NULL);
/*_________________________________ Mesas de Terraza _________________________________*/
/* Sala terraza 1 */
INSERT INTO tbl_mesas VALUES (5, 'T1_M5', 4, 2, NULL, 1, NULL);
INSERT INTO tbl_mesas VALUES (6, 'T1_M6', 4, 2, NULL, 1, NULL);
INSERT INTO tbl_mesas VALUES (7, 'T1_M7', 4, 2, NULL, 1, NULL);
INSERT INTO tbl_mesas VALUES (8, 'T1_M8', 4, 2, NULL, 1, NULL);
INSERT INTO tbl_mesas VALUES (9, 'T1_M9', 4, 2, NULL, 1, NULL);
INSERT INTO tbl_mesas VALUES (10, 'T1_M10', 4, 2, NULL, 1, NULL);
/* Sala terraza 2 */
INSERT INTO tbl_mesas VALUES (11, 'T2_M11', 4, 2, NULL, 2, NULL);
INSERT INTO tbl_mesas VALUES (12, 'T2_M12', 4, 2, NULL, 2, NULL);
INSERT INTO tbl_mesas VALUES (13, 'T2_M13', 4, 2, NULL, 2, NULL);
INSERT INTO tbl_mesas VALUES (14, 'T2_M14', 4, 2, NULL, 2, NULL);
INSERT INTO tbl_mesas VALUES (15, 'T2_M15', 4, 2, NULL, 2, NULL);
INSERT INTO tbl_mesas VALUES (16, 'T2_M16', 4, 2, NULL, 2, NULL);
/* Sala terraza 3 */
INSERT INTO tbl_mesas VALUES (17, 'T3_M17', 4, 2, NULL, 3, NULL);
INSERT INTO tbl_mesas VALUES (18, 'T3_M18', 4, 2, NULL, 3, NULL);
INSERT INTO tbl_mesas VALUES (19, 'T3_M19', 4, 2, NULL, 3, NULL);
INSERT INTO tbl_mesas VALUES (20, 'T3_M20', 4, 2, NULL, 3, NULL);
INSERT INTO tbl_mesas VALUES (21, 'T3_M21', 4, 2, NULL, 3, NULL);
INSERT INTO tbl_mesas VALUES (22, 'T3_M22', 4, 2, NULL, 3, NULL);
/*_________________________________ Mesas del comedor _________________________________*/

/* Mesas de comdeor1 de 2 personas */
INSERT INTO tbl_mesas VALUES (23, 'C1_M23', 2, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (24, 'C1_M24', 2, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (25, 'C1_M25', 2, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (26, 'C1_M26', 2, 2, NULL, 4, NULL);
/* Mesas de comedor1 de 4 personas */
INSERT INTO tbl_mesas VALUES (27, 'C1_M27', 4, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (28, 'C1_M28', 4, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (29, 'C1_M29', 4, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (30, 'C1_M30', 4, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (31, 'C1_M31', 4, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (32, 'C1_M32', 4, 2, NULL, 4, NULL);
/* Mesas de comedor1 de 6 personas */
INSERT INTO tbl_mesas VALUES (33, 'C1_M33', 6, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (34, 'C1_M34', 6, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (35, 'C1_M35', 6, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (36, 'C1_M36', 6, 2, NULL, 4, NULL);
/* Mesas de comedor1 de 8 personas */
INSERT INTO tbl_mesas VALUES (37, 'C1_M37', 8, 2, NULL, 4, NULL);
INSERT INTO tbl_mesas VALUES (38, 'C1_M38', 8, 2, NULL, 4, NULL);

/* Mesas de comdeor2 de 2 personas */
INSERT INTO tbl_mesas VALUES (39, 'C2_M39', 2, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (40, 'C2_M40', 2, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (41, 'C2_M41', 2, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (42, 'C2_M42', 2, 2, NULL, 5, NULL);
/* Mesas de comedor2 de 4 personas */
INSERT INTO tbl_mesas VALUES (43, 'C2_M43', 4, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (44, 'C2_M44', 4, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (45, 'C2_M45', 4, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (46, 'C2_M46', 4, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (47, 'C2_M47', 4, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (48, 'C2_M48', 4, 2, NULL, 5, NULL);
/* Mesas de comedor2 de 6 personas */
INSERT INTO tbl_mesas VALUES (49, 'C2_M49', 6, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (50, 'C2_M50', 6, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (51, 'C2_M51', 6, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (52, 'C2_M52', 6, 2, NULL, 5, NULL);
/* Mesas de comedor2 de 8 personas */
INSERT INTO tbl_mesas VALUES (53, 'C2_M53', 8, 2, NULL, 5, NULL);
INSERT INTO tbl_mesas VALUES (54, 'C2_M54', 8, 2, NULL, 5, NULL);