-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2016 at 01:56 AM
-- Server version: 5.5.41-log
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pronwe_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `Judges`
--

CREATE TABLE IF NOT EXISTS `Judges` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `position` varchar(65) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `id_event` int(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Judges`
--

INSERT INTO `Judges` (`id`, `name`, `email`, `position`, `photo`, `id_event`) VALUES
(3, 'none', 'hi@mail.ru', 'asdasd', 'Penguins.jpg', 2),
(4, 'none', 'skdf@gmail.com', 'lsdflksjdflskjdf', '', 2),
(5, 'none', 'test@test.ru', 'akdaoksd;alksd', 'Chrysanthemum.jpg', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
