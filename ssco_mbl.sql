-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2014 at 09:43 AM
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
  `trainee_id` int(225) NOT NULL,
  `module_id` int(225) NOT NULL,
  `rating` varchar(225) NOT NULL,
  `last_page` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `cover_picture` varchar(225) NOT NULL DEFAULT 'assets/images/module/module_default/default.png',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `title`, `cover_picture`, `description`) VALUES
(1, 'Java GUI', 'assets/images/module/module_1/cover.png', 'This article is meant for the individual who has little or no experience in Java GUI programming.'),
(2, 'Code Igniter: Template Class', 'assets/images/module/module_2/cover.png', 'The Template Parser Class enables you to parse pseudo-variables contained within your view files. It can parse simple variables or variable tag pairs. ');

-- --------------------------------------------------------

--
-- Table structure for table `module_slide`
--

CREATE TABLE IF NOT EXISTS `module_slide` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `question` varchar(225) NOT NULL,
  `answer` varchar(225) NOT NULL,
  `module_id` int(225) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_test`
--

CREATE TABLE IF NOT EXISTS `scheduled_test` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_test_question`
--

CREATE TABLE IF NOT EXISTS `scheduled_test_question` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `is_used` tinyint(1) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE IF NOT EXISTS `test_result` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `test_id` int(225) NOT NULL,
  `module_id` int(225) NOT NULL,
  `rating` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

CREATE TABLE IF NOT EXISTS `trainee` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `user_id` int(225) NOT NULL,
  `frist_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
