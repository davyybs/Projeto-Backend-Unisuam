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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastrou`
--

LOCK TABLES `cadastrou` WRITE;
/*!40000 ALTER TABLE `cadastrou` DISABLE KEYS */;
INSERT INTO `cadastrou` VALUES (1,'admin','2025-01-01','Prefiro não informar','#','190.422.737-63','admin@gmail.com','(+55)21-96668-2735','25211200','Rua Chuí','S/N','#','Vila Urussaí','Duque de Caxias','RJ','admin','$2y$10$B0Qs3/po2kZ.TApuk549ruiuSuGtXM.EKZtau0.kpGTXDUBTRlYQu','admin','2025-11-26 00:42:30'),(2,'Usuário Comum','2025-01-01','Prefiro não informar','#','171.698.657-50','user@gmail.com','(+55)21-97775-4456','25211200','Rua Chuí','S/N','#','Vila Urussaí','Duque de Caxias','RJ','User','$2y$10$G8ulyAguoMQPItLZ8oanQe.0zKTv1DWLr6EM5sDRlcBoRh4Pio7Y2','usuario','2025-11-26 00:46:33');
/*!40000 ALTER TABLE `cadastrou` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isbn` bigint DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `autor` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paginas` int DEFAULT NULL,
  `genero` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `edicao` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ano_publicacao` int DEFAULT NULL,
  `capa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (1,6525943302,'Frieren e a Jornada Para o Além - Novel 01','Mei Hachimoku',144,'Novel','Esta é uma história que se passa algum tempo antes de Frieren partir em sua jornada para compreender as pessoas.A coletânea de contos consta com cinco capítulos que exploram diferentes protagonistas: Frieren, Fern, Stark, Lawine, Kanne e, por fim, Aura.',' 1ª',2025,'https://m.media-amazon.com/images/I/712qQnbTqgL._SY466_.jpg',1),(2,6525929970,'Supergirl: Mulher Do Amanhã','Tom King',280,'HQ','Kara Zor-El, a Supergirl, já vivenciou muitas aventuras épicas ao longo dos anos. Porém, nos últimos tempos, ela está passando por uma crise em relação ao seu propósito no mundo. Ela é uma jovem que, depois de ter visto seu planeta ser destruído, foi enviada à Terra para proteger e ajudar o seu primo bebê; contudo, no fim das contas, ele acabou nem precisando dela. Na verdade, aonde quer que ela vá em seu mundo adotivo, as pessoas a veem só como a prima do Superman. Mas a rotina de Kara está prestes a virar de cabeça para baixo. Ao se deparar com uma garota alienígena que busca vingança pelo assassinato de seu pai, a Supergirl se verá obrigada a repensar as suas convicções para ajudar a menina. É então que uma kryptoniana e uma criança furiosa embarcam numa jornada perigosa no melhor estilo espada e feitiçaria espacial que irá mudar a vida de ambas para sempre! ',' 1ª',2025,'https://m.media-amazon.com/images/I/51+cpjRFlmL._SY466_.jpg',1),(3,8555340853,'Enfim, capivaras','Luisa Geisler',208,'Literatura','A cidade no interior de Minas Gerais para onde Vanessa se mudou é o tipo de lugar onde anunciam os horários do cinema e os obituários com o mesmo carro de som. Nada de muito interessante acontece por lá, a não ser para Binho, que, segundo ele mesmo, tem várias namoradas e conhece um monte de cantores sertanejos famosos.\r\nA verdade é que Binho é um mentiroso contumaz e agora passou dos limites: inventou que tem uma capivara de estimação. Cansados das histórias cada vez mais mirabolantes do garoto, Vanessa se junta aos amigos ― Léo, Nick e Zé Luís ― para desmascará-lo. E eles estão decididos a ir até as últimas consequências.\r\nNarrado durante as doze horas de uma noite regada a álcool, salgadinhos, segredos e romances mal resolvidos, Enfim, capivaras explora, através de diferentes pontos de vista, os relacionamentos entre um grupo de adolescentes em busca de uma capivara ― ou muito mais do que isso.','1ª',2019,'https://m.media-amazon.com/images/I/71Go9GXctkL._SY466_.jpg',1),(4,857657313,'Duna: livro 1','Frank Herbert',680,'Ficção Científica','Uma estonteante mistura de aventura e misticismo, ecologia e política, este romance ganhador dos prêmios Hugo e Nebula deu início a uma das mais épicas histórias de toda a ficção científica. Duna é um triunfo da imaginação, que influenciará a literatura para sempre.Esta edição inédita, com introdução de Neil Gaiman, apresenta ao leitor o universo fantástico criado por Herbert e que será adaptado ao cinema por Denis Villeneuve, diretor de A chegada e de Blade Runner 2049.','2ª',2017,'https://m.media-amazon.com/images/I/81zN7udGRUL._SL1500_.jpg',2),(5,9786555352955,'SOMBRA E OSSOS: VOLUME 1 DA TRILOGIA SOMBRA E OSSOS','Leigh Bardugo',350,'literatura fantástica','O clássico do Universo YA em uma nova edição\r\nEm um país dividido pela Dobra das Sombras – uma faixa de terra povoada por monstros sombrios – e no qual a corte real está repleta de pessoas com poderes mágicos, Alina Starkov pode se considerar uma garota comum. Seus dias consistem em trabalhar como cartógrafa no Exército e em tentar esconder de seu melhor amigo, Maly, o que sente por ele.\r\nQuando Maly é gravemente ferido por um dos monstros que vivem na Dobra, Alina, desesperada, descobre que é muito mais forte do que pensava: ela é consegue invocar o poder da luz, a única coisa capaz de acabar com a Dobra das Sombras e reunificar Ravka de uma vez por todas.\r\nPor conta disso, Alina é enviada ao Palácio para ser treinada como parte de um grupo de guerreiros com habilidades extraordinárias, os Grishas. Sob os cuidados do Darkling, o Grisha mais poderoso de todos, Alina terá que aprender a lidar com seus novos poderes, navegar pelas perigosas intrigas da corte e sobreviver a ameaças vindas de todos os lados.','1ª',2021,'seo.jpg',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,2,'2025-11-25 21:47:26','nomeM'),(2,2,'2025-11-25 21:51:53','nomeM'),(3,2,'2025-11-25 21:54:08','nomeM'),(4,2,'2025-11-25 21:57:46','nomeM'),(5,2,'2025-11-25 21:58:14','nomeM'),(6,2,'2025-11-25 22:01:46','nomeM'),(7,2,'2025-11-25 22:01:50','nomeM'),(8,2,'2025-11-25 22:06:22','nomeM'),(9,2,'2025-11-25 22:24:38','nomeM'),(10,2,'2025-11-25 22:24:38','nomeM'),(11,1,'2025-11-25 22:24:51','cpf'),(12,1,'2025-11-25 22:24:52','cpf'),(13,1,'2025-11-25 22:27:34','cpf'),(14,1,'2025-11-25 22:27:37','cpf'),(15,1,'2025-11-25 22:30:58','cep'),(16,1,'2025-11-25 22:31:26','cep'),(17,2,'2025-11-25 22:42:20','cep'),(18,1,'2025-11-25 22:43:28','nomeM'),(19,1,'2025-11-25 22:49:29','nomeM'),(20,1,'2025-11-25 22:50:33','nomeM'),(21,1,'2025-11-25 22:51:25','nomeM'),(22,1,'2025-11-25 22:51:32','nomeM'),(23,1,'2025-11-25 22:51:34','nomeM');
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

-- Dump completed on 2025-11-25 22:56:30
