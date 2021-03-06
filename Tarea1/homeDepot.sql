-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: homedepot
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `cashier`
--

DROP TABLE IF EXISTS `cashier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cashier` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `manager` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `manager` (`manager`),
  CONSTRAINT `cashier_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `manager` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cashier`
--

LOCK TABLES `cashier` WRITE;
/*!40000 ALTER TABLE `cashier` DISABLE KEYS */;
INSERT INTO `cashier` VALUES (1,'Jota Pe',1),(2,'Ale Tovar',2),(3,'Enrique Lozada',3),(4,'Julian Huerta',4),(5,'Fernando Castillo',5),(6,'Jorge Beauregard',6);
/*!40000 ALTER TABLE `cashier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cashiersale`
--

DROP TABLE IF EXISTS `cashiersale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cashiersale` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cashier` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `cashier` (`cashier`),
  KEY `sale` (`sale`),
  CONSTRAINT `cashiersale_ibfk_1` FOREIGN KEY (`cashier`) REFERENCES `cashier` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cashiersale_ibfk_2` FOREIGN KEY (`sale`) REFERENCES `sale` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cashiersale`
--

LOCK TABLES `cashiersale` WRITE;
/*!40000 ALTER TABLE `cashiersale` DISABLE KEYS */;
INSERT INTO `cashiersale` VALUES (1,1,1),(2,1,2),(3,1,4),(4,2,2),(5,2,3),(6,2,8),(7,3,1),(8,3,6),(9,4,4),(10,5,2),(11,6,3),(12,6,8);
/*!40000 ALTER TABLE `cashiersale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Woods'),(2,'Metals'),(3,'Ceramics'),(4,'Tools');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Clark Kent','222435465'),(2,'Steve Rogers','444345465'),(3,'Bruce Banner','232437655'),(4,'Tony Stark','2223064987'),(5,'Bruce Wayne','2221242524'),(6,'Peter Parker','2223098877');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Gardnery'),(2,'Carpentry'),(3,'Toilets'),(4,'Kitchen');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `product` (`product`),
  CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,1,23),(2,2,0),(3,3,100),(4,4,100),(5,5,100),(6,6,100),(7,7,100),(8,8,80),(9,9,100),(10,10,100),(11,11,100),(12,12,100),(13,13,100),(14,14,100),(15,15,100),(16,16,100),(17,17,100),(18,18,100),(19,19,100),(20,20,100),(21,21,100);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (1,'Daniel Aguiñaga','222435465'),(2,'Zuramy Serrano','444345465'),(3,'Javier Santamaria','232437655'),(4,'Yael Toriz','2223064987'),(5,'Kanya Carrasco','2221242524'),(6,'Santiago Vargas','2223098877');
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `orders` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `department` (`department`),
  KEY `category` (`category`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Hammer',54,2,4,15),(2,'Water Centrifuger',1200,3,3,10),(3,'Shovel',154,1,2,20),(4,'Garden Razor',5000,1,4,100),(5,'Chainsaw',54000,2,4,2),(6,'Drill',1500,2,2,200),(7,'Fauce',4000,4,3,90),(8,'Trash Can',50,4,2,4),(9,'Glue',545,2,4,15),(10,'Paint',10,3,3,10),(11,'Toilets',1554,1,2,20),(12,'Window',3510,1,4,100),(13,'Nails',54,2,4,2),(14,'Flower Pot',350,2,2,200),(15,'Dirt',500,4,3,90),(16,'Grass',350,4,2,4),(17,'Floor',4400,2,4,90),(18,'Light Bulb',15,2,2,4),(19,'Fence',300,4,3,90),(20,'Cement',43,4,2,4),(21,'Wood',20,1,1,30);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provider` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider`
--

LOCK TABLES `provider` WRITE;
/*!40000 ALTER TABLE `provider` DISABLE KEYS */;
INSERT INTO `provider` VALUES (1,'Mike Tyson','222435465'),(2,'Samuel L. Jackson','444345465'),(3,'Bradly Cooper','232437655'),(4,'Brad Pitt','2223064987'),(5,'Peter Sam Jason','2221242524'),(6,'Papi Di Caprio','2223098877');
/*!40000 ALTER TABLE `provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `manager` int(11) DEFAULT NULL,
  `provider` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `manager` (`manager`),
  KEY `provider` (`provider`),
  CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`manager`) REFERENCES `manager` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`provider`) REFERENCES `provider` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` VALUES (1,1,2,'2017-02-17 06:11:17'),(2,2,3,'2017-02-17 06:11:17'),(3,3,4,'2017-02-17 06:11:17'),(4,4,5,'2017-02-17 06:11:17'),(5,5,6,'2017-02-17 06:11:17'),(6,6,1,'2017-02-17 06:11:17'),(7,1,1,'2017-02-17 07:14:02');
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseorders`
--

DROP TABLE IF EXISTS `purchaseorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaseorders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `productname` int(11) DEFAULT NULL,
  `productsinstock` int(11) DEFAULT NULL,
  `timeorder` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `productname` (`productname`),
  CONSTRAINT `purchaseorders_ibfk_1` FOREIGN KEY (`productname`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseorders`
--

LOCK TABLES `purchaseorders` WRITE;
/*!40000 ALTER TABLE `purchaseorders` DISABLE KEYS */;
INSERT INTO `purchaseorders` VALUES (3,1,15,'2017-02-17 06:46:44'),(4,2,10,'2017-02-17 08:26:56');
/*!40000 ALTER TABLE `purchaseorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchaseproduct`
--

DROP TABLE IF EXISTS `purchaseproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaseproduct` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `purchase` (`purchase`),
  KEY `product` (`product`),
  CONSTRAINT `purchaseproduct_ibfk_1` FOREIGN KEY (`purchase`) REFERENCES `purchase` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchaseproduct_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchaseproduct`
--

LOCK TABLES `purchaseproduct` WRITE;
/*!40000 ALTER TABLE `purchaseproduct` DISABLE KEYS */;
INSERT INTO `purchaseproduct` VALUES (1,1,1,122),(2,2,2,315),(3,3,3,132),(4,4,4,412),(5,5,5,3),(6,6,6,1523),(9,1,8,14),(10,1,5,50),(11,1,1,47),(12,1,1,500),(13,1,8,16),(14,7,1,23);
/*!40000 ALTER TABLE `purchaseproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `client` (`client`),
  CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale`
--

LOCK TABLES `sale` WRITE;
/*!40000 ALTER TABLE `sale` DISABLE KEYS */;
INSERT INTO `sale` VALUES (1,1,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(2,1,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(3,2,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(4,3,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(5,4,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(6,5,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(7,6,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(8,5,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(9,6,'0000-00-00 00:00:00','2017-02-17 06:06:40'),(10,3,'2017-02-17 00:08:38','2017-02-17 06:08:38'),(11,3,'2017-02-17 00:09:46','2017-02-17 06:09:46'),(12,3,'2017-02-17 00:10:31','2017-02-17 06:10:31'),(13,1,'2017-02-17 01:09:19','2017-02-17 07:09:19'),(14,1,'2017-02-17 02:26:56','2017-02-17 08:26:56');
/*!40000 ALTER TABLE `sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saleproduct`
--

DROP TABLE IF EXISTS `saleproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saleproduct` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `product` (`product`),
  KEY `sale` (`sale`),
  CONSTRAINT `saleproduct_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `saleproduct_ibfk_2` FOREIGN KEY (`sale`) REFERENCES `sale` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saleproduct`
--

LOCK TABLES `saleproduct` WRITE;
/*!40000 ALTER TABLE `saleproduct` DISABLE KEYS */;
INSERT INTO `saleproduct` VALUES (1,1,1,12),(2,2,2,15),(3,3,3,12),(4,4,4,12),(5,5,5,323),(6,7,7,4),(7,8,8,1),(8,8,1,12),(9,7,1,130),(10,2,1,45),(11,1,1,100),(12,1,1,250),(13,19,1,13),(14,4,1,1),(15,16,1,1),(16,17,1,52),(17,7,1,2),(18,18,1,132),(19,15,1,244),(20,20,1,1),(21,1,1,255),(22,2,1,280),(23,2,1,600),(24,10,1,600000),(25,11,1,400000),(26,11,1,800000),(27,11,1,10000000),(28,4,1,20000),(29,3,1,5000),(30,1,NULL,10),(32,1,12,10),(33,1,1,100),(34,8,13,20),(35,2,14,100);
/*!40000 ALTER TABLE `saleproduct` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER after_saleproduct_insert AFTER INSERT ON saleproduct
FOR EACH ROW
BEGIN
DECLARE v INTEGER DEFAULT 1;
SELECT inventory.quantity INTO v FROM inventory WHERE inventory.product = new.product;
IF v = new.quantity THEN
INSERT INTO purchaseOrders (productname, productsinstock, timeorder) VALUES (new.product, (SELECT orders from product where Id = new.product), now());
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `salesperhour`
--

DROP TABLE IF EXISTS `salesperhour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salesperhour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amountofsales` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salesperhour`
--

LOCK TABLES `salesperhour` WRITE;
/*!40000 ALTER TABLE `salesperhour` DISABLE KEYS */;
INSERT INTO `salesperhour` VALUES (7,1,'2017-02-17 03:39:03'),(8,12,'2017-02-17 06:39:03'),(9,1,'2017-02-17 07:39:03');
/*!40000 ALTER TABLE `salesperhour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp`
--

DROP TABLE IF EXISTS `temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp` (
  `h` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp`
--

LOCK TABLES `temp` WRITE;
/*!40000 ALTER TABLE `temp` DISABLE KEYS */;
INSERT INTO `temp` VALUES (2),(422),(422);
/*!40000 ALTER TABLE `temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'homedepot'
--
/*!50106 SET @save_time_zone= @@TIME_ZONE */ ;
/*!50106 DROP EVENT IF EXISTS `salesperhour` */;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = utf8 */ ;;
/*!50003 SET character_set_results = utf8 */ ;;
/*!50003 SET collation_connection  = utf8_general_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = 'SYSTEM' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`root`@`localhost`*/ /*!50106 EVENT `salesperhour` ON SCHEDULE EVERY 1 HOUR STARTS '2017-02-16 21:39:03' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
DECLARE _commit INTEGER DEFAULT 1;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
BEGIN
SET _commit = 0;
END;
start transaction;
INSERT INTO salesperhour(amountofsales, time) VALUES((SELECT count(*) FROM sale WHERE time >= DATE_SUB(NOW(), interval 1 hour)), NOW());
IF _commit = 1 THEN
commit;
ELSE
rollback;
END IF;
END */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
DELIMITER ;
/*!50106 SET TIME_ZONE= @save_time_zone */ ;

--
-- Dumping routines for database 'homedepot'
--
/*!50003 DROP FUNCTION IF EXISTS `profit` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `profit`() RETURNS int(11)
    DETERMINISTIC
BEGIN 
  DECLARE gain INTEGER;
  DECLARE sales INTEGER;
  DECLARE purchase INTEGER;
  SELECT SUM(price * saleProduct.quantity) INTO sales FROM product, saleProduct, sale  WHERE saleProduct.product = product.Id AND saleProduct.sale = sale.Id AND sale.time >= DATE_SUB(NOW(), interval 24 hour);
  SELECT SUM(price * purchaseProduct.quantity) INTO purchase FROM product, purchaseProduct, purchase  WHERE purchaseProduct.product = product.Id AND purchaseProduct.purchase = purchase.Id AND purchase.time >= DATE_SUB(NOW(), interval 24 hour);
  SET gain = sales - purchase;
  RETURN gain;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `notnegatives` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `notnegatives`(IN id INT, IN quantity INT, OUT flg INT)
BEGIN
DECLARE v INTEGER DEFAULT 0;
DECLARE _commit INTEGER DEFAULT 1;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
BEGIN
SET _commit = 0;
END;
start transaction;
SELECT inventory.quantity INTO v FROM inventory WHERE id = inventory.product;
IF v < quantity THEN 
SET flg = 1;
ELSE 
SET flg = 0;
END IF;
IF _commit = 1 THEN
commit;
ELSE
rollback;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `productsbycategorie` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `productsbycategorie`(IN c INT, OUT q INT)
BEGIN
DECLARE _commit INTEGER DEFAULT 1;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
BEGIN
SET _commit = 0;
END;
start transaction;
SELECT SUM(quantity) INTO q FROM inventory, product, category WHERE product.Id = inventory.product AND product.category = category.Id AND c = category.Id;
IF _commit = 1 THEN
commit;
ELSE
rollback;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-17  2:30:20
