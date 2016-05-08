-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2016 at 01:10 AM
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
-- Table structure for table `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `event_status` varchar(65) NOT NULL,
  `start_time` datetime NOT NULL,
  `finish_time` datetime NOT NULL,
  `city` varchar(65) NOT NULL,
  `type` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`id`, `title`, `description`, `event_status`, `start_time`, `finish_time`, `city`, `type`) VALUES
(1, 'New Event you haven''t ever seen', 'Something special, new and unforgivable. This event you won''t forget never!!', 'IN', '2015-12-31 12:00:00', '2016-12-31 01:00:00', 'SPb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(65) DEFAULT NULL,
  `name` varchar(65) NOT NULL,
  `surname` varchar(65) NOT NULL,
  `sex` varchar(2) NOT NULL,
  `number` varchar(12) NOT NULL,
  `country` varchar(18) NOT NULL,
  `city` varchar(18) NOT NULL,
  `avatar` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` int(18) NOT NULL,
  `role` int(18) NOT NULL,
  `done` int(11) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `lastname`, `name`, `surname`, `sex`, `number`, `country`, `city`, `avatar`, `email`, `password`, `role`, `done`) VALUES
(13, 'Friman', 'Morgan', 'Kimki', 'ma', '+188213415', 'USA', 'United States of A', '', 'frimen@mail.ru', 123321, 0, 1),
(1, 'Khaydarov', 'Murod', 'Suhrobovich', 'ma', '893122029910', 'Tajikistan', 'Dushanbe', '', 'murod.haydarov@inbox.ru', 123321, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
