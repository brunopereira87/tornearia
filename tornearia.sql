-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tornearia
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `com_servicos` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Tornearia',1),(2,'Serralheria',1),(3,'Usinagem',1),(4,'Arte e Acabamento',1),(5,'VidraÃ§aria',1),(6,'Solda',1),(7,'Ferro Fundido',1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveis_usuario`
--

DROP TABLE IF EXISTS `niveis_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveis_usuario` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nivel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveis_usuario`
--

LOCK TABLES `niveis_usuario` WRITE;
/*!40000 ALTER TABLE `niveis_usuario` DISABLE KEYS */;
INSERT INTO `niveis_usuario` VALUES (1,'Administrador'),(2,'Funcionario');
/*!40000 ALTER TABLE `niveis_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` text,
  `imagem` varchar(300) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (4,'PortÃ£o de Vidro Blindado','Produto feito no torno','upload/imagem2.png',5),(6,'Produto6','Solda de aÃ§o em roda de caminhÃ£o','upload/imagem2.png',6),(10,'Produto 10','Novo produto do mercado','upload/imagem2.png',3),(11,'Portao','Portao','upload/58c9b7eaa427e9636ba851bb644c39de.jpg',2),(12,'Calha Personalizada','Personalize a sua calha da maneira que bem desejar',NULL,2),(13,'Calha Personalizada 2','Calha Personalizada',NULL,2),(14,'ServiÃ§o de Usinagem 1','ServicÃ§os de Usinagem',NULL,3),(15,'ServiÃ§o de Usinagem 2','ServiÃ§o de USINAGEM',NULL,3),(16,'ServiÃ§o de arte e acabamento 1','ServiÃ§o de arte e acabamento',NULL,4),(26,'PortÃ£o ornamentado','PortÃ£o Ornamentado',NULL,4),(27,'ServiÃ§o de arte e acabamento 3','ServiÃ§o de arte e acabamento',NULL,4),(28,'Katana de Kioto','Espada japonesa com material milenar',NULL,7);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos_imagens`
--

DROP TABLE IF EXISTS `servicos_imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos_imagens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(300) NOT NULL,
  `id_servico` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_SERVICOS_idx` (`id_servico`),
  CONSTRAINT `FK_SERVICOS` FOREIGN KEY (`id_servico`) REFERENCES `servicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos_imagens`
--

LOCK TABLES `servicos_imagens` WRITE;
/*!40000 ALTER TABLE `servicos_imagens` DISABLE KEYS */;
INSERT INTO `servicos_imagens` VALUES (1,'7a50b22188d06abe061dafa03bb30e32.jpg',13),(2,'5d468afecddf1d53c3a06ff31b994a05.jpg',13),(3,'ff919b02a0fde34fc0b8340b07045f9a.jpg',13),(4,'a81ad31ace94f08da05582940a95a3b0.jpg',14),(5,'81bf051e054ec04840ea50a8cea244e4.jpg',14),(6,'ddbd7deb78c14295314bb2624f568522.jpg',15),(7,'39b6781d1940da59f96395bc1ae3e83e.jpg',15),(8,'67955341589d74ea8e312bad4f6496eb.jpg',16),(9,'bc9acb4aa26a27a2bf7737260bbb5150.jpg',16),(10,'25fa1e2a402bca7ffc819d5845a82a3d.jpg',16),(20,'54a49f99f6f8c31a739986f396feaf18.jpg',26),(21,'d2dcdce122aa686971d6f9f04a83d20d.jpg',27),(22,'6b85fd8b9a0d783cd7284a18e2a706a3.jpg',27),(25,'272c324016ae8604d05bd2d36436dbec.jpg',11),(26,'9ca8ea198e5217a1bb52dcf347017ca4.jpg',11),(27,'534ede9ae0775b30fb4da56365270def.jpg',11),(28,'518deda6aa18e981a533516090ded55e.jpg',11),(29,'9611c8d7fd1a618d80e9de8629d5281d.jpg',11),(30,'3b8652f69e1603a80bf739b1b4a75c13.jpg',11),(31,'1c051bef6e7d40b65e472ef8096d46d0.jpg',11),(32,'37cdb5be6eaf3433d0cf4efdcd2cf8a9.jpg',11),(33,'6d6813ee2397d0ac7119ee4ec3566dc5.jpg',11),(34,'6cd9408a435998ad86a570f1b5634456.jpg',11);
/*!40000 ALTER TABLE `servicos_imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nivel_usuario_id` tinyint(3) unsigned NOT NULL,
  `nome` varchar(60) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_NIVEL_USUARIO` (`nivel_usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'Bruno Pereira','brunaobass','bruno@hotmail.com','698dc19d489c4e4db73e28a713eab07b','img/usuarios/28724e72fc90395f691391580829b8ab.jpg'),(2,2,'LaÃ­s Suzano','lalaregosuzi','laisrego@hotmail.com','200820e3227815ed1756a6b531e7e0d2','img/usuarios/02e65fa5ffd06463ce0bb01c5ccf5ea0.jpg'),(3,2,'Mario Cardoso','marioquemario','mariodoarmario@hotmail.com','200820e3227815ed1756a6b531e7e0d2','img/usuarios/13ed5e3e68dc892ab61b168f5e02a677.png'),(4,2,'Jane Demonia','jane','janevil@madog.com','200820e3227815ed1756a6b531e7e0d2','img/usuarios/c4569498df3b72bfe7fdb25c162f8954.jpg');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-01 15:29:16
