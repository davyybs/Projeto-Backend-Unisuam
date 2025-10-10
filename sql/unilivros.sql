-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: unilivros
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `cadastrou`
--

LOCK TABLES `cadastrou` WRITE;
/*!40000 ALTER TABLE `cadastrou` DISABLE KEYS */;
INSERT INTO `cadastrou` VALUES (1,'João Pedro Coelho','2007-06-18','Transgênero','João Pedro Coelho','163.984.827-43','jpfc768@gmail.com','(+55)21-991748342','25220574','Rua BK','5','9','Cangulo','Duque de Caxias','RJ','loginu','$2y$10$S1agutRShYfv7gHkAc9PU.0C143bBkBTIhW8U4u5lemJKq30810Q2','usuario','2025-09-23 01:35:53'),(2,'Davi Ferreira','2007-05-16','Masculino','Micheli Ferreira','42219073763','daviferreira88@gmail.com','(+55)21-977754365','25211290','Beco Mané Garrincha','24','Em frente ao posto de gasolina','Jardim Primavera','Duque de Caxias','RJ','davibs','$2y$10$tG7nG3h7Qt4.Wd4RyaIqtO9BasV1o6Fgd88KVfP2ZDuB8nk1ERvWC','usuario','2025-09-26 21:23:49'),(3,'Joseph Joestar','1920-09-27','Masculino','LIsa Lisa','19017115769','jojogoat@gmail.com','(+55)21-977234567','25211291','Battle Tendency','2','Próximo aos Homens do Pilar','Brooklyn','Nova York','RJ','JoJo','$2y$10$WrYGwi20vvDxAgWrAPxwdu4yytl67tAhvbQkk7kSfz/Tvf0jtE58e','usuario','2025-10-02 01:29:30');
/*!40000 ALTER TABLE `cadastrou` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (1,9788576573135,'Duna','Frank Herbert',680,'Ficção Científica','1 de 6',2017,'https://m.media-amazon.com/images/I/81zN7udGRUL._SL1500_.jpg',50);
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'unilivros'
--

--
-- Dumping routines for database 'unilivros'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-10 19:01:32
