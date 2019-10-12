-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for library_db
DROP DATABASE IF EXISTS `library_db`;
CREATE DATABASE IF NOT EXISTS `library_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `library_db`;

-- Dumping structure for table library_db.authors
DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.authors: ~7 rows (approximately)
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`id`, `full_name`, `email`) VALUES
	(1, 'Kumar', 'kumar@gmail.com'),
	(2, 'David', 'david@gmail.com'),
	(3, 'Birla', 'b@gmail.com'),
	(4, 'orange', 'b@gmail.com'),
	(5, 'mango', ''),
	(6, 'kiwi', ''),
	(7, 'Melinda Leigh', '');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;

-- Dumping structure for table library_db.books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `page_count` int(11) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `book_overview` text,
  `image_url` text,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `books_authors_fk` (`author_id`) USING BTREE,
  KEY `books_categories_fk` (`category_id`) USING BTREE,
  KEY `books_subcats_fk` (`subcategory_id`) USING BTREE,
  CONSTRAINT `books_authors_fk` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  CONSTRAINT `books_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `books_subcats_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.books: ~16 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `title`, `page_count`, `isbn`, `book_overview`, `image_url`, `category_id`, `subcategory_id`, `author_id`) VALUES
	(1, 'To Kill A Mokcingbird', NULL, NULL, NULL, '1568001074.jpeg', 1, 1, 1),
	(2, '1984', NULL, NULL, NULL, '1565786681.jpeg', 3, 3, 1),
	(9, 'Star Wars - A New Hope', NULL, NULL, NULL, '1565786943.jpeg', 2, 2, 1),
	(10, 'Book2', NULL, NULL, NULL, '1567919066.jpeg', 1, 1, 2),
	(11, 'Book3', NULL, NULL, NULL, NULL, 1, 1, 2),
	(12, 'Learning PHP', NULL, NULL, NULL, '1566999573.jpeg', 10, 11, 1),
	(13, 'PHP Object-Oriented', NULL, NULL, NULL, NULL, 10, 11, 1),
	(14, 'Python Stacks', NULL, NULL, NULL, NULL, 10, 13, 1),
	(15, 'The Lord Of The Rings', NULL, NULL, NULL, '1565843198.jpeg', 1, 1, 1),
	(16, 'Dance of Fire and Snow', NULL, NULL, NULL, '1565843214.jpeg', 1, 1, 1),
	(17, 'Bootstrap Intro', NULL, NULL, NULL, NULL, 1, 1, 1),
	(18, 'Learning Java', NULL, NULL, NULL, NULL, 10, 12, 1),
	(19, 'Learning C#', NULL, NULL, NULL, '1566713124.jpeg', 10, 14, 1),
	(20, 'Pride and Prejudice', NULL, NULL, NULL, '1568000125.jpeg', 1, 9, NULL),
	(21, 'Star Trek: Discovery', NULL, NULL, NULL, '1566999500.jpeg', 2, 2, NULL),
	(23, 'Save Your Breath (Morgan Dane Book 6)', 314, 'B07GK5736Z', 'A #1 Wall Street Journal, Washington Post, and Amazon Charts bestseller.\r\n\r\nIn the sixth thriller in the multimillion-copy bestselling series, Morgan Dane and PI Lance Kruger investigate the mysterious disappearance of a true-crime writer.', NULL, 1, 1, 7);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping structure for table library_db.book_instances
DROP TABLE IF EXISTS `book_instances`;
CREATE TABLE IF NOT EXISTS `book_instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_book_instances_books` (`book_id`) USING BTREE,
  CONSTRAINT `FK_book_instances_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.book_instances: ~39 rows (approximately)
