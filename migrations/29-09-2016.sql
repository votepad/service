ALTER TABLE `Users` DROP `role`

CREATE TABLE `Roles` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Структура таблицы `Permissions`
--

CREATE TABLE `Permissions` (
  `id_permission` int(10) UNSIGNED NOT NULL,
  `permission_description` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`id_permission`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `id_permission` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

CREATE TABLE `Role_Permission` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `id_permission` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `User_Role` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_role` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `Organizations` DROP ` user_created `

CREATE TABLE `User_Organizations` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_organization` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8