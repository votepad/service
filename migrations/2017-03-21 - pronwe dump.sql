-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 21 2017 г., 15:58
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

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
  `name` varchar(65) NOT NULL,
  `page` varchar(65) NOT NULL,
  `keywords` varchar(65) NOT NULL,
  `short_description` text NOT NULL,
  `full_description` text NOT NULL,
  `start_time` varchar(65) NOT NULL,
  `end_time` varchar(65) NOT NULL,
  `status` varchar(11) DEFAULT NULL,
  `address` varchar(65) DEFAULT NULL,
  `dt_created` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Events`
--

INSERT INTO `Events` (`id`, `name`, `page`, `keywords`, `short_description`, `full_description`, `start_time`, `end_time`, `status`, `address`, `dt_created`) VALUES
(9, 'mister itmo', 'mister', 'sdf', 'dlskmflsmslkdflksmdkfslkdfmlksksmdflksmdf', '', '13.10.2016 23:30', '27.10.2016 23:30', NULL, 'Россия, Москва, Смоленская набережная', '2016-10-29 23:41:26'),
(10, 'MISS ITMO', 'miss', 'sdf', 'dlskmflsmslkdflksmdkfslkdfmlksksmdflksmdf', '', '13.10.2016 23:30', '27.10.2016 23:30', NULL, 'Россия, Москва, Смоленская набережная', '2016-10-29 23:45:04'),
(15, '23', '12332', '', '213', '', '2017-02-18T11:55', '2017-02-15T09:45', NULL, '', '2017-02-24 12:30:14');

-- --------------------------------------------------------

--
-- Структура таблицы `Event_Participants`
--

CREATE TABLE `Event_Participants` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_participant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Event_Participants`
--

INSERT INTO `Event_Participants` (`id`, `id_event`, `id_participant`) VALUES
(1, 10, 13),
(2, 10, 15),
(3, 10, 16),
(4, 10, 17),
(5, 10, 18),
(6, 10, 19),
(7, 10, 20),
(8, 10, 21),
(9, 10, 22),
(10, 10, 23),
(11, 10, 24),
(12, 10, 25),
(13, 10, 26),
(15, 9, 28),
(16, 9, 29),
(17, 9, 30),
(18, 9, 31),
(19, 9, 32),
(20, 9, 33),
(21, 9, 34),
(22, 9, 35),
(23, 9, 36),
(24, 9, 37),
(25, 9, 38),
(26, 9, 39),
(27, 9, 40),
(28, 9, 41),
(29, 9, 42),
(30, 9, 43),
(31, 9, 44),
(32, 9, 45),
(33, 9, 46),
(34, 9, 47),
(35, 9, 48),
(36, 9, 49),
(37, 9, 50),
(38, 9, 51),
(39, 9, 52),
(40, 9, 53),
(41, 9, 54),
(42, 9, 55),
(43, 9, 56),
(44, 9, 57),
(45, 9, 58),
(46, 9, 59),
(47, 9, 60),
(48, 9, 61),
(49, 9, 62),
(50, 9, 63),
(51, 9, 64),
(52, 9, 65),
(53, 9, 66),
(54, 9, 67),
(55, 9, 68),
(56, 9, 69),
(57, 9, 70),
(58, 9, 71),
(59, 9, 72),
(60, 9, 73),
(61, 9, 74),
(62, 9, 75);

-- --------------------------------------------------------

--
-- Структура таблицы `Members`
--

