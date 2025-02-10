-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: sysprestamos
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('740180680ff36eb1cd1225835f4fbeee','i:1;',1739189853),('740180680ff36eb1cd1225835f4fbeee:timer','i:1739189853;',1739189853);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nro_documento` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `ref_celular` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'325324','carlos','alonzo','2025-02-09','MASCULINO','carlos@gmail.com','543543','45435','2025-02-10 07:49:49','2025-02-10 07:49:49');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracions`
--

DROP TABLE IF EXISTS `configuracions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL,
  `moneda` varchar(255) NOT NULL,
  `redes_sociales` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `configuracions_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracions`
--

LOCK TABLES `configuracions` WRITE;
/*!40000 ALTER TABLE `configuracions` DISABLE KEYS */;
INSERT INTO `configuracions` VALUES (1,'uab','universidad','por el mamore','75344723','uab@beni.comahhd','https://milton.com','bs',NULL,'logos/LVywOo03Oi0kWLdt1xLaMUYh2fZqXtWzihKfssVA.jpg','2025-02-10 07:49:10','2025-02-10 07:49:10');
/*!40000 ALTER TABLE `configuracions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"f85cbcbc-0f15-4768-b839-51df8785aa86\",\"displayName\":\"backup:run --only-db\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Foundation\\\\Console\\\\QueuedCommand\",\"command\":\"O:43:\\\"Illuminate\\\\Foundation\\\\Console\\\\QueuedCommand\\\":10:{s:7:\\\"\\u0000*\\u0000data\\\";a:1:{i:0;s:20:\\\"backup:run --only-db\\\";}s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;}\"}}',0,NULL,1738867497,1738867497);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_10_10_160315_add_two_factor_columns_to_users_table',1),(5,'2024_10_10_160358_create_personal_access_tokens_table',1),(6,'2024_10_11_131225_add_campos_to_users',1),(7,'2025_01_21_172446_create_configuracions_table',1),(8,'2025_01_24_195738_create_permission_tables',1),(9,'2025_01_26_003808_create_clientes_table',1),(10,'2025_01_27_033338_create_prestamos_table',1),(11,'2025_01_27_041223_create_pagos_table',1),(12,'2025_02_04_054235_create_notificacions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacions`
--

DROP TABLE IF EXISTS `notificacions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacions`
--

