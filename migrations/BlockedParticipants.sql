-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2016 at 09:36 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.6.3

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
-- Table structure for table `BlockedParticipants`
--

CREATE TABLE IF NOT EXISTS `BlockedParticipants` (
  `id_event` int(18) NOT NULL,
  `id_participant` int(18) NOT NULL,
  `id_stage` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `BlockedParticipants`
--

INSERT INTO `BlockedParticipants` (`id_event`, `id_participant`, `id_stage`) VALUES
(0, 16, 19),
(0, 17, 19),
(0, 16, 20),
(0, 17, 21),
(0, 18, 21);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
