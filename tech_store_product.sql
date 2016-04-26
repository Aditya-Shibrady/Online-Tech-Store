CREATE DATABASE  IF NOT EXISTS `tech_store` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tech_store`;
-- MySQL dump 10.13  Distrib 5.1.40, for Win32 (ia32)
--
-- Host: localhost    Database: tech_store
-- ------------------------------------------------------
-- Server version	5.1.42-community

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
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(1000) NOT NULL,
  `productDescription` varchar(1000) NOT NULL,
  `productPrice` varchar(10) NOT NULL,
  `quantity` int(5) NOT NULL,
  `productCategoryId` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL DEFAULT 'true',
  PRIMARY KEY (`productId`,`productCategoryId`),
  KEY `productCategoryId` (`productCategoryId`),
  CONSTRAINT `productCategoryId` FOREIGN KEY (`productCategoryId`) REFERENCES `product_category` (`productCategoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'HTC Desire 816 Black (Virgin mobile) - 5.5 inch S-LCD Display','Android 4.4 Kit Kat OS with HTC Sense 6.0 and 1.6 GHz','249.99',110,'1','true'),(2,'LG Optimus Exceed 2','4.5 inch WVGA Display with Gorilla Glass touch screen. Andriod 4.4.2 KitKat','129.75',10,'1','true'),(3,'Moto G Black (Boost Mobile)','Quad-core 1.2GHz processor with 450MHz graphics processor','99',30,'1','true'),(4,'Samsung Galaxy S III (S3)','OS: Android 4.1 (Ice Cream Sandwich)','199',5,'1','true'),(5,'Apple iPhone 6 64GB (AT&T) Gold','The iPhone 6 features a 4.7-inch retina HD display','719',15,'1','true'),(6,'Hp Spectre X360 2-in-1 Intel Core I7','Intel Celeron 2.16 GHz Processor, 2 GB DDR3L SDRAM, 16 GB Solid-State Drive (SSD)','899',40,'2','true'),(7,'Apple MacBook Pro MD101LL/A 13.3-Inch Laptop','2.5 GHz Dual-Core Intel Core i5 processor','1084',90,'2','true'),(8,'Samsung Chromebook 2 11.6 Inch Laptop','16 GB Solid-State Drive (SSD); No CD or DVD drive, Chrome Operating System; Silver Chassis','203.9',20,'2','true'),(9,'ASUS E402MA 14 Inch','Description - 2GB RAM/ 32GB storage. Windows 10 operation system.','199',87,'2','true'),(10,'Dell Latitude E7250 12.5inch LED Ultrabook','Processor: Intel Core 5th Generation i5-5300U Processor (3M Cache, up to 2.90 GHz)','999',10,'2','true'),(11,'Norton Security Deluxe - 5 Devices','Protects your PCs, Macs, Androids and iOS devices with a single protection plan, any combination of 5 devices.','49.99',60,'4','true'),(12,'Microsoft Office Home and Student 2016','Full, installed Office 2016 versions of Word, Excel, PowerPoint, and OneNote','119',130,'4','true'),(13,'Quicken Deluxe 2016 Personal Finance & Budgeting Software','Organizes your personal finance, bank, credit card, investment, and retirement accounts all in one place','74.95',34,'4','true'),(14,'McAfee 2016 Internet Security Unlimited Devices','Protect every device you own-Comprehensive protection for all your PCs, Macs, smartphones, and tablets with the convenience of a single subscription','24.99',123,'4','true'),(15,'Microsoft Windows 10 Home 64 Bit System Builder OEM','Windows 10 comes with apps that work across your devices - Photos, Maps, Music Video and more.','109.99',78,'4','true'),(16,'HP EliteBook 2760p 12-Inch','Intel 320G 4G, Screen Resolution: 1280 x 800, Screen Size: 12-Inch, Screen Mode: WXGA','233',71,'3','true'),(17,'Asus Transformer Book 10.1-inch 32GB','32GB Storage in Tablet (expandable up to 128GB via microSD) + 500GB Hard Drive Storage in Dock','449',5,'3','true'),(18,'Microsoft Surface 2 32GB','Surface 2 is powerful, yet ultra-thin and lightweight, weighs less than 1.5 pounds, 8.9mm thin.','203.99',20,'3','true'),(19,'Dell Venue 8 32 GB Tablet (Android)','Intel Atom Z2580 2.0 GHz','134.97',80,'3','true'),(20,'Apple iPad mini','7.9-inch LED-backlit Multi-Touch Display; 1024-by-768 Resolution, Apple iOS 6; Dual-Core A5 Chip 1GHZ ','225',29,'3','false'),(21,'test','test ','123.33',30,'1','true');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-02 15:19:11
