-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2016 at 03:25 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sts`
--
CREATE DATABASE IF NOT EXISTS `sts` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sts`;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `option_body` text NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option_body`) VALUES
(1, 1, '2'),
(2, 1, '4'),
(3, 1, '523'),
(4, 1, '35'),
(5, 2, 'asfasfasfasfasf'),
(6, 2, 'sdfasgasgasg'),
(7, 2, 'asfasfasfasf');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `question_body` text NOT NULL,
  `question_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `quiz_id`, `option_id`, `question_body`, `question_timestamp`) VALUES
(1, 1, 1, '1+1=?', '2016-01-26 16:00:00'),
(2, 1, 5, 'asfasf asf as fas fafs a', '2016-01-27 05:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

DROP TABLE IF EXISTS `quizes`;
CREATE TABLE IF NOT EXISTS `quizes` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_set` varchar(50) NOT NULL,
  `quiz_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizes`
--

INSERT INTO `quizes` (`quiz_id`, `quiz_set`, `quiz_timestamp`) VALUES
(1, 'SET_A', '2016-01-27 05:14:08');

-- --------------------------------------------------------

--
-- Stand-in structure for view `quiz_list`
--
DROP VIEW IF EXISTS `quiz_list`;
CREATE TABLE IF NOT EXISTS `quiz_list` (
`quiz_id` int(11)
,`quiz_set` varchar(50)
,`quiz_timestamp` timestamp
,`question_id` int(11)
,`question_body` text
,`option_id` int(11)
,`option_body` text
);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE IF NOT EXISTS `scores` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score_value` int(11) NOT NULL,
  `quiz_answers` longtext NOT NULL,
  `score_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`score_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`score_id`, `user_id`, `quiz_id`, `score_value`, `quiz_answers`, `score_timestamp`) VALUES
(1, 10, 1, 220, '{}', '2016-01-27 08:04:50'),
(2, 10, 1, 220, '{}', '2016-01-27 08:27:49'),
(3, 10, 1, 220, '{}', '2016-01-27 08:28:32'),
(4, 10, 1, 220, '{}', '2016-01-27 08:28:35'),
(5, 10, 1, 220, '{}', '2016-01-27 08:28:35'),
(6, 10, 1, 220, '{}', '2016-01-27 08:28:35'),
(7, 10, 1, 220, '{}', '2016-01-27 08:28:35'),
(8, 10, 1, 220, '{}', '2016-01-27 08:28:35'),
(9, 10, 1, 220, '{}', '2016-01-27 08:28:36'),
(10, 10, 1, 220, '{}', '2016-01-27 08:28:36'),
(11, 10, 1, 220, '{}', '2016-01-27 08:28:36'),
(12, 10, 1, 220, '{}', '2016-01-27 08:28:36'),
(13, 10, 1, 220, '{}', '2016-01-27 08:28:36'),
(14, 10, 1, 220, '{}', '2016-01-27 08:28:37'),
(15, 10, 1, 220, '{}', '2016-01-27 08:28:37'),
(16, 10, 1, 220, '{}', '2016-01-27 08:28:37'),
(17, 10, 1, 220, '{}', '2016-01-27 08:28:37'),
(18, 10, 1, 220, '{}', '2016-01-27 08:28:37'),
(19, 10, 1, 220, '{}', '2016-01-27 08:28:38'),
(20, 10, 1, 220, '{}', '2016-01-27 08:28:38'),
(21, 10, 1, 220, '{}', '2016-01-27 08:28:38'),
(22, 10, 1, 220, '{}', '2016-01-27 08:28:38'),
(23, 10, 1, 220, '{}', '2016-01-27 08:28:38'),
(24, 10, 1, 220, '{}', '2016-01-27 08:28:39'),
(25, 10, 1, 220, '{}', '2016-01-27 08:28:39'),
(26, 10, 1, 220, '{}', '2016-01-27 08:28:39'),
(27, 10, 1, 220, '{}', '2016-01-27 08:28:40'),
(28, 10, 1, 220, '{}', '2016-01-27 08:28:40'),
(29, 10, 1, 220, '{}', '2016-01-27 08:28:40'),
(30, 10, 1, 220, '{}', '2016-01-27 08:28:40'),
(31, 10, 1, 220, '{}', '2016-01-27 08:28:40'),
(32, 10, 1, 220, '{}', '2016-01-27 08:28:41'),
(33, 10, 1, 220, '{}', '2016-01-28 08:56:53'),
(34, 10, 1, 220, '{}', '2016-01-28 08:57:00'),
(35, 0, 0, 1, '1,2', '2016-01-28 09:05:24'),
(36, 3, 5, 1, '1,2', '2016-01-28 09:09:08'),
(37, 3, 5, 1, '[Ljava.lang.String;@425eaa40', '2016-01-28 09:33:20'),
(38, 3, 5, 1, 'null null', '2016-01-28 09:36:44'),
(39, 3, 5, 1, '1 2', '2016-01-28 09:42:30'),
(40, 3, 5, 1, '1,5', '2016-01-28 10:05:56'),
(41, 3, 5, 0, '1,5', '2016-01-28 10:09:38'),
(42, 3, 5, 2, '1,5', '2016-01-28 10:12:41'),
(43, 3, 5, 1, '1,7', '2016-01-28 10:13:22'),
(44, 10, 5, 1, '2,5', '2016-01-28 10:48:10'),
(45, 10, 5, 2, '2,5', '2016-01-28 10:48:48'),
(46, 10, 1, 2, '1,5', '2016-01-28 10:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(150) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`) VALUES
(1, 'A1'),
(3, 'A2'),
(4, 'A3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `user_type` varchar(11) NOT NULL DEFAULT 'student',
  `user_name` varchar(32) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_isactive` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `section_id`, `user_type`, `user_name`, `user_pass`, `user_firstname`, `user_lastname`, `user_isactive`) VALUES
(9, 1, 'student', 'lasssst', 'lasssssst', 'lasssssst', 'lassssssst', 1),
(10, 1, 'student', 'jasper', 'jasper', 'alskfajs', 'alkfjaslfkj', 1),
(12, 1, 'student', 'alsfkjasfasfasffff', 'lkajsfasfasfffff', 'alskfajs', 'alkfjaslfkj', 1),
(13, 0, 'student', 'aaaaaa', 'aaaaas', 'aaaaaa', 'aaaaaa', 1);

-- --------------------------------------------------------

--
-- Structure for view `quiz_list`
--
DROP TABLE IF EXISTS `quiz_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `quiz_list`  AS  select `z`.`quiz_id` AS `quiz_id`,`z`.`quiz_set` AS `quiz_set`,`z`.`quiz_timestamp` AS `quiz_timestamp`,`q`.`question_id` AS `question_id`,`q`.`question_body` AS `question_body`,`q`.`option_id` AS `option_id`,`o`.`option_body` AS `option_body` from ((`quizes` `z` join `questions` `q` on((`q`.`quiz_id` = `z`.`quiz_id`))) join `options` `o` on((`o`.`question_id` = `q`.`question_id`))) group by `z`.`quiz_id` ;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
