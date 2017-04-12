-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2017 г., 16:37
-- Версия сервера: 5.5.50
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

DROP TABLE IF EXISTS `Events`;
CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(18) NOT NULL,
  `organization` int(11) NOT NULL,
  `title` varchar(65) NOT NULL,
  `uri` varchar(65) NOT NULL,
  `tags` varchar(65) NOT NULL,
  `description` text NOT NULL,
  `dt_start` varchar(65) NOT NULL,
  `dt_end` varchar(65) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(65) DEFAULT NULL,
  `dt_create` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
