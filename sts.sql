-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2015 at 02:29 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sts`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesstypes`
--

CREATE TABLE IF NOT EXISTS `accesstypes` (
`accesstype_id` int(11) NOT NULL,
  `accesstype_description` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesstypes`
--

INSERT INTO `accesstypes` (`accesstype_id`, `accesstype_description`) VALUES
(1, 'Admin'),
(2, 'Edit'),
(3, 'View');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE IF NOT EXISTS `enrollments` (
`enrollment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `enrollment_tuition` decimal(19,4) NOT NULL,
  `enrollment_misc` decimal(19,4) NOT NULL,
  `enrollment_discount` decimal(19,4) NOT NULL,
  `enrollment_deduction` decimal(19,4) NOT NULL,
  `enrollment_runningbal` decimal(19,4) NOT NULL,
  `enrollment_date` date NOT NULL,
  `paymentterm_key` int(11) NOT NULL,
  `enrollment_tuitionbal` decimal(19,4) NOT NULL,
  `enrollment_miscbal` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE IF NOT EXISTS `fees` (
`fee_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `paymentterm_id` int(11) NOT NULL DEFAULT '1',
  `fee_tuition` decimal(19,4) NOT NULL,
  `fee_misc` decimal(19,4) NOT NULL,
  `fee_computer` decimal(19,4) NOT NULL,
  `fee_others` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
`grade_id` int(11) NOT NULL,
  `grade_description` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grade_description`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, 'Nursery'),
(14, 'Kinder 1'),
(15, 'Kinder 2'),
(16, 'something would suffice herexxxxxxxxxx'),
(17, ''),
(18, ''),
(19, 'something would suffice herexxxxxxxxxx'),
(20, 'something would suffice here'),
(21, 'something would suffice here'),
(22, 'something would suffice here'),
(23, 'something would suffice here'),
(24, 'something would suffice here'),
(26, 'something would suffice here'),
(27, 'something would suffice here'),
(28, 'something would suffice here'),
(29, 'something would suffice here'),
(30, 'something would suffice here'),
(31, 'something would suffice here'),
(32, 'something would suffice here'),
(33, 'something would suffice here'),
(34, 'something would suffice here');

-- --------------------------------------------------------

--
-- Table structure for table `paymentterms`
--

CREATE TABLE IF NOT EXISTS `paymentterms` (
`paymentterm_id` int(11) NOT NULL,
  `paymentterm_description` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentterms`
--

INSERT INTO `paymentterms` (`paymentterm_id`, `paymentterm_description`) VALUES
(1, 'Cash'),
(2, 'Installment'),
(3, 'Easy');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE IF NOT EXISTS `schoolyears` (
`schoolyear_id` int(11) NOT NULL,
  `schoolyear_description` varchar(150) NOT NULL,
  `schoolyear_isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
`section_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `section_description` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `grade_id`, `section_description`) VALUES
(2, 13, 'Burgundy'),
(3, 13, 'Chestnut'),
(4, 13, 'Crimson'),
(5, 14, 'Fucshia'),
(6, 14, 'Indigo'),
(7, 14, 'Lavander'),
(8, 14, 'Lilac'),
(9, 15, 'Olive'),
(10, 15, 'Plum'),
(11, 15, 'Purple'),
(12, 15, 'Russet'),
(13, 1, 'Amethyst'),
(14, 1, 'Amber'),
(15, 1, 'Aquamarine'),
(16, 1, 'Agate'),
(17, 2, 'Citrine'),
(18, 2, 'Coral'),
(19, 2, 'Diamond'),
(20, 2, 'Emerald'),
(21, 3, 'Fluorite'),
(22, 3, 'Jade'),
(23, 3, 'Jasper'),
(24, 3, 'Jet'),
(25, 4, 'Moonstone'),
(26, 4, 'Onyx'),
(27, 4, 'Opal'),
(28, 4, 'Obsidian'),
(29, 5, 'Pearl'),
(30, 5, 'Quartz'),
(31, 5, 'Rosequartz'),
(32, 5, 'Ruby'),
(33, 6, 'Sapphire'),
(34, 6, 'Sardonyx'),
(35, 6, 'Topaz'),
(36, 6, 'Zircon'),
(37, 7, 'Love'),
(38, 7, 'Hope'),
(39, 7, 'Wisdom'),
(40, 7, 'Values'),
(41, 8, 'Perseverance'),
(42, 8, 'Respoect'),
(43, 8, 'Courtesy'),
(44, 8, 'Responsibility'),
(45, 9, 'Truth'),
(46, 9, 'Obedience'),
(47, 9, 'Patience'),
(48, 9, 'Generosity'),
(49, 10, 'Honesty'),
(50, 10, 'Loyalty'),
(51, 10, 'Integrity'),
(52, 10, 'Humility'),
(53, 11, 'Harmony'),
(54, 11, 'Equality'),
(55, 11, 'Commitment'),
(56, 11, 'Diplomacy'),
(57, 12, 'Orderliness'),
(58, 12, 'Resourcefulness'),
(59, 12, 'Innovation'),
(60, 12, 'Fairness');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`student_id` int(11) NOT NULL,
  `student_number` varchar(9) NOT NULL,
  `student_firstname` varchar(50) NOT NULL,
  `student_middlename` varchar(50) NOT NULL,
  `student_lastname` varchar(50) NOT NULL,
  `student_gender` varchar(6) NOT NULL,
  `student_home_phone` varchar(25) NOT NULL,
  `student_mobile_phone` varchar(25) NOT NULL,
  `student_fax_number` varchar(25) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_city` varchar(50) NOT NULL,
  `student_province` varchar(50) NOT NULL,
  `student_postal` varchar(15) NOT NULL,
  `student_notes` longtext NOT NULL,
  `student_mother` varchar(50) NOT NULL,
  `student_father` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
`transaction_id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_tuition` decimal(19,4) NOT NULL,
  `transaction_others` decimal(19,4) NOT NULL,
  `transaction_total` decimal(19,4) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_or_number` varchar(50) NOT NULL,
  `transaction_ar_number` varchar(50) NOT NULL,
  `transaction_discount` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `accesstype_id` int(11) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_isactive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesstypes`
--
ALTER TABLE `accesstypes`
 ADD PRIMARY KEY (`accesstype_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
 ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
 ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
 ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `paymentterms`
--
ALTER TABLE `paymentterms`
 ADD PRIMARY KEY (`paymentterm_id`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
 ADD PRIMARY KEY (`schoolyear_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
 ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesstypes`
--
ALTER TABLE `accesstypes`
MODIFY `accesstype_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `paymentterms`
--
ALTER TABLE `paymentterms`
MODIFY `paymentterm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
MODIFY `schoolyear_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
