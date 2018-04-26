-- MySQL dump 10.13  Distrib 5.7.22, for osx10.13 (x86_64)
--
-- Host: localhost    Database: USO_INTELIGENTE
-- ------------------------------------------------------
-- Server version	5.7.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
--
-- Table structure for table `PROYECTOS`
--

DROP TABLE IF EXISTS `PROYECTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROYECTOS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` char(20) NOT NULL,
  `OBJETIVO` char(100) DEFAULT NULL,
  `INTRODUCCION` char(100) DEFAULT NULL,
  `PRESUPUESTO` decimal(10,2) DEFAULT NULL,
  `DIAGNOSTICO` char(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROYECTOS`
--

LOCK TABLES `PROYECTOS` WRITE;
/*!40000 ALTER TABLE `PROYECTOS` DISABLE KEYS */;
INSERT INTO `PROYECTOS` VALUES (1,'TRAYECTO FI','Promoción de la ciencia y la tecnología dentro de una comunidad rural','Las comunidades rurales necesitan implementar ciencia y tecnología',83500.00,'Faltan temas para difundir, comunidades a las cuales generar impacto'),(2,'iStudy','Difusión de información escolar','Facilitar el acceso a la información de las materias, así como las tareas por entregar',55000.50,'Faltan aterrizar ideas, buscar recursos'),(3,'HackMx','Difusión de ciencia y tecnología','Buscar soluciones a problemas de hoy en día por medio de tecnología',46000.00,'Faltan patrocinadores'),(4,'Estamos contigo','Reconstrucción de zonas rurales','Las comunidades rurales necesitan reconstruirse',100000.00,'Faltan materiales para la reconstrucción'),(5,'Humano','Promoción de los derechos de la comunidad LGBT','Fomentar el respeto de la gente que forma parte de la comunidad',20000.00,'Falta ponentes');
/*!40000 ALTER TABLE `PROYECTOS` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `CATEGORIAS`
--

DROP TABLE IF EXISTS `CATEGORIAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORIAS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` char(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORIAS`
--

LOCK TABLES `CATEGORIAS` WRITE;
/*!40000 ALTER TABLE `CATEGORIAS` DISABLE KEYS */;
INSERT INTO `CATEGORIAS` VALUES (1,'TECNOLOGIA'),(2,'DESARROLLO URBANO'),(3,'SOCIEDAD');
/*!40000 ALTER TABLE `CATEGORIAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATEGORIA_PROYECTO`
--

DROP TABLE IF EXISTS `CATEGORIA_PROYECTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORIA_PROYECTO` (
  `PROYECTO` int(11) NOT NULL,
  `CATEGORIA` int(11) NOT NULL,
  PRIMARY KEY (`PROYECTO`,`CATEGORIA`),
  KEY `PROYECTOS_FK2` (`CATEGORIA`),
  CONSTRAINT `PROYECTOS_FK1` FOREIGN KEY (`PROYECTO`) REFERENCES `PROYECTOS` (`ID`),
  CONSTRAINT `PROYECTOS_FK2` FOREIGN KEY (`CATEGORIA`) REFERENCES `CATEGORIAS` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORIA_PROYECTO`
--

LOCK TABLES `CATEGORIA_PROYECTO` WRITE;
/*!40000 ALTER TABLE `CATEGORIA_PROYECTO` DISABLE KEYS */;
INSERT INTO `CATEGORIA_PROYECTO` VALUES (1,1),(2,1),(3,1),(3,2),(1,3),(3,3),(4,3),(5,3);
/*!40000 ALTER TABLE `CATEGORIA_PROYECTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ESTADO_PROYECTOS`
--

DROP TABLE IF EXISTS `ESTADO_PROYECTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ESTADO_PROYECTOS` (
  `FECHA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PROYECTO` int(11) NOT NULL,
  `ESTADO` char(3) NOT NULL,
  PRIMARY KEY (`FECHA`,`PROYECTO`,`ESTADO`),
  KEY `ESTADO_PROYECTOS_FK` (`PROYECTO`),
  CONSTRAINT `ESTADO_PROYECTOS_FK` FOREIGN KEY (`PROYECTO`) REFERENCES `PROYECTOS` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ESTADO_PROYECTOS`
--

LOCK TABLES `ESTADO_PROYECTOS` WRITE;
/*!40000 ALTER TABLE `ESTADO_PROYECTOS` DISABLE KEYS */;
INSERT INTO `ESTADO_PROYECTOS` VALUES ('2018-04-25 10:02:40',1,'EPC'),('2018-04-25 10:02:40',2,'EPC'),('2018-04-25 10:02:40',3,'CAN'),('2018-04-25 10:02:40',4,'EPC'),('2018-04-25 10:02:41',5,'COM');
/*!40000 ALTER TABLE `ESTADO_PROYECTOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NOTAS_PROYECTOS`
--

DROP TABLE IF EXISTS `NOTAS_PROYECTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NOTAS_PROYECTOS` (
  `PROYECTO` int(11) NOT NULL,
  `USUARIO` int(11) NOT NULL,
  `FECHA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NOTA` char(255) DEFAULT NULL,
  PRIMARY KEY (`PROYECTO`,`USUARIO`,`FECHA`),
  KEY `NOTAS_PROYECTOS_FK2` (`USUARIO`),
  CONSTRAINT `NOTAS_PROYECTOS_FK1` FOREIGN KEY (`PROYECTO`) REFERENCES `PROYECTOS` (`ID`),
  CONSTRAINT `NOTAS_PROYECTOS_FK2` FOREIGN KEY (`USUARIO`) REFERENCES `USUARIOS` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NOTAS_PROYECTOS`
--

LOCK TABLES `NOTAS_PROYECTOS` WRITE;
/*!40000 ALTER TABLE `NOTAS_PROYECTOS` DISABLE KEYS */;
INSERT INTO `NOTAS_PROYECTOS` VALUES (1,2,'2008-08-18 00:00:00','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \nAenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque \n'),(2,6,'2008-08-18 00:00:00','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \nAenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque \n'),(3,2,'2008-08-18 00:00:00','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \nAenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque \n'),(4,1,'2008-08-18 00:00:00','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \nAenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque \n'),(5,3,'2008-08-18 00:00:00','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \nAenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque \n');
/*!40000 ALTER TABLE `NOTAS_PROYECTOS` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `USUARIOS`
--

DROP TABLE IF EXISTS `USUARIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USUARIOS` (
  `ID` int(11) NOT NULL,
  `NOMBRE` char(20) DEFAULT NULL,
  `APELLIDO` char(20) DEFAULT NULL,
  `DIRECCION` char(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USUARIOS`
--

LOCK TABLES `USUARIOS` WRITE;
/*!40000 ALTER TABLE `USUARIOS` DISABLE KEYS */;
INSERT INTO `USUARIOS` VALUES (1,'Carlos','Carbajal','Camino a Quinta Saulo #50'),(2,'Rafaín','Rodríguez','Espiritu Santo #8'),(3,'Javier','Rodríguez','Calzada de las Orquídeas #4'),(4,'Juan','Gómez','Tesorero #20'),(5,'Allan','Sánchez','Rincón de la Alegría #34'),(6,'Pablo','Ramos','Chiapas #32');
/*!40000 ALTER TABLE `USUARIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USUARIO_PROYECTOS`
--

DROP TABLE IF EXISTS `USUARIO_PROYECTOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USUARIO_PROYECTOS` (
  `USUARIO` int(11) NOT NULL,
  `PROYECTO` int(11) NOT NULL,
  PRIMARY KEY (`USUARIO`,`PROYECTO`),
  KEY `USUARIO_PROYECTOS_FK2` (`PROYECTO`),
  CONSTRAINT `USUARIO_PROYECTOS_FK1` FOREIGN KEY (`USUARIO`) REFERENCES `USUARIOS` (`ID`),
  CONSTRAINT `USUARIO_PROYECTOS_FK2` FOREIGN KEY (`PROYECTO`) REFERENCES `PROYECTOS` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USUARIO_PROYECTOS`
--

LOCK TABLES `USUARIO_PROYECTOS` WRITE;
/*!40000 ALTER TABLE `USUARIO_PROYECTOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `USUARIO_PROYECTOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `resumenproyectos`
--

DROP TABLE IF EXISTS `resumenproyectos`;
/*!50001 DROP VIEW IF EXISTS `resumenproyectos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `resumenproyectos` AS SELECT
 1 AS `ID`,
 1 AS `PROYECTO`,
 1 AS `ESTADO`,
 1 AS `FONDOS`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `ultimomes`
--

DROP TABLE IF EXISTS `ultimomes`;
/*!50001 DROP VIEW IF EXISTS `ultimomes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ultimomes` AS SELECT
 1 AS `ID`,
 1 AS `NOMBRE`,
 1 AS `PRESUPUESTO`,
 1 AS `ESTADO`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `resumenproyectos`
--

/*!50001 DROP VIEW IF EXISTS `resumenproyectos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `resumenproyectos` AS (select `proyectos`.`ID` AS `ID`,`proyectos`.`NOMBRE` AS `PROYECTO`,`estado_proyectos`.`ESTADO` AS `ESTADO`,`proyectos`.`PRESUPUESTO` AS `FONDOS` from (`proyectos` join `estado_proyectos` on((`proyectos`.`ID` = `estado_proyectos`.`PROYECTO`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ultimomes`
--

/*!50001 DROP VIEW IF EXISTS `ultimomes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ultimomes` AS (select `proyectos`.`ID` AS `ID`,`proyectos`.`NOMBRE` AS `NOMBRE`,`proyectos`.`PRESUPUESTO` AS `PRESUPUESTO`,`estado_proyectos`.`ESTADO` AS `ESTADO` from ((`proyectos` join `estado_proyectos` on((`proyectos`.`ID` = `estado_proyectos`.`PROYECTO`))) join `notas_proyectos` on((`notas_proyectos`.`PROYECTO` = `proyectos`.`ID`))) where ((`estado_proyectos`.`FECHA` > (now() + interval -(1) month)) or (`notas_proyectos`.`FECHA` > (now() + interval -(1) month)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-25 21:09:56
