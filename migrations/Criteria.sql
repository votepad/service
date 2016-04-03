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
-- Table structure for table `Criteria`
--

CREATE TABLE IF NOT EXISTS `Criteria` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `maxscore` int(6) NOT NULL,
  `id_stage` int(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `Criteria`
--

INSERT INTO `Criteria` (`id`, `name`, `maxscore`, `id_stage`) VALUES
(7, 'next1', 5, 4),
(8, 'next2', 4, 4),
(9, 'next3', 4, 4),
(10, 'n1_1', 2, 5),
(11, 'n1_2', 2, 5),
(12, 'n2-1', 2, 6),
(13, 'n2-2', 5, 6),
(14, 'n2-3', 2, 6),
(15, 'n3-1', 10, 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
