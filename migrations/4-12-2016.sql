CREATE TABLE `Event_Participants` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_participant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `Event_Participants`
  ADD PRIMARY KEY (`id`);



CREATE TABLE `Participants` (
  `id` int(18) NOT NULL,
  `name` varchar(65) NOT NULL,
  `about` text,
  `photo` varchar(65) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Participants`
--
ALTER TABLE `Participants`
  ADD PRIMARY KEY (`id`);
