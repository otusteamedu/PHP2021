
--
-- Структура таблицы `buyed_tickets`
--

CREATE TABLE `buyed_tickets` (
                                 `session_id` int(11) NOT NULL,
                                 `actual_price` int(11) NOT NULL,
                                 `seat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

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
-- Структура таблицы `hall_zones`
--

CREATE TABLE `hall_zones` (
                              `id` int(11) NOT NULL,
                              `hall_id` int(11) NOT NULL,
                              `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seats`
--

CREATE TABLE `seats` (
                         `id` int(11) NOT NULL,
                         `hall_zone_id` int(11) NOT NULL,
                         `row` int(11) NOT NULL,
                         `seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
                            `id` int(11) NOT NULL,
                            `film_id` int(11) NOT NULL,
                            `hall_zone_id` int(11) NOT NULL,
                            `price` int(11) NOT NULL,
                            `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buyed_tickets`
--
ALTER TABLE `buyed_tickets`
    ADD PRIMARY KEY (`session_id`,`seat_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `seat_id` (`seat_id`);

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
-- Индексы таблицы `hall_zones`
--
ALTER TABLE `hall_zones`
    ADD PRIMARY KEY (`id`),
  ADD KEY `hall_id` (`hall_id`);

--
-- Индексы таблицы `seats`
--
ALTER TABLE `seats`
    ADD PRIMARY KEY (`id`),
  ADD KEY `hall_zone_id` (`hall_zone_id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
    ADD PRIMARY KEY (`id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `hall_zone_id` (`hall_zone_id`);

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
-- AUTO_INCREMENT для таблицы `hall_zones`
--
ALTER TABLE `hall_zones`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `seats`
--
ALTER TABLE `seats`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `buyed_tickets`
--
ALTER TABLE `buyed_tickets`
    ADD CONSTRAINT `buyed_tickets_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `buyed_tickets_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`);

--
-- Ограничения внешнего ключа таблицы `hall_zones`
--
ALTER TABLE `hall_zones`
    ADD CONSTRAINT `hall_zones_ibfk_1` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`);

--
-- Ограничения внешнего ключа таблицы `seats`
--
ALTER TABLE `seats`
    ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`hall_zone_id`) REFERENCES `hall_zones` (`id`);

--
-- Ограничения внешнего ключа таблицы `sessions`
--
ALTER TABLE `sessions`
    ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`),
  ADD CONSTRAINT `sessions_ibfk_3` FOREIGN KEY (`hall_zone_id`) REFERENCES `hall_zones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
