
--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
                         `id` int(11) NOT NULL,
                         `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `halls`
--

CREATE TABLE `halls` (
                         `id` int(11) NOT NULL,
                         `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `sells`
--

CREATE TABLE `sells` (
                         `id` int(11) NOT NULL,
                         `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
                            `id` int(11) NOT NULL,
                            `hall_id` int(11) NOT NULL,
                            `film_id` int(11) NOT NULL,
                            `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
                           `id` int(11) NOT NULL,
                           `session_id` int(11) NOT NULL,
                           `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
    ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `halls`
--
ALTER TABLE `halls`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sells`
--
ALTER TABLE `sells`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
    ADD PRIMARY KEY (`id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `hall_id` (`hall_id`) USING BTREE;

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `halls`
--
ALTER TABLE `halls`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sells`
--
ALTER TABLE `sells`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sessions`
--
ALTER TABLE `sessions`
    ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`);

--
-- Ограничения внешнего ключа таблицы `tickets`
--
ALTER TABLE `tickets`
    ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);
COMMIT;