LOCK TABLES `notificacions` WRITE;
/*!40000 ALTER TABLE `notificacions` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prestamo_id` bigint(20) unsigned NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  `metodo_pago` enum('Efectivo','Transferencia','Tarjeta','Cheque') NOT NULL,
  `referencia_pago` varchar(255) NOT NULL,
  `estado` enum('Pendiente','Confirmado','Fallido') NOT NULL,
  `fecha_cancelado` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagos_prestamo_id_foreign` (`prestamo_id`),
  CONSTRAINT `pagos_prestamo_id_foreign` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,1,900.00,'2025-03-10','Efectivo','Pago de la cuota 1','Confirmado','2025-02-10','2025-02-10 07:50:37','2025-02-10 07:51:30'),(2,1,900.00,'2025-04-10','Efectivo','Pago de la cuota 2','Confirmado','2025-02-10','2025-02-10 07:50:37','2025-02-10 07:51:40'),(3,1,900.00,'2025-05-10','Efectivo','Pago de la cuota 3','Confirmado','2025-02-10','2025-02-10 07:50:37','2025-02-10 07:51:46'),(4,1,900.00,'2025-06-10','Efectivo','Pago de la cuota 4','Confirmado','2025-02-10','2025-02-10 07:50:37','2025-02-10 08:24:42'),(5,1,900.00,'2025-07-10','Efectivo','Pago de la cuota 5','Confirmado','2025-02-10','2025-02-10 07:50:37','2025-02-10 08:24:48'),(6,2,201.92,'2025-02-17','Efectivo','Pago de la cuota 1','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(7,2,201.92,'2025-02-24','Efectivo','Pago de la cuota 2','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(8,2,201.92,'2025-03-03','Efectivo','Pago de la cuota 3','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(9,2,201.92,'2025-03-10','Efectivo','Pago de la cuota 4','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(10,2,201.92,'2025-03-17','Efectivo','Pago de la cuota 5','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(11,2,201.92,'2025-03-24','Efectivo','Pago de la cuota 6','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(12,2,201.92,'2025-03-31','Efectivo','Pago de la cuota 7','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(13,2,201.92,'2025-04-07','Efectivo','Pago de la cuota 8','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(14,2,201.92,'2025-04-14','Efectivo','Pago de la cuota 9','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33'),(15,2,201.92,'2025-04-21','Efectivo','Pago de la cuota 10','Pendiente',NULL,'2025-02-10 08:44:33','2025-02-10 08:44:33');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'admin.configuracion.index','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(2,'admin.configuracion.create','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(3,'admin.configuracion.store','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(4,'admin.configuracion.show','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(5,'admin.configuracion.edit','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(6,'admin.configuracion.update','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(7,'admin.configuracion.destroy','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(8,'admin.roles.index','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(9,'admin.roles.create','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(10,'admin.roles.store','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(11,'admin.roles.show','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(12,'admin.roles.asignarPermisos','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(13,'admin.roles.updateAsignar','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(14,'admin.roles.edit','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(15,'admin.roles.update','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(16,'admin.roles.destroy','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(17,'admin.usuarios.index','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(18,'admin.usuarios.create','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(19,'admin.usuarios.store','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(20,'admin.usuarios.show','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(21,'admin.usuarios.edit','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(22,'admin.usuarios.update','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(23,'admin.usuarios.destroy','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(24,'admin.clientes.index','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(25,'admin.clientes.create','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(26,'admin.clientes.store','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(27,'admin.clientes.show','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(28,'admin.clientes.edit','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(29,'admin.clientes.update','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(30,'admin.clientes.destroy','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(31,'admin.prestamos.index','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(32,'admin.prestamos.create','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(33,'admin.prestamos.cliente.obtenerCliente','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(34,'admin.prestamos.store','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(35,'admin.prestamos.show','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(36,'admin.prestamos.contratos','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(37,'admin.prestamos.edit','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(38,'admin.prestamos.update','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(39,'admin.prestamos.destroy','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(40,'admin.pagos.index','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(41,'admin.pagos.CargarPrestamosCliente','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(42,'admin.pagos.create','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(43,'admin.pagos.store','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(44,'admin.pagos.comprobantedepago','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(45,'admin.pagos.show','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(46,'admin.pagos.edit','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(47,'admin.pagos.update','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(48,'admin.pagos.destroy','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(49,'admin.notificaciones.index','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(50,'admin.notificaciones.notificar','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(51,'admin.backups.index','web','2025-02-06 20:53:17','2025-02-06 20:53:17'),(52,'admin.backups.create','web','2025-02-06 20:53:17','2025-02-06 20:53:17');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint(20) unsigned NOT NULL,
  `monto_prestado` decimal(10,2) NOT NULL,
  `tasa_interes` decimal(10,2) NOT NULL,
  `modalidad` enum('Diario','Semanal','Quincenal','Mensual') NOT NULL,
  `nro_cuotas` int(11) NOT NULL,
  `monto_total` decimal(12,2) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `estado` enum('Pendiente','Pagado','Cancelado') NOT NULL DEFAULT 'Pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prestamos_cliente_id_foreign` (`cliente_id`),
  CONSTRAINT `prestamos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamos`
--

LOCK TABLES `prestamos` WRITE;
/*!40000 ALTER TABLE `prestamos` DISABLE KEYS */;
INSERT INTO `prestamos` VALUES (1,1,3000.00,10.00,'Mensual',5,4500.00,'2025-02-10','Cancelado','2025-02-10 07:50:37','2025-02-10 08:24:48'),(2,1,2000.00,5.00,'Semanal',10,2019.23,'2025-02-10','Pendiente','2025-02-10 08:44:33','2025-02-10 08:44:33');
/*!40000 ALTER TABLE `prestamos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','web','2025-02-06 20:53:16','2025-02-06 20:53:16'),(2,'PRESTAMOS','web','2025-02-10 07:00:22','2025-02-10 07:00:22'),(3,'ENCARGADO','web','2025-02-10 07:03:01','2025-02-10 07:03:01');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('eKpBiPmemMCTmVjXFb9KEk3PIA7e6adl8groF4ya',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZVFYVFVkd3Fyd2N0YXI3S1ZGS01VM2JKdXlQYzZBWHJ4ckVYUkxjWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iYWNrdXBzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1739194856);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `google_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'milton','milton@gmail.com',NULL,'$2y$12$.RUUCybCM2udqwct8qtyze/YhIVhCz53qWXMivW20I.gMlnkMOHS2',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-06 20:53:17','2025-02-06 20:53:17',NULL,NULL),(2,'jaimito','jaimito@gmail.com',NULL,'$2y$12$tXNxD4b322n3UbhnXtJ0Oex0Z0hHdnKEDQUALZx0GHfQAi.YEIdK.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-10 07:14:17','2025-02-10 07:14:17',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-10  9:46:28
