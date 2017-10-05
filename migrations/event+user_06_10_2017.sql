-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 06 2017 г., 00:21
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `votepad`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Events`
--

CREATE TABLE `Events` (
  `id` int(18) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0 - draft, 1 - published',
  `creator` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `uri` varchar(65) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `branding` text,
  `tags` varchar(65) NOT NULL,
  `address` varchar(65) DEFAULT NULL,
  `dt_start` datetime NOT NULL,
  `dt_end` datetime NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(18) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `avatar` text,
  `branding` text,
  `email` varchar(65) NOT NULL,
  `password` varchar(512) NOT NULL,
  `is_confirmed` int(11) DEFAULT NULL,
  `private` tinyint(1) NOT NULL,
  `dt_create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Users_Events`
--

CREATE TABLE `Users_Events` (
  `u_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `uri` (`uri`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
