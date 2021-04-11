DROP TABLE IF EXISTS `RolesUsuario`;
DROP TABLE IF EXISTS `Mensajes`;
DROP TABLE IF EXISTS `Roles`;
DROP TABLE IF EXISTS `Usuarios`;
/*ENTIDADES*/
CREATE TABLE IF NOT EXISTS `Roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `RolesUsuario` (
  `usuario` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`usuario`,`rol`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS `Usuarios` (
  `id`                 int(11)      NOT NULL AUTO_INCREMENT,
  `username`           varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password`           varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
   /*NIF                 VARCHAR(9)                             NOT NULL,*/
   EMAIL               VARCHAR(100) 	                      NOT NULL,
   CONTRASENA      	   VARCHAR(20) 	NOT NULL,
   TELEFONO            INT 		   	NOT NULL,
   /*IMAGEN            varbinary,*/
   DESCRIPCION         VARCHAR(250)    NULL,
   DISPONIBILIDAD      INT             NOT NULL, /*POR DEFINIR*/
   SERVICIO_OFERTADO   INT             NULL,
   MONEDERO            INT             NOT NULL,
   FECHA_CREACION      DATE            NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Mensajes` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `autor` int(11) NOT NULL,
      `mensaje` varchar(140) NOT NULL,
      `fechaHora` DATETIME NOT NULL,
      `idMensajePadre` int(11) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4  COLLATE=utf8mb4_general_ci;


ALTER TABLE `RolesUsuario`          ADD CONSTRAINT `RolesUsuario_usuario`                       FOREIGN KEY (`usuario`)             REFERENCES `Usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `RolesUsuario`          ADD CONSTRAINT `RolesUsuario_rol`                           FOREIGN KEY (`rol`)                 REFERENCES `Roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `Mensajes`              ADD CONSTRAINT `Mensajes_mensaje`                           FOREIGN KEY (`idMensajePadre`)      REFERENCES `Mensajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `Mensajes`              ADD CONSTRAINT `Mensajes_autor`                             FOREIGN KEY (`autor`)               REFERENCES `Usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;