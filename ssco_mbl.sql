-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2014 at 12:05 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ssco_mbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_module`
--

CREATE TABLE IF NOT EXISTS `enrolled_module` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `trainee_id` int(225) NOT NULL COMMENT 'user.id NOT trainee.id',
  `module_id` int(225) NOT NULL,
  `rating` float DEFAULT '0',
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `date_enroled` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_completed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `trainee_id` (`trainee_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Truncate table before insert `enrolled_module`
--

TRUNCATE TABLE `enrolled_module`;
-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `cover_picture` varchar(225) NOT NULL DEFAULT 'assets/images/module/module_default/default.png',
  `description` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Truncate table before insert `module`
--

TRUNCATE TABLE `module`;
-- --------------------------------------------------------

--
-- Table structure for table `module_slide`
--

CREATE TABLE IF NOT EXISTS `module_slide` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Truncate table before insert `module_slide`
--

TRUNCATE TABLE `module_slide`;
-- --------------------------------------------------------

--
-- Table structure for table `module_tags`
--

CREATE TABLE IF NOT EXISTS `module_tags` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `module_id` int(255) NOT NULL,
  `tag_id` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`module_id`,`tag_id`),
  KEY `module_id` (`module_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Truncate table before insert `module_tags`
--

TRUNCATE TABLE `module_tags`;
-- --------------------------------------------------------

--
-- Table structure for table `module_test_result`
--

CREATE TABLE IF NOT EXISTS `module_test_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trainee_id` int(11) NOT NULL COMMENT 'user.id NOT trainee.id',
  `module_id` int(11) NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `trainee_id` (`trainee_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=385 ;

--
-- Truncate table before insert `module_test_result`
--

TRUNCATE TABLE `module_test_result`;
-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `qtitle` varchar(225) NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(225) NOT NULL,
  `module_id` int(225) NOT NULL,
  `choices` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Truncate table before insert `question`
--

TRUNCATE TABLE `question`;
-- --------------------------------------------------------

--
-- Table structure for table `scheduled_test`
--

CREATE TABLE IF NOT EXISTS `scheduled_test` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `isset_test` tinyint(1) NOT NULL,
  `module_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Truncate table before insert `scheduled_test`
--

TRUNCATE TABLE `scheduled_test`;
-- --------------------------------------------------------

--
-- Table structure for table `scheduled_test_question`
--

CREATE TABLE IF NOT EXISTS `scheduled_test_question` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `qtitle` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL,
  `choices` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Truncate table before insert `scheduled_test_question`
--

TRUNCATE TABLE `scheduled_test_question`;
-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Truncate table before insert `tags`
--

TRUNCATE TABLE `tags`;
-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE IF NOT EXISTS `test_result` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `test_id` int(225) NOT NULL,
  `trainee_id` int(225) NOT NULL COMMENT 'user.id NOT trainee.id',
  `module_id` int(225) NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `trainee_id` (`trainee_id`),
  KEY `trainee_id_2` (`trainee_id`),
  KEY `test_id` (`test_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Truncate table before insert `test_result`
--

TRUNCATE TABLE `test_result`;
-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

CREATE TABLE IF NOT EXISTS `trainee` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `user_id` int(225) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Truncate table before insert `trainee`
--

TRUNCATE TABLE `trainee`;
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolled_module`
--
ALTER TABLE `enrolled_module`
  ADD CONSTRAINT `enrolled_module_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolled_module_ibfk_1` FOREIGN KEY (`trainee_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_slide`
--
ALTER TABLE `module_slide`
  ADD CONSTRAINT `module_slide_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_tags`
--
ALTER TABLE `module_tags`
  ADD CONSTRAINT `module_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_tags_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_test_result`
--
ALTER TABLE `module_test_result`
  ADD CONSTRAINT `module_test_result_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_test_result_ibfk_1` FOREIGN KEY (`trainee_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scheduled_test`
--
ALTER TABLE `scheduled_test`
  ADD CONSTRAINT `scheduled_test_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scheduled_test_question`
--
ALTER TABLE `scheduled_test_question`
  ADD CONSTRAINT `scheduled_test_question_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_result`
--
ALTER TABLE `test_result`
  ADD CONSTRAINT `test_result_ibfk_3` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_result_ibfk_1` FOREIGN KEY (`trainee_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_result_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `scheduled_test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainee`
--
ALTER TABLE `trainee`
  ADD CONSTRAINT `trainee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
