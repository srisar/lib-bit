/*
 Navicat Premium Data Transfer

 Source Server         : Laragon
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : library_db

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 08/09/2019 12:11:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for authors
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of authors
-- ----------------------------
INSERT INTO `authors` VALUES (1, 'Kumar', 'kumar@gmail.com');
INSERT INTO `authors` VALUES (2, 'David', 'david@gmail.com');

-- ----------------------------
-- Table structure for book_instances
-- ----------------------------
DROP TABLE IF EXISTS `book_instances`;
CREATE TABLE `book_instances`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_book_instances_books`(`book_id`) USING BTREE,
  CONSTRAINT `FK_book_instances_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of book_instances
-- ----------------------------
INSERT INTO `book_instances` VALUES (1, 1);
INSERT INTO `book_instances` VALUES (2, 1);
INSERT INTO `book_instances` VALUES (3, 1);
INSERT INTO `book_instances` VALUES (8, 1);
INSERT INTO `book_instances` VALUES (19, 1);
INSERT INTO `book_instances` VALUES (24, 1);
INSERT INTO `book_instances` VALUES (4, 2);
INSERT INTO `book_instances` VALUES (5, 2);
INSERT INTO `book_instances` VALUES (6, 2);
INSERT INTO `book_instances` VALUES (7, 2);
INSERT INTO `book_instances` VALUES (27, 9);
INSERT INTO `book_instances` VALUES (28, 9);
INSERT INTO `book_instances` VALUES (32, 9);
INSERT INTO `book_instances` VALUES (33, 9);
INSERT INTO `book_instances` VALUES (20, 10);
INSERT INTO `book_instances` VALUES (9, 12);
INSERT INTO `book_instances` VALUES (10, 12);
INSERT INTO `book_instances` VALUES (11, 12);
INSERT INTO `book_instances` VALUES (12, 12);
INSERT INTO `book_instances` VALUES (13, 12);
INSERT INTO `book_instances` VALUES (21, 12);
INSERT INTO `book_instances` VALUES (22, 13);
INSERT INTO `book_instances` VALUES (23, 13);
INSERT INTO `book_instances` VALUES (25, 14);
INSERT INTO `book_instances` VALUES (26, 14);
INSERT INTO `book_instances` VALUES (14, 15);
INSERT INTO `book_instances` VALUES (15, 15);
INSERT INTO `book_instances` VALUES (16, 15);
INSERT INTO `book_instances` VALUES (17, 15);
INSERT INTO `book_instances` VALUES (18, 15);
INSERT INTO `book_instances` VALUES (29, 21);
INSERT INTO `book_instances` VALUES (30, 21);
INSERT INTO `book_instances` VALUES (31, 21);

-- ----------------------------
-- Table structure for book_transactions
-- ----------------------------
DROP TABLE IF EXISTS `book_transactions`;
CREATE TABLE `book_transactions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_instance_id` int(11) NULL DEFAULT NULL,
  `member_id` int(11) NULL DEFAULT NULL,
  `borrowing_date` date NULL DEFAULT NULL,
  `returning_date` date NULL DEFAULT NULL,
  `returned_date` date NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `state` enum('RETURNED','BORROWED') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'BORROWED',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `book_instance_id`(`book_instance_id`) USING BTREE,
  INDEX `book_transactions_ibfk_2`(`member_id`) USING BTREE,
  CONSTRAINT `book_transactions_ibfk_1` FOREIGN KEY (`book_instance_id`) REFERENCES `book_instances` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `book_transactions_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of book_transactions
-- ----------------------------
INSERT INTO `book_transactions` VALUES (5, 23, 3, '2019-07-18', '2019-07-25', NULL, '', 'BORROWED');
INSERT INTO `book_transactions` VALUES (6, 27, 3, '2019-09-08', '2019-09-13', NULL, 'some remarks...', 'BORROWED');
INSERT INTO `book_transactions` VALUES (7, 25, 5, '2019-09-08', '2019-09-13', NULL, 'book.....', 'BORROWED');

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `subcategory_id` int(11) NULL DEFAULT NULL,
  `author_id` int(11) NULL DEFAULT NULL,
  `image_url` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `books_authors_fk`(`author_id`) USING BTREE,
  INDEX `books_categories_fk`(`category_id`) USING BTREE,
  INDEX `books_subcats_fk`(`subcategory_id`) USING BTREE,
  CONSTRAINT `books_authors_fk` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `books_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `books_subcats_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES (1, 'To Kill A Mokcingbird', 1, 4, 1, NULL);
INSERT INTO `books` VALUES (2, '1984', 3, 3, 1, 'http://localhost/uploads/1565786681.jpeg');
INSERT INTO `books` VALUES (9, 'Star Wars - A New Hope', 2, 2, 1, 'http://localhost/uploads/1565786943.jpeg');
INSERT INTO `books` VALUES (10, 'Book2', 1, 1, 2, 'http://localhost/uploads/1567919066.jpeg');
INSERT INTO `books` VALUES (11, 'Book3', 1, 1, 2, NULL);
INSERT INTO `books` VALUES (12, 'Learning PHP', 10, 11, 1, 'http://localhost/uploads/1566999573.jpeg');
INSERT INTO `books` VALUES (13, 'PHP Object-Oriented', 10, 11, 1, NULL);
INSERT INTO `books` VALUES (14, 'Python Stacks', 10, 13, 1, NULL);
INSERT INTO `books` VALUES (15, 'The Lord Of The Rings', 1, 1, 1, 'http://localhost/uploads/1565843198.jpeg');
INSERT INTO `books` VALUES (16, 'Dance of Fire and Snow', 1, 1, 1, 'http://localhost/uploads/1565843214.jpeg');
INSERT INTO `books` VALUES (17, 'Bootstrap Intro', 1, 1, 1, NULL);
INSERT INTO `books` VALUES (18, 'Learning Java', 10, 13, 1, NULL);
INSERT INTO `books` VALUES (19, 'Learning C#', 10, 14, 1, 'http://localhost/uploads/1566713124.jpeg');
INSERT INTO `books` VALUES (20, 'Pride and Prejudice', 1, 9, NULL, NULL);
INSERT INTO `books` VALUES (21, 'Star Trek: Discovery', 2, 2, NULL, 'http://localhost/uploads/1566999500.jpeg');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Fiction');
INSERT INTO `categories` VALUES (2, 'Sci-Fi');
INSERT INTO `categories` VALUES (3, 'Fantasy');
INSERT INTO `categories` VALUES (8, 'Children Books');
INSERT INTO `categories` VALUES (9, 'Math');
INSERT INTO `categories` VALUES (10, 'Programming');

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (1, 'Natural Science');
INSERT INTO `departments` VALUES (2, 'Computer Science');
INSERT INTO `departments` VALUES (3, 'ICT');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `member_since` date NULL DEFAULT NULL,
  `department_id` int(11) NULL DEFAULT NULL,
  `member_type` enum('STUDENT','TEACHER') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_members_departments`(`department_id`) USING BTREE,
  CONSTRAINT `FK_members_departments` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES (1, 'David Bala', '2018-08-27', 2, 'STUDENT');
INSERT INTO `members` VALUES (3, 'Sri Saravana', '2019-06-14', 2, 'TEACHER');
INSERT INTO `members` VALUES (4, 'Orange Bold', '2019-08-14', 2, 'STUDENT');
INSERT INTO `members` VALUES (5, 'Banana Apple', '2019-08-31', 1, 'STUDENT');

-- ----------------------------
-- Table structure for subcategories
-- ----------------------------
DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE `subcategories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NULL DEFAULT NULL,
  `subcategory_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE,
  CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subcategories
-- ----------------------------
INSERT INTO `subcategories` VALUES (1, 1, 'Crime Fiction');
INSERT INTO `subcategories` VALUES (2, 2, 'Space Opera');
INSERT INTO `subcategories` VALUES (3, 3, 'Fantasy subcat');
INSERT INTO `subcategories` VALUES (4, 8, 'Children Story Book');
INSERT INTO `subcategories` VALUES (5, 8, 'Children Poems');
INSERT INTO `subcategories` VALUES (7, 9, 'Applied Mathematics');
INSERT INTO `subcategories` VALUES (8, 9, 'Geomatry');
INSERT INTO `subcategories` VALUES (9, 1, 'Romantic Fiction');
INSERT INTO `subcategories` VALUES (10, 1, 'Thriller');
INSERT INTO `subcategories` VALUES (11, 10, 'PHP');
INSERT INTO `subcategories` VALUES (12, 10, 'Java');
INSERT INTO `subcategories` VALUES (13, 10, 'Python');
INSERT INTO `subcategories` VALUES (14, 10, 'C#');

SET FOREIGN_KEY_CHECKS = 1;
