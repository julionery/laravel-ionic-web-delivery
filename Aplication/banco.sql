CREATE DATABASE  IF NOT EXISTS `webdelivery` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `webdelivery`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: webdelivery
-- ------------------------------------------------------
-- Server version	5.7.13-log

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE KEY `cache_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(10) unsigned NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `categorias_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `categorias_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,1,'illum','2016-07-03 21:40:24','2016-07-03 21:40:24'),(2,1,'et','2016-07-03 21:40:24','2016-07-03 21:40:24'),(3,1,'harum','2016-07-03 21:40:24','2016-07-03 21:40:24'),(4,1,'quia','2016-07-03 21:40:24','2016-07-03 21:40:24'),(5,1,'necessitatibus','2016-07-03 21:40:24','2016-07-03 21:40:24'),(6,2,'quam','2016-07-03 21:40:24','2016-07-03 21:40:24'),(7,2,'qui','2016-07-03 21:40:24','2016-07-03 21:40:24'),(8,2,'porro','2016-07-03 21:40:24','2016-07-03 21:40:24'),(9,2,'molestiae','2016-07-03 21:40:24','2016-07-03 21:40:24'),(10,2,'exercitationem','2016-07-03 21:40:24','2016-07-03 21:40:24'),(11,3,'voluptate','2016-07-03 21:40:24','2016-07-03 21:40:24'),(12,3,'dolor','2016-07-03 21:40:24','2016-07-03 21:40:24'),(13,3,'dicta','2016-07-03 21:40:24','2016-07-03 21:40:24'),(14,3,'nihil','2016-07-03 21:40:24','2016-07-03 21:40:24'),(15,3,'sed','2016-07-03 21:40:24','2016-07-03 21:40:24');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `clientes_user_id_foreign` (`user_id`),
  CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,1,'+1 (370) 964-9910','86996 Reynolds Passage Apt. 832\nWest Kip, KS 75500-9870','ipsam','75548','Lake Austen','District of Columbia',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(2,2,'1-459-725-6950 x691','829 Hickle Crossing\nLake Brodyview, HI 30555-7662','nulla','45986-4178','New Blakefurt','Washington',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(3,3,'1-674-825-2356','50064 Lydia Ways\nMcKenzieton, SD 95194-6205','in','72746','Violetchester','Montana',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(4,4,'+1 (397) 285-6945','455 Haley Underpass Suite 825\nConnshire, VA 07622','velit','62042','South Vanceborough','Louisiana',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(5,5,'714-398-4527 x3675','25137 Lueilwitz Shores Suite 460\nNew Clemens, MI 38014','explicabo','91904','Lindgrenborough','Virginia',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(6,6,'341.756.7377 x019','53696 Kristoffer Parkway\nWest Madonnamouth, ME 44294','quae','51746-5192','Port Einarville','Utah',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(7,7,'1-501-410-9674','2970 Amos Coves Suite 675\nLake Martyshire, NH 26056-6803','pariatur','78503','West Wilfredport','North Dakota',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(8,8,'443.479.9462 x5264','59689 Nikolaus Field\nJohannafort, SC 97454-7102','asperiores','04101','South Britney','New Hampshire',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(9,9,'(628) 884-5366 x96611','127 Unique Parkway\nSouth Cesarchester, DC 69493-7791','unde','01801','West Tomview','Missouri',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(10,10,'842-301-0912','37615 Dario Plain Apt. 150\nRosieshire, NE 72756','dolore','62929','Cassieton','Connecticut',NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `componentes`
--

DROP TABLE IF EXISTS `componentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `componentes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(10) unsigned NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `componentes_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `componentes_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `componentes`
--

LOCK TABLES `componentes` WRITE;
/*!40000 ALTER TABLE `componentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `componentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `razao_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome_fantasia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cnpj` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` text COLLATE utf8_unicode_ci,
  `bairro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `consumacao_minima` int(11) DEFAULT NULL,
  `abertura` datetime DEFAULT NULL,
  `fechamento` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'dolorum','repellendus','1410065408',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:24','2016-07-03 21:40:24'),(2,'rem','est','1410065408',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:24','2016-07-03 21:40:24'),(3,'est','sed','1410065408',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-03 21:40:24','2016-07-03 21:40:24');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2016_07_01_000000_create_empresas_table',1),('2016_07_01_100000_create_users_table',1),('2016_07_01_200000_create_password_resets_table',1),('2016_07_01_300000_create_categorias_table',1),('2016_07_02_193035_create_produtos_table',1),('2016_07_02_193056_create_tamanhos_table',1),('2016_07_02_220950_create_clientes_table',1),('2016_07_03_034131_create_pedidos_table',1),('2016_07_03_034217_create_pedidos_itens_table',1),('2016_07_03_041401_create_componentes_table',1),('2016_07_03_041421_create_produto_itens_table',1),('2016_07_03_041515_create_produto_item_pedidos_table',1),('2016_07_03_182445_create_cache_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_items`
