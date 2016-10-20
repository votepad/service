-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 09 2016 г., 20:23
-- Версия сервера: 5.7.11
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pronwe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Events`
--

CREATE TABLE `Events` (
  `id` int(18) NOT NULL,
  `id_organization` int(18) NOT NULL,
  `name` varchar(65) NOT NULL,
  `event_page` varchar(65) NOT NULL,
  `short_description` text NOT NULL,
  `start_time` varchar(65) NOT NULL,
  `end_time` varchar(65) NOT NULL,
  `event_status` varchar(11) DEFAULT NULL,
  `event_city` varchar(65) DEFAULT NULL,
  `dt_create` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Events`
--

INSERT INTO `Events` (`id`, `id_organization`, `name`, `event_page`, `short_description`, `start_time`, `end_time`, `event_status`, `event_city`, `dt_create`) VALUES
(1, 5, 'Miss ITMO', 'miss-itmo', 'Short description of event', '2016-08-25T14:00', '2016-08-25T15:00', '', '', '2016-08-18 21:52:12'),
(2, 5, 'Ты нужен людям', 'ty-nuzhen-liudyam', 'Федеральный конкурс "Ты нужен людям"', '2016-08-20T12:40', '2016-08-21T14:40', '', '', '2016-08-20 21:48:02'),
(3, 5, 'new event', 'new-event', 'dlkflkgdmlkdlkmldkfmkldmbfgbfgbf\ngbflkgbmflgkmbfklgmbflkgmbfgb\nfgkbjfkgjbfkjgnbkfjgnb', '2016-09-15T12:00', '2016-09-15T15:00', '', '', '2016-09-09 15:51:35');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Events`
--
ALTER TABLE `Events`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