/*!40000 ALTER TABLE `book_instances` DISABLE KEYS */;
INSERT INTO `book_instances` (`id`, `book_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(8, 1),
	(19, 1),
	(24, 1),
	(34, 1),
	(4, 2),
	(5, 2),
	(6, 2),
	(7, 2),
	(35, 2),
	(27, 9),
	(28, 9),
	(32, 9),
	(33, 9),
	(20, 10),
	(36, 11),
	(9, 12),
	(10, 12),
	(11, 12),
	(12, 12),
	(13, 12),
	(21, 12),
	(22, 13),
	(23, 13),
	(25, 14),
	(26, 14),
	(14, 15),
	(15, 15),
	(16, 15),
	(17, 15),
	(18, 15),
	(40, 18),
	(41, 18),
	(42, 18),
	(29, 21),
	(30, 21),
	(31, 21);
/*!40000 ALTER TABLE `book_instances` ENABLE KEYS */;

-- Dumping structure for table library_db.book_transactions
DROP TABLE IF EXISTS `book_transactions`;
CREATE TABLE IF NOT EXISTS `book_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_instance_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `borrowing_date` date DEFAULT NULL,
  `returning_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `amount` float DEFAULT '0',
  `remarks` varchar(255) DEFAULT NULL,
  `state` enum('AVAILABLE','BORROWED','DAMAGED','RETURNED') DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `book_instance_id` (`book_instance_id`) USING BTREE,
  KEY `book_transactions_ibfk_2` (`member_id`) USING BTREE,
  CONSTRAINT `book_transactions_ibfk_1` FOREIGN KEY (`book_instance_id`) REFERENCES `book_instances` (`id`),
  CONSTRAINT `book_transactions_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.book_transactions: ~4 rows (approximately)
/*!40000 ALTER TABLE `book_transactions` DISABLE KEYS */;
INSERT INTO `book_transactions` (`id`, `book_instance_id`, `member_id`, `borrowing_date`, `returning_date`, `returned_date`, `amount`, `remarks`, `state`) VALUES
	(5, 23, 3, '2019-07-18', '2019-07-25', '2019-09-15', 416, '', 'RETURNED'),
	(6, 27, 3, '2019-09-08', '2019-09-13', '2019-09-21', 64, 'some remarks...', 'RETURNED'),
	(7, 25, 5, '2019-09-08', '2019-09-13', '2019-09-29', 128, 'book.....', 'RETURNED'),
	(8, 4, 1, '2019-09-14', '2019-09-28', '2019-10-12', 112, '', 'RETURNED'),
	(9, 29, 5, '2019-09-24', '2019-09-23', '2019-09-29', 48, '', 'RETURNED');
/*!40000 ALTER TABLE `book_transactions` ENABLE KEYS */;

-- Dumping structure for table library_db.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`) VALUES
	(1, 'Fiction'),
	(2, 'Sci-Fi'),
	(3, 'Fantasy'),
	(8, 'Children Books'),
	(9, 'Math'),
	(10, 'Programming');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table library_db.departments
DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.departments: ~5 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`id`, `department_name`) VALUES
	(1, 'Natural Science'),
	(2, 'Computer Science'),
	(3, 'ICT'),
	(4, 'Accounting'),
	(5, 'Botany'),
	(6, 'Hotel Management');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping structure for table library_db.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) DEFAULT NULL,
  `member_since` date DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `member_type` enum('STUDENT','TEACHER') DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_members_departments` (`department_id`) USING BTREE,
  CONSTRAINT `FK_members_departments` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.members: ~5 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`id`, `fullname`, `member_since`, `department_id`, `member_type`, `phone`, `email`) VALUES
	(1, 'David Bala', '2018-08-27', 2, 'STUDENT', NULL, NULL),
	(3, 'Sri Saravana', '2019-06-14', 2, 'TEACHER', NULL, NULL),
	(4, 'Orange Bold', '2019-08-14', 2, 'STUDENT', NULL, NULL),
	(5, 'Banana Apple', '2019-08-31', 1, 'STUDENT', NULL, NULL),
	(7, 'mango Banana', '2019-09-21', 6, 'TEACHER', NULL, NULL),
	(8, 'Tea Cup', '2019-10-12', 1, 'TEACHER', NULL, NULL),
	(9, 'Water Bottle', '2019-10-12', 2, 'TEACHER', NULL, NULL),
	(10, 'Apple Mango', '2019-10-12', 2, 'STUDENT', NULL, NULL),
	(11, 'Banana Apple', '2019-10-12', 2, 'TEACHER', NULL, NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;

-- Dumping structure for table library_db.subcategories
DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `category_id` (`category_id`) USING BTREE,
  CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table library_db.subcategories: ~13 rows (approximately)
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`) VALUES
	(1, 1, 'Crime Fiction'),
	(2, 2, 'Space Opera'),
	(3, 3, 'Fantasy subcat'),
	(4, 8, 'Children Story Book'),
	(5, 8, 'Children Poems'),
	(7, 9, 'Applied Mathematics'),
	(8, 9, 'Geomatry'),
	(9, 1, 'Romantic Fiction'),
	(10, 1, 'Thriller'),
	(11, 10, 'PHP'),
	(12, 10, 'Java'),
	(13, 10, 'Python'),
	(14, 10, 'C#');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