CREATE TABLE `Members` (
  `id` int(11) NOT NULL,
  `name` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Members`
--

INSERT INTO `Members` (`id`, `name`) VALUES
(1, 'Жюри'),
(2, 'Участник');

-- --------------------------------------------------------

--
-- Структура таблицы `Organizations`
--

CREATE TABLE `Organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `uri` varchar(65) NOT NULL,
  `website` varchar(65) NOT NULL,
  `dt_create` date NOT NULL,
  `is_removed` tinyint(4) NOT NULL DEFAULT '0',
  `owner` int(11) NOT NULL,
  `cover` varchar(65) NOT NULL DEFAULT 'default-cover.png',
  `logo` varchar(65) NOT NULL DEFAULT 'no-logo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Organizations`
--

INSERT INTO `Organizations` (`id`, `name`, `description`, `uri`, `website`, `dt_create`, `is_removed`, `owner`, `cover`, `logo`) VALUES
(1, 'Университет ИТМО', 'fskl', 'ifmo', 'http://ds.dsds', '2017-03-14', 0, 3, 'no-cover.png', 'no-logo.png'),
(2, '456456', 'sdasd', '45978', 'https://sad.dd', '2017-03-14', 0, 3, 'no-cover.png', 'no-logo.png'),
(3, 'лод', 'jhhmnhg', 'hgkhjg', 'http://jhgjk.jg', '2017-03-15', 0, 3, 'no-cover.png', 'no-logo.png'),
(4, 'dsljf', 'dsfkljsd', 'jdlfsdsf', 'http://ds.dssd', '2017-03-15', 0, 3, 'no-cover.png', 'no-logo.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Organization_Events`
--

CREATE TABLE `Organization_Events` (
  `id_organization` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Organization_Events`
--

INSERT INTO `Organization_Events` (`id_organization`, `id_event`) VALUES
(24, 10),
(26, 9),
(26, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `Participants`
--

CREATE TABLE `Participants` (
  `id` int(18) NOT NULL,
  `name` varchar(65) NOT NULL,
  `about` text,
  `photo` varchar(65) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Participants`
--

INSERT INTO `Participants` (`id`, `name`, `about`, `photo`, `email`) VALUES
(14, 'выв', 'ываываыва', NULL, 'example@ya.ru'),
(15, 'Корепанов Андрей аааа', 'Меняем информацию ываыва', NULL, NULL),
(17, 'Левый чувак 2', 'ылвьады дылвьа ываываыва', NULL, NULL),
(21, 'выаы ыва', 'ываыва ываыва', NULL, NULL),
(22, 'лвоатпловтапловтапжлвтап', 'дваполвтп', NULL, NULL),
(23, 'дватпловтап', 'ловатпловап', NULL, NULL),
(24, '12', NULL, NULL, NULL),
(25, '13', NULL, NULL, NULL),
(26, '14', NULL, NULL, NULL),
(27, '645', NULL, NULL, NULL),
(72, 'das', '456', '/01.jpg', NULL),
(73, 'участник 2', '', '/02.jpg', NULL),
(74, 'участник 3', '', '/03.jpg', NULL),
(75, 'участник 4', '', '/04.jpg', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `Permissions`
--

CREATE TABLE `Permissions` (
  `id_permission` int(10) UNSIGNED NOT NULL,
  `permission_description` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Permissions`
--

INSERT INTO `Permissions` (`id_permission`, `permission_description`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4');

-- --------------------------------------------------------

--
-- Структура таблицы `Roles`
--

CREATE TABLE `Roles` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Roles`
--

INSERT INTO `Roles` (`id_role`, `role_name`) VALUES
(1, 'Создатель организации'),
(2, 'Модератор');

-- --------------------------------------------------------

--
-- Структура таблицы `Role_Permission`
--

CREATE TABLE `Role_Permission` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `id_permission` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Role_Permission`
--

INSERT INTO `Role_Permission` (`id_role`, `id_permission`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Teams`
--

CREATE TABLE `Teams` (
  `id` int(11) NOT NULL,
  `id_event` int(65) NOT NULL,
  `name` varchar(65) NOT NULL,
  `description` text NOT NULL,
  `logo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Teams`
--

INSERT INTO `Teams` (`id`, `id_event`, `name`, `description`, `logo`) VALUES
(2, 0, 'ФИТИП', 'Факультет Информационных технологий и программирования', NULL),
(16, 10, 'олваптловап', 'лватплотвлаотпвлоатплвоатп', 'm_eb9c6914c785907f8bcd00f02a097fb7.jpg'),
(17, 10, 'ваолмвталом', 'влоатлмвоталмовам', 'm_'),
(18, 9, 'Команда 1', 'лидеры', 'm_150328847d62c28ab0f4a0779ef909f0.jpg'),
(19, 9, 'Team 2', '456', 'm_');

-- --------------------------------------------------------

--
-- Структура таблицы `Teams_Participants`
--

CREATE TABLE `Teams_Participants` (
  `id` int(11) NOT NULL,
  `id_team` int(65) NOT NULL,
  `id_participant` int(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Teams_Participants`
--

INSERT INTO `Teams_Participants` (`id`, `id_team`, `id_participant`) VALUES
(1, 2, 15),
(2, 2, 16),
(35, 16, 17),
(36, 17, 22),
(37, 17, 23),
(38, 18, 72),
(39, 19, 74),
(40, 19, 75),
(41, 18, 73);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(18) NOT NULL,
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

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `name`, `surname`, `lastname`, `phone`, `avatar`, `email`, `password`, `isConfirmed`, `dt_create`) VALUES
(1, 'Nikolay', NULL, NULL, NULL, 'no-user.png', 'test@ya.ru', '123321', NULL, '2017-03-10'),
(2, 'Nikolay', NULL, NULL, NULL, 'no-user.png', 'test2@ya.ru', '132321', NULL, '2017-03-10'),
(3, 'Nikolay', NULL, NULL, NULL, 'no-user.png', 'test1@ya.ru', '123321', NULL, '2017-03-12'),
(4, 'Nikolay Turov', NULL, NULL, NULL, 'no-user.png', 'turov@ya.ru', '123321', NULL, '2017-03-20');

-- --------------------------------------------------------

--
-- Структура таблицы `users_organizations`
--

CREATE TABLE `users_organizations` (
  `u_id` int(10) UNSIGNED NOT NULL,
  `o_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users_organizations`
--

INSERT INTO `users_organizations` (`u_id`, `o_id`) VALUES
(23, 24),
(23, 25),
(24, 26),
(25, 26),
(3, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `User_Role`
--

CREATE TABLE `User_Role` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_role` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `User_Role`
--

INSERT INTO `User_Role` (`id_user`, `id_role`) VALUES
(20, 1),
(21, 1),
(23, 1),
(24, 1),
(25, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Voting`
--

CREATE TABLE `Voting` (
  `id` int(11) NOT NULL,
  `id_participant` int(18) NOT NULL,
  `score` int(18) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Voting`
--

INSERT INTO `Voting` (`id`, `id_participant`, `score`) VALUES
(1, 1, 1),
(2, 2, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Events`
--
ALTER TABLE `Events`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `Event_Participants`
--
ALTER TABLE `Event_Participants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Members`
--
ALTER TABLE `Members`
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
-- Индексы таблицы `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`id_permission`);

--
-- Индексы таблицы `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id_role`);

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
-- Индексы таблицы `Voting`
--
ALTER TABLE `Voting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `Event_Participants`
--
ALTER TABLE `Event_Participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT для таблицы `Members`
--
ALTER TABLE `Members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `Organizations`
--
ALTER TABLE `Organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `Participants`
--
ALTER TABLE `Participants`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT для таблицы `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `Teams`
--
ALTER TABLE `Teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `Teams_Participants`
--
ALTER TABLE `Teams_Participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `Voting`
--
ALTER TABLE `Voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
