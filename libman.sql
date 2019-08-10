-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5669
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for library_db
CREATE DATABASE IF NOT EXISTS `library_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `library_db`;

-- Dumping structure for table library_db.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table library_db.authors: ~2 rows (approximately)
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
REPLACE INTO `authors` (`id`, `full_name`, `email`) VALUES
	(1, 'Kumar', 'kumar@gmail.com'),
	(2, 'David', 'david@gmail.com');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;

-- Dumping structure for table library_db.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_authors_fk` (`author_id`),
  KEY `books_categories_fk` (`category_id`),
  KEY `books_subcats_fk` (`subcategory_id`),
  CONSTRAINT `books_authors_fk` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  CONSTRAINT `books_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `books_subcats_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table library_db.books: ~13 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
REPLACE INTO `books` (`id`, `title`, `category_id`, `subcategory_id`, `author_id`) VALUES
	(1, 'To Kill A Mokcingbird', 1, 4, 1),
	(2, '1984', 3, 3, 1),
	(9, 'Star Wars - A New Hope', 2, 2, 1),
	(10, 'Book2', 1, 1, 2),
	(11, 'Book3', 1, 1, 2),
	(12, 'Learning PHP', 10, 11, 1),
	(13, 'PHP Object-Oriented', 10, 11, 1),
	(14, 'Python Stacks', 10, 13, 1),
	(15, 'The Lord Of The Rings', 1, 1, 1),
	(16, 'Dance of Fire and Snow', 1, 1, 1),
	(17, 'Bootstrap Intro', 1, 1, 1),
	(18, 'Learning Java', 10, 13, 1),
	(19, 'Learning C#', 1, 1, 1),
	(20, 'Pride and Prejudice', 1, 9, NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping structure for table library_db.book_instances
CREATE TABLE IF NOT EXISTS `book_instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_book_instances_books` (`book_id`),
  CONSTRAINT `FK_book_instances_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table library_db.book_instances: ~18 rows (approximately)
/*!40000 ALTER TABLE `book_instances` DISABLE KEYS */;
REPLACE INTO `book_instances` (`id`, `book_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(8, 1),
	(19, 1),
	(24, 1),
	(4, 2),
	(5, 2),
	(6, 2),
	(7, 2),
	(27, 9),
	(28, 9),
	(20, 10),
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
	(18, 15);
/*!40000 ALTER TABLE `book_instances` ENABLE KEYS */;

-- Dumping structure for table library_db.book_transactions
CREATE TABLE IF NOT EXISTS `book_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_instance_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `borrowed_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `state` enum('RETURNED','BORROWED') DEFAULT 'BORROWED',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table library_db.book_transactions: ~2 rows (approximately)
/*!40000 ALTER TABLE `book_transactions` DISABLE KEYS */;
REPLACE INTO `book_transactions` (`id`, `book_instance_id`, `member_id`, `borrowed_date`, `return_date`, `returned_date`, `remarks`, `state`) VALUES
	(3, 22, 2, '2019-07-01', '2019-07-05', NULL, 'some remarks', 'BORROWED'),
	(4, 22, 2, '2019-06-20', '2019-06-22', '2019-06-22', 'some remarks', 'RETURNED'),
	(5, 23, 3, '2019-07-18', '2019-07-25', NULL, '', 'BORROWED');
/*!40000 ALTER TABLE `book_transactions` ENABLE KEYS */;

-- Dumping structure for table library_db.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table library_db.categories: ~5 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
REPLACE INTO `categories` (`id`, `category_name`) VALUES
	(1, 'Fiction'),
	(2, 'Sci-Fi'),
	(3, 'Fantasy'),
	(8, 'Children Books'),
	(9, 'Math'),
	(10, 'Programming');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table library_db.members
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) DEFAULT NULL,
  `member_since` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table library_db.members: ~2 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
REPLACE INTO `members` (`id`, `fullname`, `member_since`) VALUES
	(1, 'David Birla', '2019-07-14 11:15:45'),
	(2, 'Kumar Raja', '2019-07-14 11:16:00'),
	(3, 'Sri Saravan', '2019-07-14 11:16:06');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;

-- Dumping structure for table library_db.subcategories
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table library_db.subcategories: ~12 rows (approximately)
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
REPLACE INTO `subcategories` (`id`, `category_id`, `subcategory_name`) VALUES
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
	(13, 10, 'Python');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
