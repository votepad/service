-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 08 2016 г., 00:19
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
-- Структура таблицы `Criteria`
--

CREATE TABLE IF NOT EXISTS `Criteria` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `maxscore` int(6) NOT NULL,
  `id_stage` int(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `Criteria`
--

INSERT INTO `Criteria` (`id`, `name`, `maxscore`, `id_stage`) VALUES
(34, 'кр 1 ', 10, 26),
(35, 'кр 2', 15, 26),
(36, 'кр 3', 20, 26);

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
  `event_status` varchar(65) NOT NULL,
  `organizations` text NOT NULL,
  `start_datetime` varchar(20) NOT NULL,
  `finish_datetime` varchar(20) NOT NULL,
  `city` varchar(65) NOT NULL,
  `type` varchar(100) NOT NULL,
  `photo` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `Events`
--

INSERT INTO `Events` (`id`, `title`, `description`, `event_status`, `organizations`, `start_datetime`, `finish_datetime`, `city`, `type`, `photo`) VALUES
(1, 'New Event you haven''t ever see', 'Something special, new and unforgivable. This event you won''t forget never!!', 'IN', '', '2015-12-31 00:00:00', '1 фев 2016 в 19:00', 'SPb', '1', ''),
(2, 'Мисс итмо', 'focusoutfocusoutfocusoutfocusoutfocusoutfocusoutfocusoutfocusoutfocusout', 'Университетское мероприятие', '', '30 апр 2016 в 17:30', '30 апр 2016 в 19:00', 'Санкт-Петербург', 'Оценивание участников по одному критерию на каждом этапе', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `Judges`
--

INSERT INTO `Judges` (`id`, `name`, `email`, `position`, `photo`, `id_event`) VALUES
(3, 'none1', 'hi@mail.ru', 'asdasd', 'Penguins.jpg', 2),
(4, 'none2', 'skdf@gmail.com', 'lsdflksjdflskjdf', '', 2),
(5, 'none3', 'test@test.ru', 'akdaoksd;alksd', 'Chrysanthemum.jpg', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `Participants`
--

INSERT INTO `Participants` (`id`, `id_event`, `name`, `description`, `photo`) VALUES
(3, 2, 'Хайдаров Мурод Сухробович', 'Студент', 'Koala.jpg'),
(5, 2, 'someone else', 'sdfsdfs', 'Lighthouse.jpg'),
(6, 2, 'someone else', 'sdfsdfs', 'Lighthouse.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `Stages`
--

INSERT INTO `Stages` (`id`, `name`, `description`, `id_event`, `allcriterions`) VALUES
(26, 'Этап 1', 'описание этапа 1', 2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(18) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(65) DEFAULT NULL,
  `name` varchar(65) NOT NULL,
  `surname` varchar(65) NOT NULL,
  `sex` varchar(7) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `lastname`, `name`, `surname`, `sex`, `number`, `country`, `city`, `avatar`, `email`, `password`, `role`, `done`) VALUES
(13, 'Friman', 'Morgan', 'Kimki', 'ma', '188213408', 'USA', 'United States of A', '', 'frimen@mail.ru', 123321, 0, 1),
(1, 'Khaydarov', 'Murod', 'Suhrobovich', 'ma', '2147483648', 'Tajikistan', 'Dushanbe', '', 'murod.haydarov@inbox.ru', 123321, 1, 1),
(14, 'Дмитриевич', 'Николай', 'Туров', 'Мужской', '+79819592650', '', 'Санкт-Петербург', '', 'turov96@yandex.ru', 159357987, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
