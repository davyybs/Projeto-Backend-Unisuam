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
-- Table structure for table `cadastrou`
--

DROP TABLE IF EXISTS `cadastrou`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastrou` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `data_nasc` date NOT NULL,
  `sexo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nomeM` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` char(14) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `cep` char(9) COLLATE utf8mb4_general_ci NOT NULL,
  `rua` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `complemento` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bairro` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `cidade` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `estado` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_usuario` enum('usuario','admin') COLLATE utf8mb4_general_ci DEFAULT 'usuario',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastrou`
--

LOCK TABLES `cadastrou` WRITE;
/*!40000 ALTER TABLE `cadastrou` DISABLE KEYS */;
INSERT INTO `cadastrou` VALUES (1,'João Pedro Coelho','2007-06-18','Transgênero','João Pedro Coelho','163.984.827-43','jpfc768@gmail.com','(+55)21-991748342','25220574','Rua BK','5','9','Cangulo','Duque de Caxias','RJ','loginu','$2y$10$S1agutRShYfv7gHkAc9PU.0C143bBkBTIhW8U4u5lemJKq30810Q2','usuario','2025-09-23 01:35:53'),(2,'Davi Ferreira','2007-05-16','Masculino','Micheli Ferreira','42219073763','daviferreira88@gmail.com','(+55)21-977754365','25211290','Beco Mané Garrincha','24','Em frente ao posto de gasolina','Jardim Primavera','Duque de Caxias','RJ','davibs','$2y$10$tG7nG3h7Qt4.Wd4RyaIqtO9BasV1o6Fgd88KVfP2ZDuB8nk1ERvWC','usuario','2025-09-26 21:23:49'),(3,'Joseph Joestar','1920-09-27','Masculino','LIsa Lisa','19017115769','jojogoat@gmail.com','(+55)21-977234567','25211291','Battle Tendency','2','Próximo aos Homens do Pilar','Brooklyn','Nova York','RJ','JoJo','$2y$10$WrYGwi20vvDxAgWrAPxwdu4yytl67tAhvbQkk7kSfz/Tvf0jtE58e','usuario','2025-10-02 01:29:30'),(4,'Testsifasfe','2000-05-05','Masculino','afeefageag','190.422.737-63','daviferreira8888@gmail.com','21114123535453','25211200','asdasfsa','dasda','dasdaa','sdafag','adgdgg','RJ','Teste','$2y$10$H1CVRQer/nTmTATayJA1yOlPEiaUF7a07gIrd0UCmztaEoidESPV6','usuario','2025-11-21 18:50:31');
/*!40000 ALTER TABLE `cadastrou` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livros` (
  `id_livro` int NOT NULL AUTO_INCREMENT,
  `isbn` bigint DEFAULT NULL,
  `titulo` varchar(60) NOT NULL,
  `autor` varchar(60) NOT NULL,
  `num_paginas` int NOT NULL,
  `genero` varchar(25) NOT NULL,
  `edicao` varchar(10) NOT NULL,
  `ano` int NOT NULL,
  `capa` varchar(150) NOT NULL,
  `quant` int NOT NULL,
  PRIMARY KEY (`id_livro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (1,9788576573135,'Duna','Frank Herbert',680,'Ficção Científica','1 de 6',2017,'https://m.media-amazon.com/images/I/81zN7udGRUL._SL1500_.jpg',50);
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `data_acesso` datetime NOT NULL,
  `tipo_2fa` varchar(20) NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,4,'2025-11-24 00:52:38','nomeM'),(2,4,'2025-11-24 00:53:00','nomeM'),(3,4,'2025-11-24 01:08:30','nomeM'),(4,4,'2025-11-24 01:09:32','nomeM'),(5,4,'2025-11-24 01:09:34','nomeM'),(6,4,'2025-11-24 01:09:37','nomeM'),(7,4,'2025-11-25 14:51:13','cpf'),(8,4,'2025-11-25 14:51:37','cpf'),(9,4,'2025-11-25 14:52:08','cpf'),(10,4,'2025-11-25 14:52:12','cpf');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-25 14:55:04
