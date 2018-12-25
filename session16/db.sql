-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.61 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for 18php06_php
CREATE DATABASE IF NOT EXISTS `18php06_php` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `18php06_php`;

-- Dumping structure for table 18php06_php.products
CREATE TABLE IF NOT EXISTS `products` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table 18php06_php.products: ~7 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`idProduct`, `name`, `price`, `description`, `image`, `created`, `status`) VALUES
	(7, 'asd', 123.3, 'sdf', 'asd', '2018-12-13 14:13:34', 1),
	(8, 'asd', 123.3, 'sdf', 'asd', '2018-12-13 14:14:12', 1),
	(9, 'asd', 123.3, 'sdf', 'asd', '2018-12-13 14:14:41', 1),
	(10, 'asd', 123, 'asd', 'asd', '2018-12-13 14:15:00', 1),
	(11, 'asd', 123, 'asd', 'asd', '2018-12-13 14:15:14', 1),
	(12, 'aa', 123.3, 'asd', 'zxc', '2018-12-18 12:22:36', 2),
	(14, 'asd', 123.3, 'asd', 'image/Untitled.png', '2018-12-20 09:49:23', 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
