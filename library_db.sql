-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2019 at 12:33 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `full_name`, `email`) VALUES
(1, 'Kumar', 'kumar@gmail.com'),
(2, 'David', 'david@gmail.com'),
(3, 'Birla', 'b@gmail.com'),
(4, 'Orange', 'b@gmail.com'),
(5, 'Yellow Ming', 'yellowm@gmail.com'),
(6, 'kiwi', 'kiwi@some.com'),
(7, 'Melinda Leigh', ''),
(8, 'test1', 'test1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `page_count` int(11) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `book_overview` text,
  `image_url` text,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `page_count`, `isbn`, `book_overview`, `image_url`, `category_id`, `subcategory_id`, `author_id`) VALUES
(1, 'To Kill A Mokcingbird', NULL, NULL, NULL, '1573385282.jpeg', 1, 1, 1),
(2, '1984', NULL, NULL, NULL, NULL, 3, 3, 1),
(9, 'Star Wars - A New Hope', NULL, NULL, NULL, NULL, 2, 2, 1),
(10, 'Book2', NULL, NULL, NULL, NULL, 1, 1, 2),
(11, 'Book3', NULL, NULL, NULL, NULL, 1, 1, 2),
(12, 'Learning PHP', NULL, NULL, NULL, '1572958032.jpeg', 10, 11, 1),
(13, 'PHP Object-Oriented', NULL, NULL, NULL, NULL, 10, 11, 1),
(14, 'Python Stacks', NULL, NULL, NULL, NULL, 10, 13, 1),
(15, 'The Lord Of The Rings', NULL, NULL, NULL, '1572962696.jpeg', 1, 1, 1),
(16, 'Dance of Fire and Snow', NULL, NULL, NULL, NULL, 1, 1, 1),
(17, 'Bootstrap Intro', NULL, NULL, NULL, NULL, 1, 1, 1),
(18, 'Learning Java', NULL, NULL, NULL, NULL, 10, 12, 1),
(19, 'Learning C#', NULL, NULL, NULL, NULL, 10, 14, 1),
(20, 'Pride and Prejudice', NULL, NULL, NULL, NULL, 1, 9, 7),
(21, 'Star Trek: Discovery', NULL, NULL, NULL, '1573387137.jpeg', 2, 2, 3),
(23, 'Save Your Breath (Morgan Dane Book 6)', 314, 'B07GK5736Z', 'A #1 Wall Street Journal, Washington Post, and Amazon Charts bestseller.\r\n\r\nIn the sixth thriller in the multimillion-copy bestselling series, Morgan Dane and PI Lance Kruger investigate the mysterious disappearance of a true-crime writer.', '1572958062.jpeg', 1, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `book_instances`
--

CREATE TABLE `book_instances` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `book_instances`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `book_transactions`
--

CREATE TABLE `book_transactions` (
  `id` int(11) NOT NULL,
  `book_instance_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `borrowing_date` date DEFAULT NULL,
  `returning_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `amount` float DEFAULT '0',
  `remarks` varchar(255) DEFAULT NULL,
  `state` enum('AVAILABLE','BORROWED','DAMAGED','RETURNED') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `book_transactions`
--

INSERT INTO `book_transactions` (`id`, `book_instance_id`, `member_id`, `borrowing_date`, `returning_date`, `returned_date`, `amount`, `remarks`, `state`) VALUES
(5, 23, 3, '2019-07-18', '2019-07-25', '2019-10-21', 416, '', 'RETURNED'),
(6, 27, 3, '2019-09-08', '2019-09-13', '2019-09-21', 64, 'some remarks...', 'RETURNED'),
(7, 25, 5, '2019-09-08', '2019-09-13', '2019-09-29', 128, 'book.....', 'RETURNED'),
(8, 4, 1, '2019-09-14', '2019-09-28', '2019-10-12', 112, '', 'RETURNED'),
(9, 29, 5, '2019-09-24', '2019-09-23', '2019-09-29', 48, '', 'RETURNED'),
(10, 1, 8, '2019-10-21', '2019-10-26', '2019-11-05', 80, 'some remarks...', 'RETURNED'),
(11, 29, 10, '2019-11-05', '2019-11-09', NULL, 0, '', 'BORROWED');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Fiction'),
(2, 'Sci-Fi'),
(3, 'Fantasy'),
(8, 'Children Books'),
(9, 'Math'),
(10, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(1, 'Natural Science'),
(2, 'Computer Science'),
(3, 'ICT'),
(4, 'Accounting'),
(5, 'Botany'),
(6, 'Hotel Management');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `member_since` date DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `member_type` enum('STUDENT','TEACHER') DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fullname`, `member_since`, `department_id`, `member_type`, `phone`, `email`) VALUES
(1, 'David Bala', '2018-08-27', 2, 'STUDENT', NULL, NULL),
(3, 'Sri Saravana', '2019-06-14', 2, 'TEACHER', NULL, NULL),
(4, 'Orange Bold', '2019-08-14', 2, 'STUDENT', NULL, NULL),
(5, 'Banana Apple', '2019-08-31', 1, 'STUDENT', NULL, NULL),
(7, 'mango Banana', '2019-09-21', 6, 'TEACHER', NULL, NULL),
(8, 'Tea Cup', '2019-10-12', 1, 'TEACHER', NULL, NULL),
(9, 'Water Bottle', '2019-10-12', 2, 'TEACHER', NULL, NULL),
(10, 'Apple Mango', '2019-10-12', 2, 'STUDENT', NULL, NULL),
(11, 'Banana Apple', '2019-10-12', 2, 'TEACHER', NULL, NULL),
(12, 'Green Leaf', '2019-10-21', 5, 'TEACHER', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `subcategories`
--

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
(14, 10, 'C#'),
(15, 1, 'Test3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `display_name`, `role`) VALUES
(1, 'admin', '$2y$10$jj9jQ6K3BCWttMjCQl7fROF1aSQBWkp3lJF8N5yQqyGgGqVwE0tmu', 'David Kumar', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `books_authors_fk` (`author_id`) USING BTREE,
  ADD KEY `books_categories_fk` (`category_id`) USING BTREE,
  ADD KEY `books_subcats_fk` (`subcategory_id`) USING BTREE;

--
-- Indexes for table `book_instances`
--
ALTER TABLE `book_instances`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_book_instances_books` (`book_id`) USING BTREE;

--
-- Indexes for table `book_transactions`
--
ALTER TABLE `book_transactions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `book_instance_id` (`book_instance_id`) USING BTREE,
  ADD KEY `book_transactions_ibfk_2` (`member_id`) USING BTREE;

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_members_departments` (`department_id`) USING BTREE;

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `book_instances`
--
ALTER TABLE `book_instances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `book_transactions`
--
ALTER TABLE `book_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_authors_fk` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `books_subcats_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `book_instances`
--
ALTER TABLE `book_instances`
  ADD CONSTRAINT `FK_book_instances_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `book_transactions`
--
ALTER TABLE `book_transactions`
  ADD CONSTRAINT `book_transactions_ibfk_1` FOREIGN KEY (`book_instance_id`) REFERENCES `book_instances` (`id`),
  ADD CONSTRAINT `book_transactions_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `FK_members_departments` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
