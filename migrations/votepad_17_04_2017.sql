-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 17 2017 г., 17:51
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
CREATE DATABASE IF NOT EXISTS `pronwe` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pronwe`;

-- --------------------------------------------------------

--
-- Структура таблицы `Contests`
--

DROP TABLE IF EXISTS `Contests`;
CREATE TABLE IF NOT EXISTS `Contests` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(60) NOT NULL,
  `formula` text NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Contests_Judges`
--

DROP TABLE IF EXISTS `Contests_Judges`;
CREATE TABLE IF NOT EXISTS `Contests_Judges` (
  `c_id` int(11) NOT NULL,
  `j_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Criterions`
--

DROP TABLE IF EXISTS `Criterions`;
CREATE TABLE IF NOT EXISTS `Criterions` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `min_score` int(11) NOT NULL,
  `max_score` int(11) NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `Events`
--

DROP TABLE IF EXISTS `Events`;
CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(18) NOT NULL,
  `organization` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `name` varchar(65) NOT NULL,
  `uri` varchar(65) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `branding` text,
  `tags` varchar(65) NOT NULL,
  `description` text NOT NULL,
  `dt_start` varchar(65) NOT NULL,
  `dt_end` varchar(65) NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(65) DEFAULT NULL,
  `dt_create` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Judges`
--

DROP TABLE IF EXISTS `Judges`;
CREATE TABLE IF NOT EXISTS `Judges` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Organizations`
--

DROP TABLE IF EXISTS `Organizations`;
CREATE TABLE IF NOT EXISTS `Organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `uri` varchar(65) NOT NULL,
  `website` varchar(65) NOT NULL,
  `dt_create` date NOT NULL,
  `is_removed` tinyint(4) NOT NULL DEFAULT '0',
  `owner` int(11) NOT NULL,
  `cover` varchar(65) DEFAULT 'default-cover.png',
  `logo` varchar(65) DEFAULT 'no-logo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Organization_Events`
--

DROP TABLE IF EXISTS `Organization_Events`;
CREATE TABLE IF NOT EXISTS `Organization_Events` (
  `id_organization` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Participants`
--

DROP TABLE IF EXISTS `Participants`;
CREATE TABLE IF NOT EXISTS `Participants` (
  `id` int(18) NOT NULL,
  `event` int(11) NOT NULL,
  `team` int(11) DEFAULT NULL,
  `name` varchar(65) NOT NULL,
  `about` text,
  `photo` varchar(65) DEFAULT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Results`
--

DROP TABLE IF EXISTS `Results`;
CREATE TABLE IF NOT EXISTS `Results` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `mode` int(11) DEFAULT NULL,
  `formula` text NOT NULL,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Stages`
--

DROP TABLE IF EXISTS `Stages`;
CREATE TABLE IF NOT EXISTS `Stages` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(100) NOT NULL,
  `formula` text NOT NULL,
  `mode` tinyint(4) NOT NULL COMMENT '1 - participants, 2 - teams, 3 - groups',
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Stages_Members`
--

DROP TABLE IF EXISTS `Stages_Members`;
CREATE TABLE IF NOT EXISTS `Stages_Members` (
  `s_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Teams`
--

DROP TABLE IF EXISTS `Teams`;
CREATE TABLE IF NOT EXISTS `Teams` (
  `id` int(11) NOT NULL,
  `event` int(65) NOT NULL,
  `name` varchar(65) NOT NULL,
  `description` text NOT NULL,
  `logo` text,
  `dt_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Teams_Participants`
--

DROP TABLE IF EXISTS `Teams_Participants`;
CREATE TABLE IF NOT EXISTS `Teams_Participants` (
  `id` int(11) NOT NULL,
  `id_team` int(65) NOT NULL,
  `id_participant` int(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(18) NOT NULL,
  `branding` varchar(65) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `avatar` varchar(65) DEFAULT 'no-user.png',
  `email` varchar(65) NOT NULL,
  `password` varchar(18) NOT NULL,
  `isConfirmed` int(11) DEFAULT '0',
  `dt_create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Users_Events`
--

DROP TABLE IF EXISTS `Users_Events`;
CREATE TABLE IF NOT EXISTS `Users_Events` (
  `u_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Users_Organizations`
--

DROP TABLE IF EXISTS `Users_Organizations`;
CREATE TABLE IF NOT EXISTS `Users_Organizations` (
  `u_id` int(10) unsigned NOT NULL,
  `o_id` int(10) unsigned NOT NULL
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
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `Judges`
--
ALTER TABLE `Judges`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Organizations`
--
ALTER TABLE `Organizations`
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
-- Индексы таблицы `Teams_Participants`
--
ALTER TABLE `Teams_Participants`
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
-- AUTO_INCREMENT для таблицы `Organizations`
--
ALTER TABLE `Organizations`
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
-- AUTO_INCREMENT для таблицы `Teams_Participants`
--
ALTER TABLE `Teams_Participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
