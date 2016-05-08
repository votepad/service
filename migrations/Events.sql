-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 13 2016 г., 23:06
-- Версия сервера: 5.5.45
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `pronwe_service`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `event_status` int(11) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `finish_datetime` datetime NOT NULL,
  `city` varchar(65) NOT NULL,
  `type` int(11) NOT NULL,
  `photo` varchar(65) NOT NULL,
  `full` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `Events`
--

INSERT INTO `Events` (`id`, `title`, `description`, `event_status`, `start_datetime`, `finish_datetime`, `city`, `type`, `photo`, `full`) VALUES
(10, 'testing VV   3', 'testing    3testing    3testing    3testing    3testing    3', 1, '2025-01-04 05:10:00', '2023-02-07 03:20:00', '1', 1, 'Chrysanthemum.jpg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