--

DROP TABLE IF EXISTS `pedido_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` int(10) unsigned NOT NULL,
  `pedido_id` int(10) unsigned NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `qtd` smallint(6) NOT NULL,
  `meia` smallint(6) DEFAULT NULL,
  `obs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pedido_items_produto_id_foreign` (`produto_id`),
  KEY `pedido_items_pedido_id_foreign` (`pedido_id`),
  CONSTRAINT `pedido_items_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedido_items_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_items`
--

LOCK TABLES `pedido_items` WRITE;
/*!40000 ALTER TABLE `pedido_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(10) unsigned NOT NULL,
  `cliente_id` int(10) unsigned NOT NULL,
  `usuario_entregador_id` int(10) unsigned DEFAULT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `retirada` smallint(6) NOT NULL,
  `pagamento` smallint(6) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pedidos_empresa_id_foreign` (`empresa_id`),
  KEY `pedidos_cliente_id_foreign` (`cliente_id`),
  KEY `pedidos_usuario_entregador_id_foreign` (`usuario_entregador_id`),
  CONSTRAINT `pedidos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `pedidos_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `pedidos_usuario_entregador_id_foreign` FOREIGN KEY (`usuario_entregador_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_item_pedidos`
--

DROP TABLE IF EXISTS `produto_item_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_item_pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_item_id` int(10) unsigned NOT NULL,
  `componente_id` int(10) unsigned NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `produto_item_pedidos_pedido_item_id_foreign` (`pedido_item_id`),
  KEY `produto_item_pedidos_componente_id_foreign` (`componente_id`),
  CONSTRAINT `produto_item_pedidos_componente_id_foreign` FOREIGN KEY (`componente_id`) REFERENCES `componentes` (`id`),
  CONSTRAINT `produto_item_pedidos_pedido_item_id_foreign` FOREIGN KEY (`pedido_item_id`) REFERENCES `pedido_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_item_pedidos`
--

LOCK TABLES `produto_item_pedidos` WRITE;
/*!40000 ALTER TABLE `produto_item_pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_item_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_items`
--

DROP TABLE IF EXISTS `produto_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` int(10) unsigned NOT NULL,
  `componente_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `produto_items_produto_id_foreign` (`produto_id`),
  KEY `produto_items_componente_id_foreign` (`componente_id`),
  CONSTRAINT `produto_items_componente_id_foreign` FOREIGN KEY (`componente_id`) REFERENCES `componentes` (`id`),
  CONSTRAINT `produto_items_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_items`
--

LOCK TABLES `produto_items` WRITE;
/*!40000 ALTER TABLE `produto_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria_id` int(10) unsigned NOT NULL,
  `empresa_id` int(10) unsigned NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `imagem` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `produtos_categoria_id_foreign` (`categoria_id`),
  KEY `produtos_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `produtos_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,3,1,'qui','Similique ipsum rerum fugit.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(2,4,1,'perferendis','Ex magni laborum dicta ducimus itaque nihil eaque.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(3,10,2,'itaque','Reiciendis eligendi iure debitis.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(4,8,1,'veritatis','Aut laboriosam et at vitae.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(5,3,3,'et','Omnis aut exercitationem et quisquam quo illo temporibus a.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(6,3,2,'tenetur','Quis iste eius sed.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(7,4,2,'dignissimos','Eos repudiandae ipsum alias aut.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(8,9,3,'saepe','Nesciunt error porro vel doloribus sapiente fugiat sint facere.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(9,8,3,'sed','Provident sequi dolores qui necessitatibus nulla et sed.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(10,7,2,'laborum','Occaecati omnis quia magni dolores ab enim.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(11,3,1,'fugit','Autem atque libero mollitia ipsa quisquam qui excepturi.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(12,5,1,'quo','Non aperiam necessitatibus distinctio impedit.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(13,1,3,'ullam','Velit aut vel rerum itaque.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(14,4,2,'et','Deserunt optio molestias et asperiores cumque quia.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(15,9,3,'quisquam','Molestiae rerum dolor suscipit commodi consectetur voluptatem voluptate.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(16,4,3,'commodi','Temporibus dolores sunt excepturi vero voluptatem dolorum neque.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(17,4,1,'laboriosam','Sapiente ut voluptates et et.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(18,8,2,'cumque','Voluptas fuga ut rerum quia eius ut.',NULL,'2016-07-03 21:40:26','2016-07-03 21:40:26'),(19,1,2,'quia','Laudantium omnis et excepturi minima amet nobis dolores.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(20,8,1,'laudantium','Et nobis voluptas aut in mollitia.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(21,8,2,'qui','Tempore vel omnis nihil recusandae qui inventore commodi.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(22,8,1,'quidem','Veritatis temporibus dolor dolores laudantium delectus id ducimus.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(23,9,1,'qui','Delectus vel cum aut enim.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(24,2,3,'deserunt','Assumenda reiciendis voluptatem aut eaque.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(25,4,1,'aliquam','Cumque sint eos rerum ullam doloremque autem.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(26,3,2,'eveniet','Maiores blanditiis aut modi totam.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(27,7,3,'occaecati','Velit saepe repudiandae delectus atque quisquam.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(28,10,1,'enim','Ea soluta hic voluptas.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(29,3,1,'aperiam','Debitis laborum est harum accusantium non numquam.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(30,5,2,'esse','Cumque fugit rerum amet sit eum enim enim.',NULL,'2016-07-03 21:40:27','2016-07-03 21:40:27');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tamanhos`
--

DROP TABLE IF EXISTS `tamanhos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tamanhos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produto_id` int(10) unsigned NOT NULL,
  `tamanho` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tamanhos_produto_id_foreign` (`produto_id`),
  CONSTRAINT `tamanhos_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tamanhos`
--

LOCK TABLES `tamanhos` WRITE;
/*!40000 ALTER TABLE `tamanhos` DISABLE KEYS */;
INSERT INTO `tamanhos` VALUES (1,1,'',18.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(2,1,'',49.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(3,1,'',33.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(4,2,'',32.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(5,2,'',36.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(6,2,'',10.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(7,3,'',13.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(8,3,'',31.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(9,3,'',41.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(10,4,'',34.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(11,4,'',27.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(12,4,'',11.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(13,5,'',29.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(14,5,'',29.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(15,5,'',21.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(16,6,'',16.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(17,6,'',24.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(18,6,'',45.00,'2016-07-03 21:40:27','2016-07-03 21:40:27'),(19,7,'',34.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(20,7,'',26.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(21,7,'',25.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(22,8,'',33.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(23,8,'',47.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(24,8,'',46.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(25,9,'',49.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(26,9,'',48.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(27,9,'',33.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(28,10,'',34.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(29,10,'',25.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(30,10,'',40.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(31,11,'',31.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(32,11,'',28.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(33,11,'',30.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(34,12,'',20.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(35,12,'',14.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(36,12,'',43.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(37,13,'',12.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(38,13,'',15.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(39,13,'',21.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(40,14,'',16.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(41,14,'',25.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(42,14,'',20.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(43,15,'',28.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(44,15,'',44.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(45,15,'',39.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(46,16,'',39.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(47,16,'',31.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(48,16,'',20.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(49,17,'',27.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(50,17,'',35.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(51,17,'',18.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(52,18,'',29.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(53,18,'',37.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(54,18,'',35.00,'2016-07-03 21:40:28','2016-07-03 21:40:28'),(55,19,'',28.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(56,19,'',19.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(57,19,'',11.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(58,20,'',45.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(59,20,'',45.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(60,20,'',20.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(61,21,'',20.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(62,21,'',12.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(63,21,'',40.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(64,22,'',22.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(65,22,'',33.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(66,22,'',13.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(67,23,'',45.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(68,23,'',42.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(69,23,'',23.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(70,24,'',23.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(71,24,'',13.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(72,24,'',40.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(73,25,'',25.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(74,25,'',21.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(75,25,'',27.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(76,26,'',29.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(77,26,'',38.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(78,26,'',26.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(79,27,'',20.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(80,27,'',19.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(81,27,'',14.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(82,28,'',19.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(83,28,'',42.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(84,28,'',17.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(85,29,'',11.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(86,29,'',25.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(87,29,'',26.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(88,30,'',16.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(89,30,'',13.00,'2016-07-03 21:40:29','2016-07-03 21:40:29'),(90,30,'',37.00,'2016-07-03 21:40:29','2016-07-03 21:40:29');
/*!40000 ALTER TABLE `tamanhos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(10) unsigned NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cliente',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  KEY `usuarios_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `usuarios_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,3,'Prof. Golda Keeling','hollie11@example.com','$2y$10$8ZbtmsbZ2R9L.o0aJkrtNu1GFQXchcJiDR73Wfe1lSpPQdGiLreHu','cliente','XAkigDVjbO','2016-07-03 21:40:25','2016-07-03 21:40:25'),(2,3,'Hulda Goldner','ila41@example.com','$2y$10$.RMGpP0yxiy76SVUOzrY1ucekt0U5MPcnYoBLLZIUUGw4vxPxa3Ti','cliente','WOEBebfAg8','2016-07-03 21:40:25','2016-07-03 21:40:25'),(3,1,'Enrique Price','archibald.schowalter@example.org','$2y$10$BAlXyI797cefQ2YS2YGEMO2yZcGogDdQ/J4dzVB1baffr6Tm9mHKW','cliente','IlRKMGjJws','2016-07-03 21:40:25','2016-07-03 21:40:25'),(4,2,'Gabe Jacobi MD','chanelle.cronin@example.net','$2y$10$Fo6Y6s3kNjpKDbdQnK7IG.rEj7fnMKXgPMkywwRynq8w3agnVhlSa','cliente','FPnkRUYfJh','2016-07-03 21:40:25','2016-07-03 21:40:25'),(5,2,'Prof. Marlen Leffler MD','may.morar@example.com','$2y$10$ummoAUNjy3v428BX6lRPEub9IPSEo0Xl5injXrt27BpKTCe1zeyBa','cliente','QxuAmDAlPz','2016-07-03 21:40:25','2016-07-03 21:40:25'),(6,2,'Oswald Strosin','yschuppe@example.org','$2y$10$Mf4yXp2zOFVk/C8nN/MgJ.opdnQQMCQTriVmTUMBndMqWWvj4/WXi','cliente','ZLNPnmLG9I','2016-07-03 21:40:25','2016-07-03 21:40:25'),(7,2,'Ephraim Lakin','macie.rau@example.net','$2y$10$/ZhOmmQWiZi45U6yHw7x7OYCiz664IUbMZxZRjvO8iAoRxPbByRDu','cliente','WC2C6HF2XA','2016-07-03 21:40:25','2016-07-03 21:40:25'),(8,2,'Porter Cruickshank','srobel@example.net','$2y$10$b5k8jzdP5lkcplXZMQnX0uOWOggpt/8FRxw.KTrFv6EmncC0Ke.wO','cliente','ACIjruMTJJ','2016-07-03 21:40:25','2016-07-03 21:40:25'),(9,3,'Elmira Roob II','ekeeling@example.com','$2y$10$oDiXr9P4FGlm2mryU0SzIuQynbxX9BWa2ibFoBuAv3C.tMUqNx8PW','cliente','Vs99LxbTrk','2016-07-03 21:40:26','2016-07-03 21:40:26'),(10,1,'Prof. Rhea Goodwin','seth.feil@example.com','$2y$10$YY0.TksXjz//InGE3Bj1OeH2z7pL8AOkVFfvCf1ps6PFc9haqvse.','cliente','IhEV0f5nKo','2016-07-03 21:40:26','2016-07-03 21:40:26');
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

-- Dump completed on 2016-07-06  2:26:33
