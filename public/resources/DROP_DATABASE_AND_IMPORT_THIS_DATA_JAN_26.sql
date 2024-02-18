CREATE DATABASE  IF NOT EXISTS `test_epasal_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `test_epasal_db`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: test_epasal_db
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `tbl_addresses`
--

DROP TABLE IF EXISTS `tbl_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_addresses` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `province` enum('Bagmati','Gandaki','Karnali','Koshi','Lumbini','Madhesh','Sudurpashchim') DEFAULT 'Bagmati',
  `city` enum('Kathmandu','Lalitpur','Bhaktapur') DEFAULT 'Kathmandu',
  `address` varchar(255) NOT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_addresses`
--

LOCK TABLES `tbl_addresses` WRITE;
/*!40000 ALTER TABLE `tbl_addresses` DISABLE KEYS */;
INSERT INTO `tbl_addresses` VALUES (1,'Bagmati','Kathmandu','123 Main Street','Near the park','First address in Kathmandu'),(2,'Gandaki','Bhaktapur','456 Hill Road','Opposite the lake','Scenic view location'),(3,'Karnali','Kathmandu','789 Valley Avenue','Next to the market','Central location in Kathmandu'),(4,'Koshi','Lalitpur','101 River Lane','Behind the school','Quiet residential area'),(5,'Lumbini','Kathmandu','234 Peace Street','Close to the temple','Religious area'),(6,'Madhesh','Bhaktapur','567 Garden Road','Beside the hospital','Green surroundings'),(7,'Sudurpashchim','Lalitpur','890 Sunset Boulevard','Near the stadium','Vibrant sports community'),(8,'Bagmati','Kathmandu','321 Hillside Drive','Adjacent to the mall','Shopping district'),(9,'Gandaki','Lalitpur','654 Lakeside Lane','Walkable to the market','Tourist-friendly area'),(10,'Karnali','Bhaktapur','987 Forest Street','By the riverbank','Nature lovers paradise'),(11,'Koshi','Kathmandu','876 Sunshine Avenue','Close to the university','Educational hub'),(12,'Lumbini','Lalitpur','543 Heritage Road','Historical neighborhood','Preservation area'),(13,'Madhesh','Bhaktapur','210 Commerce Street','Business district','Industrial hub'),(14,'Sudurpashchim','Kathmandu','789 Desert Drive','Amidst the dunes','Unique desert location'),(15,'Bagmati','Lalitpur','432 Artisan Lane','Artistic community','Creative neighborhood'),(16,'Gandaki','Kathmandu','765 Fortress Road','Next to the fortress','Historic location'),(17,'Karnali','Lalitpur','876 Highland Avenue','Mountainous terrain','Adventure seekers spot'),(18,'Koshi','Bhaktapur','543 Sunrise Street','Early morning charm','Residential area'),(19,'Lumbini','Kathmandu','210 Riverbank Drive','By the river','Tranquil riverside location'),(20,'Madhesh','Lalitpur','987 Harmony Lane','Peaceful surroundings','Harmonious community'),(21,'Bagmati','Kathmandu','Baneshwor','test','test'),(22,'Bagmati','Kathmandu','Baneshwor','test','test'),(23,'Bagmati','Kathmandu','Baneshwor','test','test'),(24,'Bagmati','Kathmandu','Baneshwor','test','test'),(25,'Bagmati','Kathmandu','Kalanki','test','test'),(26,'Bagmati','Kathmandu','Kalanki','test','test'),(27,'Bagmati','Kathmandu','Kalanki','test','test'),(28,'Bagmati','Kathmandu','Kalanki','test','test'),(29,'Bagmati','Kathmandu','Baneshwor',' ',' '),(30,'Bagmati','Kathmandu','Baneshwor','testt','test'),(31,'Bagmati','Kathmandu','Baneshwor','test','test'),(32,'Bagmati','Kathmandu','Baneshwor','test','test'),(34,'Bagmati','Kathmandu','Baneshwor','test','test'),(35,'Bagmati','Kathmandu','Kalanki','testtes','test'),(36,'Bagmati','Kathmandu','Dhumbarahi','Shanti Marg, Apex Building','Library aaunu hai ma tehi hhunxu'),(47,'Bagmati','Kathmandu','Kalanki','Kalanki Temple','At Ncell Centre.'),(48,'Bagmati','Kathmandu','Kalanki','Kalanki Temple','At Ncell Centre.'),(49,'Bagmati','Kathmandu','Kalanki','Kalanki Temple','At Ncell Centre.'),(50,'Bagmati','Kathmandu','Kalanki','Kalanki Temple','Call you at Pasal'),(51,'Bagmati','Kathmandu','Kalanki','Kalanki Temple','Kalanki mandir ko tree nira aaunu.');
/*!40000 ALTER TABLE `tbl_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categories`
--

DROP TABLE IF EXISTS `tbl_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categories`
--

LOCK TABLES `tbl_categories` WRITE;
/*!40000 ALTER TABLE `tbl_categories` DISABLE KEYS */;
INSERT INTO `tbl_categories` VALUES (2,'Beef'),(1,'Chicken'),(8,'Dissert'),(6,'Juice'),(5,'Snacks'),(7,'Soft Drinks'),(4,'Sweets & Deserts'),(3,'Veg');
/*!40000 ALTER TABLE `tbl_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order_details`
--

DROP TABLE IF EXISTS `tbl_order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order_details` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`order_id`),
  CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order_details`
--

LOCK TABLES `tbl_order_details` WRITE;
/*!40000 ALTER TABLE `tbl_order_details` DISABLE KEYS */;
INSERT INTO `tbl_order_details` VALUES (9,47,1,1,NULL),(10,47,2,3,NULL),(11,47,7,1,NULL),(12,48,1,1,NULL),(13,48,2,3,NULL),(14,48,7,1,NULL),(15,49,1,1,NULL),(16,49,2,3,NULL),(17,49,7,1,NULL),(18,50,2,1,NULL),(19,50,3,1,NULL),(20,51,19,1,NULL),(21,51,20,1,NULL);
/*!40000 ALTER TABLE `tbl_order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `order_status` enum('Pending','Processing','Packaging','Out for Delivery','Completed','Cancelled') DEFAULT 'Pending',
  `payment_method` enum('Khalti','COD') DEFAULT 'COD',
  `payment_status` enum('Paid','Unpaid') DEFAULT 'Unpaid',
  `total_amount` decimal(10,2) DEFAULT NULL,
  `address_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`),
  CONSTRAINT `tbl_orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `tbl_addresses` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orders`
--

LOCK TABLES `tbl_orders` WRITE;
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;
INSERT INTO `tbl_orders` VALUES (47,1,'Completed','COD','Paid',58.00,47,'2024-01-21 13:27:38'),(48,1,'Completed','COD','Paid',58.00,48,'2024-01-21 13:29:35'),(49,1,'Completed','COD','Paid',58.00,49,'2024-01-21 13:31:45'),(50,1,'Completed','COD','Paid',30.00,50,'2024-01-21 13:32:29'),(51,1,'Completed','COD','Paid',11.99,51,'2024-01-26 09:07:01');
/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_photo_url` varchar(255) NOT NULL,
  `product_description` varchar(512) NOT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`),
  CONSTRAINT `tbl_products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_products`
--

LOCK TABLES `tbl_products` WRITE;
/*!40000 ALTER TABLE `tbl_products` DISABLE KEYS */;
INSERT INTO `tbl_products` VALUES (1,'Spicy Chicken','public/img/products/biryani.jpg','Delicious and spicy chicken curry made with authentic spices.',15.00,1,'2023-12-29 21:50:49',1,1),(2,'Grilled Chicken Wings','public/img/products/product.jpg','Tender and flavorful grilled chicken wings, perfect for appetizers.',12.00,2,'2023-12-29 21:50:49',1,1),(3,'Beef Stir-Fry','public/img/products/product.jpg','Savory beef stir-fry with a mix of fresh vegetables and special sauce.',18.00,2,'2023-12-29 21:50:49',1,2),(4,'Vegetarian Pizza','public/img/products/product.jpg','A classic vegetarian pizza with a variety of colorful veggies and cheese.',14.00,2,'2023-12-29 21:50:49',1,3),(5,'Chocolate Brownie','public/img/products/product.jpg','Rich and gooey chocolate brownie, a delightful treat for chocolate lovers.',8.00,2,'2023-12-29 21:50:49',1,7),(6,'Crispy Potato Chips','public/img/products/product.jpg','Thin and crispy potato chips, perfect for snacking anytime.',4.00,2,'2023-12-29 21:50:49',1,3),(7,'Fresh Fruit Juice','public/img/products/product.jpg','Refreshing mixed fruit juice with a blend of tropical flavors.',7.00,5,'2023-12-29 21:50:49',1,6),(8,'Chilled Coke','public/img/products/product.jpg','Classic chilled Coca-Cola, the perfect companion for any meal.',1.00,5,'2023-12-29 21:50:49',1,7),(9,'Butter Chicken','public/img/products/product.jpg','Creamy and buttery chicken curry, a popular North Indian dish.',16.00,5,'2023-12-29 21:50:49',1,1),(10,'Beef Burger','public/img/products/product.jpg','Juicy beef burger with lettuce, tomato, and a special sauce.',10.00,5,'2023-12-29 21:50:49',1,2),(11,'Vegetable Spring Rolls','public/img/products/product.jpg','Crispy and delicious vegetable spring rolls, a great appetizer.',6.00,5,'2023-12-29 21:50:49',1,3),(12,'Rasgulla','public/img/products/product.jpg','Soft and spongy Rasgulla, a popular Indian sweet dessert.',9.00,5,'2023-12-29 21:50:49',1,4),(13,'Cheese Nachos','public/img/products/product.jpg','Cheesy and flavorful nachos topped with salsa and guacamole.',8.99,11,'2023-12-29 21:50:49',1,3),(14,'Mango Lassi','public/img/products/product.jpg','Cool and refreshing mango lassi, a traditional Indian yogurt drink.',5.99,11,'2023-12-29 21:50:49',1,6),(15,'Pepsi','public/img/products/product.jpg','Carbonated Pepsi, a fizzy and refreshing beverage for any occasion.',2.49,11,'2023-12-29 21:50:49',1,7),(16,'Chicken Biryani','public/img/products/product.jpg','Fragrant and flavorful chicken biryani, a popular rice dish.',19.00,11,'2023-12-29 21:50:49',1,1),(17,'Beef Kebabs','public/img/products/product.jpg','Tender and spiced beef kebabs, perfect for barbecue lovers.',13.00,7,'2023-12-29 21:50:49',1,2),(18,'Vegetable Noodles','public/img/products/product.jpg','Stir-fried vegetable noodles with a blend of savory sauces.',11.00,7,'2023-12-29 21:50:49',1,3),(19,'Gulab Jamun','public/img/products/product.jpg','Soft and sweet Gulab Jamun, a classic Indian dessert.',7.99,7,'2023-12-29 21:50:49',1,4),(20,'Potato Wedges','public/img/products/product.jpg','Crispy and seasoned potato wedges, a tasty side dish.',4.00,7,'2023-12-29 21:50:49',1,5),(37,'C Momo','public/img/products/C Momo.jpeg','Good aalu chop',100.00,7,'2024-01-16 14:07:20',1,3),(38,'Aalu Chop','public/img/products/Aloo-chop-WS-1-500x375.jpg','Good aalu chop',100.00,7,'2024-01-16 14:08:10',1,5),(39,'Cheeze Pizzza','public/img/products/cheese pizza.jpg','Very tasty',220.00,7,'2024-01-16 14:12:17',1,3);
/*!40000 ALTER TABLE `tbl_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(25) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Admin'),(2,'Seller'),(3,'User'),(4,'Delivery Person'),(5,'Guest');
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_roles`
--

DROP TABLE IF EXISTS `tbl_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_roles` (
  `user_role_id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`role_id`),
  CONSTRAINT `tbl_user_roles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_roles`
--

LOCK TABLES `tbl_user_roles` WRITE;
/*!40000 ALTER TABLE `tbl_user_roles` DISABLE KEYS */;
INSERT INTO `tbl_user_roles` VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,5,5),(6,3,6),(7,2,7),(8,1,8),(9,4,9),(10,3,10),(11,2,11),(12,4,12),(13,1,13),(14,3,14),(15,2,15),(16,5,16),(17,4,17),(18,1,18),(19,3,19),(20,2,20),(21,2,1),(22,3,1);
/*!40000 ALTER TABLE `tbl_user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_photo_url` varchar(255) DEFAULT 'public/img/user/default.jpg',
  `password_hash` varchar(256) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `address_id` int DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `tbl_addresses` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Aarav','Shrestha','aashishmaharjan2001@gmail.com','9841234567','M',1,'1990-05-15','2023-12-29 21:49:47',1),(2,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Sneha','Gurung','sneha.gurung@example.com','9812345678','F',2,'1985-08-22','2023-12-29 21:49:47',1),(3,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Rajesh','Pandey','rajesh.pandey@example.com','9856789012','M',3,'1992-02-10','2023-12-29 21:49:47',1),(4,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Anushka','Tamang','anushka.tamang@example.com','9807654321','F',4,'1988-11-05','2023-12-29 21:49:47',1),(5,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Suman','Thapa','suman.thapa@example.com','9845678901','M',5,'1995-04-18','2023-12-29 21:49:47',1),(6,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Shreya','Acharya','shreya.acharya@example.com','9812345678','F',6,'1987-07-27','2023-12-29 21:49:47',1),(7,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Pranav','Rai','pranav.rai@example.com','9856789012','M',7,'1993-09-30','2023-12-29 21:49:47',1),(8,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Ishita','Dahal','ishita.dahal@example.com','9807654321','F',8,'1984-12-12','2023-12-29 21:49:47',1),(9,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Aryan','Lama','aryan.lama@example.com','9845678901','M',9,'1998-06-25','2023-12-29 21:49:47',1),(10,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Reema','Sharma','reema.sharma@example.com','9812345678','F',10,'1986-03-08','2023-12-29 21:49:47',1),(11,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Nabin','Magar','nabin.magar@example.com','9856789012','M',11,'1991-01-20','2023-12-29 21:49:47',1),(12,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Priya','Basnet','priya.basnet@example.com','9807654321','F',12,'1989-10-14','2023-12-29 21:49:47',1),(13,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Roshan','Giri','roshan.giri@example.com','9845678901','M',13,'1996-07-03','2023-12-29 21:49:47',1),(14,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Alisha','Rana','alisha.rana@example.com','9812345678','F',14,'1983-04-28','2023-12-29 21:49:47',1),(15,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Rajat','Koirala','rajat.koirala@example.com','9856789012','M',15,'1994-11-15','2023-12-29 21:49:47',1),(16,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Priyanka','Shakya','priyanka.shakya@example.com','9807654321','F',16,'1982-08-05','2023-12-29 21:49:47',1),(17,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Binod','Bhattarai','binod.bhattarai@example.com','9845678901','M',17,'1997-02-28','2023-12-29 21:49:47',1),(18,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Nisha','Poudel','nisha.poudel@example.com','9812345678','F',18,'1980-09-10','2023-12-29 21:49:47',1),(19,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Ramesh','Limbu','ramesh.limbu@example.com','9856789012','M',19,'1999-04-05','2023-12-29 21:49:47',1),(20,'/public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Shikha','Subedi','shikha.subedi@example.com','9807654321','F',20,'1981-12-18','2023-12-29 21:49:47',1),(23,'public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Alisha ','Pokhrel','alishapokhrel@gmail.com','9813535725','F',NULL,NULL,'2024-01-07 22:01:54',1),(26,'public/img/user/default.jpg','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','Subham ','Kadariya','subham@gmail.com','9813535725','M',NULL,NULL,'2024-01-26 09:10:26',1);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-26  9:14:55
