-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: expense_tracker
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.2

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
-- Table structure for table `bank_accounts`
--

DROP TABLE IF EXISTS `bank_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starting_balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_accounts`
--

LOCK TABLES `bank_accounts` WRITE;
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
INSERT INTO `bank_accounts` VALUES (1,1,'ANZ BANK ACCOUNT','ANZ',10715.89,9930.71,'2017-06-14 11:04:27','2017-06-14 12:03:03');
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tag_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_tag_id_foreign` (`tag_id`),
  KEY `categories_user_id_foreign` (`user_id`),
  CONSTRAINT `categories_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE SET NULL,
  CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Paycheck','My salary',1,1,'2017-06-02 14:48:58','2017-06-02 14:48:58'),(2,'Bonus','My Bonus',1,1,'2017-06-02 14:49:18','2017-06-02 14:49:18'),(3,'Interest Earned','Interest on bank accounts',1,1,'2017-06-02 14:49:47','2017-06-02 14:49:47'),(4,'Guitar Lessons','Guitar Lessons',1,1,'2017-06-02 14:50:22','2017-06-02 14:50:22'),(5,'Gasoline','Car gasoline expenses',2,1,'2017-06-02 14:51:07','2017-06-02 14:51:07'),(6,'Automobile Maintenance','Automobile maintenance',2,1,'2017-06-02 14:51:40','2017-06-02 14:51:40'),(7,'Automobile Registration Fees','Registration fees',2,1,'2017-06-02 14:52:11','2017-06-02 14:52:11'),(8,'Bank Charges','Bank charges',2,1,'2017-06-02 14:52:42','2017-06-02 14:52:42'),(9,'Clothing','New clothing',2,1,'2017-06-02 14:53:05','2017-06-02 14:53:05'),(10,'Events','Events',2,1,'2017-06-02 14:53:36','2017-06-02 14:53:36'),(11,'Groceries','Groceries',2,1,'2017-06-02 14:54:13','2017-06-02 14:54:13'),(12,'Eating Out','Eating out',2,1,'2017-06-02 14:54:34','2017-06-02 14:54:34'),(13,'Vending Machines','Vending Machines',2,1,'2017-06-02 14:54:57','2017-06-02 14:54:57'),(14,'Gifts','Gifts',2,1,'2017-06-02 14:55:15','2017-06-02 14:55:15'),(15,'Rent','My rent',2,1,'2017-06-02 14:55:46','2017-06-02 14:55:46'),(16,'Furniture','Furniture',2,1,'2017-06-02 14:56:09','2017-06-02 14:56:09'),(17,'Household Supplies','Household supplies',2,1,'2017-06-02 14:57:01','2017-06-02 14:57:01'),(18,'Car Insurance','Car insurance',2,1,'2017-06-02 14:57:21','2017-06-02 14:57:21'),(19,'Health Insurance','Health Insurance',2,1,'2017-06-02 14:57:47','2017-06-02 14:57:47'),(20,'Books','Books',2,1,'2017-06-02 14:58:06','2017-06-02 14:58:06'),(21,'Movie Theater','Movies',2,1,'2017-06-02 14:58:23','2017-06-02 14:58:23'),(22,'Income Tax','Taxes',2,1,'2017-06-02 14:58:56','2017-06-02 14:58:56'),(23,'Water Bill','Utilities',2,1,'2017-06-02 14:59:25','2017-06-02 14:59:25'),(24,'Electricity Bill','Utilities',2,1,'2017-06-02 14:59:42','2017-06-02 14:59:42'),(25,'Gas Bill','Utilities',2,1,'2017-06-02 15:00:10','2017-06-02 15:00:10'),(26,'Internet','Utilities',2,1,'2017-06-02 15:00:31','2017-06-02 15:00:31'),(27,'Public Transportation','Transportation',2,1,'2017-06-02 15:00:59','2017-06-02 15:00:59'),(28,'Gym Membership','Membership in gym',2,1,'2017-06-04 08:29:25','2017-06-04 08:29:25'),(29,'Superannuation','Superannuation',1,1,'2017-06-06 21:00:27','2017-06-06 21:18:36'),(30,'Vacation','Vacation/Leisure',2,1,'2017-06-14 11:44:03','2017-06-14 11:44:03');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `bank_account_id` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_category_id_foreign` (`category_id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  KEY `expenses_bank_account_id_foreign` (`bank_account_id`),
  CONSTRAINT `expenses_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'Coles Shopping','Coles West End Grocery shopping',11,1,1,'2017-06-02',29.55,'2017-06-02 15:04:48','2017-06-14 11:04:40'),(2,'Brunch West End','Brunch at West End with Lina after she got her car.',12,1,1,'2017-06-03',36.50,'2017-06-03 03:38:39','2017-06-14 11:37:50'),(3,'Coles Shopping','Groceries from Coles.',11,1,1,'2017-06-03',30.39,'2017-06-03 08:06:33','2017-06-14 11:37:35'),(4,'Coles Shopping','Coles Shopping',11,1,1,'2017-06-04',24.46,'2017-06-04 08:25:40','2017-06-14 11:37:23'),(5,'Shopping','Two pants from Zara',9,1,1,'2017-06-04',79.90,'2017-06-04 08:27:15','2017-06-14 11:37:02'),(6,'Snap Fitness','Fortnightly membership',28,1,1,'2017-06-02',31.15,'2017-06-04 08:30:24','2017-06-14 11:35:24'),(7,'Translink','Go Card auto top-up',27,1,1,'2017-06-05',20.00,'2017-06-05 19:16:12','2017-06-14 11:06:16'),(8,'Guitar','Lina half size guitar',14,1,1,'2017-06-06',89.00,'2017-06-06 11:24:21','2017-06-14 11:05:49'),(9,'Dinner','Shabu House buffet. New car and job celebration.',12,1,1,'2017-06-06',65.80,'2017-06-06 11:25:58','2017-06-14 11:05:36'),(10,'Coles Shopping','Coles shopping',11,1,1,'2017-06-07',24.49,'2017-06-07 08:26:28','2017-06-14 11:05:27'),(11,'Debit Interest Charge','ANZ debit interest charge',8,1,1,'2017-06-08',0.01,'2017-06-09 09:28:31','2017-06-14 11:05:19'),(12,'Coles Shopping','Coles Shopping for Moreton island trip',11,1,1,'2017-06-09',31.08,'2017-06-09 09:29:22','2017-06-14 11:05:09'),(13,'Origin Energy Gas Bill','Gas Bill to Origin Energy',25,1,1,'2017-06-08',116.91,'2017-06-09 09:30:07','2017-06-14 11:04:57'),(14,'Tangalooma Parking','Park Lina\'s Car at Tangalooma',30,1,1,'2017-06-10',30.00,'2017-06-14 11:44:58','2017-06-14 11:44:58'),(15,'Tangalooma Whale Watching','Whale watching at Moreton Island',30,1,1,'2017-06-10',112.50,'2017-06-14 11:45:58','2017-06-14 11:45:58'),(16,'Tangalooma Kayaking','Kayaking',30,1,1,'2017-06-11',50.00,'2017-06-14 11:47:45','2017-06-14 11:47:45'),(17,'OKCupid Subscription','Forgotten subscription',5,1,1,'2017-06-11',28.44,'2017-06-14 11:48:50','2017-06-14 11:48:50'),(18,'Translink','Translink auto top-up',27,1,1,'2017-06-14',20.00,'2017-06-14 11:50:26','2017-06-14 11:50:26');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `income`
--

DROP TABLE IF EXISTS `income`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `income` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `bank_account_id` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_category_id_foreign` (`category_id`),
  KEY `income_user_id_foreign` (`user_id`),
  KEY `income_bank_account_id_foreign` (`bank_account_id`),
  CONSTRAINT `income_bank_account_id_foreign` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `income_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `income_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `income`
