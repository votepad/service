-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 04 2017 г., 01:13
-- Версия сервера: 5.6.34
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
-- Структура таблицы `Contests`
--

CREATE TABLE `Contests` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `mode` tinyint(2) NOT NULL COMMENT '1-paticipants, 2-teams',
  `name` varchar(60) NOT NULL,
  `description` varchar(500) NOT NULL,
  `formula` text NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Contests_Judges`
--

CREATE TABLE `Contests_Judges` (
  `c_id` int(11) NOT NULL,
  `j_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Criterions`
--

CREATE TABLE `Criterions` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `minScore` int(11) NOT NULL,
  `maxScore` int(11) NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `Events`
--

CREATE TABLE `Events` (
  `id` int(18) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0 - draft, 1 - published',
  `creator` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(300) NOT NULL,
  `organization` varchar(64) NOT NULL,
  `uri` varchar(20) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `branding` text,
  `tags` text NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `dt_start` datetime NOT NULL,
  `dt_end` datetime NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Judges`
--

CREATE TABLE `Judges` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `password` varchar(256) NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Participants`
--

CREATE TABLE `Participants` (
  `id` int(18) NOT NULL,
  `event` int(11) NOT NULL,
  `team` int(11) DEFAULT NULL,
  `name` varchar(65) NOT NULL,
  `about` varchar(512) DEFAULT NULL,
  `logo` text,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Results`
--

CREATE TABLE `Results` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `mode` tinyint(2) DEFAULT NULL COMMENT '1-paticipants, 2-teams',
  `formula` text NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Stages`
--

CREATE TABLE `Stages` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(500) NOT NULL,
  `formula` text NOT NULL,
  `mode` tinyint(2) NOT NULL COMMENT '1 - participants, 2 - teams',
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Stages_Members`
--

CREATE TABLE `Stages_Members` (
  `s_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Teams`
--

CREATE TABLE `Teams` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `description` varchar(512) NOT NULL,
  `logo` text,
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
  `password` varchar(256) NOT NULL,
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
-- Индексы таблицы `Contests`
--
ALTER TABLE `Contests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Criterions`
--
ALTER TABLE `Criterions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Events`
--
ALTER TABLE `Events`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `uri` (`uri`);

--
-- Индексы таблицы `Judges`
--
ALTER TABLE `Judges`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Participants`
--
ALTER TABLE `Participants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Results`
--
ALTER TABLE `Results`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Stages`
--
ALTER TABLE `Stages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Teams`
--
ALTER TABLE `Teams`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для таблицы `Contests`
--
ALTER TABLE `Contests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Criterions`
--
ALTER TABLE `Criterions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Judges`
--
ALTER TABLE `Judges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Participants`
--
ALTER TABLE `Participants`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Results`
--
ALTER TABLE `Results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Stages`
--
ALTER TABLE `Stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Teams`
--
ALTER TABLE `Teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
