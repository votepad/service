-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 21 2016 г., 14:42
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
-- Структура таблицы `BlockedParticipants`
--

CREATE TABLE IF NOT EXISTS `BlockedParticipants` (
  `id_event` int(18) NOT NULL,
  `id_participant` int(18) NOT NULL,
  `id_stage` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `BlockedStages`
--

CREATE TABLE IF NOT EXISTS `BlockedStages` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `id_stage` int(18) NOT NULL,
  `block` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Cities`
--

CREATE TABLE IF NOT EXISTS `Cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `Cities`
--

INSERT INTO `Cities` (`id`, `name`) VALUES
(1, 'Санкт-Петербург'),
(2, 'Москва'),
(3, 'Пермь'),
(4, 'Екатеренбург'),
(5, 'Сочи');

-- --------------------------------------------------------

--
-- Структура таблицы `Criteria`
--

CREATE TABLE IF NOT EXISTS `Criteria` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `maxscore` int(6) NOT NULL,
  `id_stage` int(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Триггеры `Criteria`
--
DROP TRIGGER IF EXISTS `addCriteriontoStage`;
DELIMITER //
CREATE TRIGGER `addCriteriontoStage` AFTER INSERT ON `Criteria`
 FOR EACH ROW UPDATE Stages
INNER JOIN Criteria 
ON Stages.id = Criteria.id_stage
SET allcriterions = allcriterions + 1
WHERE Stages.id = NEW.id_stage
//
DELIMITER ;
DROP TRIGGER IF EXISTS `deleteCriteriontoStage`;
DELIMITER //
CREATE TRIGGER `deleteCriteriontoStage` AFTER DELETE ON `Criteria`
 FOR EACH ROW UPDATE Stages
INNER JOIN Criteria 
ON Stages.id = Criteria.id_stage
SET allcriterions = allcriterions - 1
WHERE Stages.id = OLD.id_stage
//
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Judges`
--

CREATE TABLE IF NOT EXISTS `Judges` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `position` varchar(65) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `id_event` int(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Online`
--

CREATE TABLE IF NOT EXISTS `Online` (
  `id_event` int(18) NOT NULL,
  `id_judge` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Participants`
--

CREATE TABLE IF NOT EXISTS `Participants` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `id_event` int(18) NOT NULL,
  `name` varchar(65) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Positions`
--

CREATE TABLE IF NOT EXISTS `Positions` (
  `id_event` int(18) NOT NULL,
  `id_stage` int(18) NOT NULL,
  `id_participant` int(18) NOT NULL,
  `position` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Scores`
--

CREATE TABLE IF NOT EXISTS `Scores` (
  `id_event` int(18) NOT NULL,
  `id_participant` int(18) NOT NULL,
  `id_stage` int(18) NOT NULL,
  `id_judge` int(18) NOT NULL,
  `score` int(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Stages`
--

CREATE TABLE IF NOT EXISTS `Stages` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `id_event` int(18) NOT NULL,
  `allcriterions` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(20) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `number` varchar(12) NOT NULL,
  `city` int(11) NOT NULL,
  `avatar` varchar(65) NOT NULL DEFAULT 'no-user.png',
  `email` varchar(65) NOT NULL,
  `password` varchar(18) NOT NULL,
  `role` int(18) NOT NULL,
  `done` int(11) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