--

LOCK TABLES `income` WRITE;
/*!40000 ALTER TABLE `income` DISABLE KEYS */;
INSERT INTO `income` VALUES (1,'Invoice 17','Start Creative Salary',1,1,NULL,'2017-06-02',2000.00,'2017-06-02 15:05:39','2017-06-06 20:58:03'),(2,'Invoice 18','Last Invoice',1,1,NULL,'2017-06-13',600.00,'2017-06-06 20:59:24','2017-06-06 20:59:24'),(3,'Week 1 - Salary','$23/hr',1,1,NULL,'2017-06-21',874.00,'2017-06-06 21:21:24','2017-06-06 21:21:24'),(4,'Week 2 - Salary','$23/hr',1,1,NULL,'2017-06-28',874.00,'2017-06-06 21:21:57','2017-06-06 21:21:57'),(5,'Week 1 - Super','9.5% superannuation',29,1,NULL,'2017-06-21',83.03,'2017-06-06 21:23:50','2017-06-06 21:23:50'),(6,'Week 2 - Super','9.5% superannuation',29,1,NULL,'2017-06-28',83.03,'2017-06-06 21:24:17','2017-06-06 21:24:17'),(7,'Week 3 - Salary','$23/hr',1,1,NULL,'2017-07-05',874.00,'2017-06-06 21:25:34','2017-06-06 21:25:49'),(8,'Week 4 - Salary','$23/hr',1,1,NULL,'2017-07-12',874.00,'2017-06-06 21:26:33','2017-06-06 21:26:33'),(9,'Week 5 - Salary','$23/hr',1,1,NULL,'2017-07-19',874.00,'2017-06-06 21:27:18','2017-06-06 21:27:18'),(10,'Week 6 - Salary','$23/hr',1,1,NULL,'2017-07-26',874.00,'2017-06-06 21:27:48','2017-06-06 21:27:48'),(11,'Week 3 - Super','9.5% superannuation',29,1,NULL,'2017-07-05',83.03,'2017-06-06 21:29:04','2017-06-06 21:29:04'),(12,'Week 4 - Super','9.5% superannuation',29,1,NULL,'2017-07-12',83.03,'2017-06-06 21:29:29','2017-06-06 21:29:29'),(13,'Week 5 - Super','9.5% superannuation',29,1,NULL,'2017-07-19',83.03,'2017-06-06 21:29:58','2017-06-06 21:29:58'),(14,'Week 6 - Super','9.5% superannuation',29,1,NULL,'2017-07-26',83.03,'2017-06-06 21:30:22','2017-06-06 21:30:22'),(15,'Guitar Lesson','Ruth guitar lesson 1',4,1,1,'2017-06-12',35.00,'2017-06-14 11:39:38','2017-06-14 11:39:38');
/*!40000 ALTER TABLE `income` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_04_02_043053_create_table_tags',1),(4,'2017_04_02_050001_create_categories_table',1),(5,'2017_04_02_050120_create_expenses_table',1),(6,'2017_04_02_050209_create_income_table',1),(7,'2017_06_07_044406_create_profiles_table',1),(8,'2017_06_12_172923_create_bank_accounts_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Nizar','El Berjawi','Web Developer','2017-06-14',424296755,1,'2017-06-14 11:04:08','2017-06-14 11:04:08');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Income','2017-06-14 10:54:37','2017-06-14 10:54:37'),(2,'Expenses','2017-06-14 10:54:37','2017-06-14 10:54:37');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nizar El Berjawi','nizarberjawi12@gmail.com','$2y$10$tDu5pD1AUPIf.5qlYsQiU.nO8GkldhUNornBtqIbUJY9xXwp.h8s6','B6KEJIXievBKAyZcOgT2BBiYUeSbeobXwPTdltCQdN4VorvkIyaVDPfTgV5G','2017-06-02 14:47:23','2017-06-02 14:47:23');
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

-- Dump completed on 2017-06-14 19:21:15
