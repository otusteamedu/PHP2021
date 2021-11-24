
--
-- SQLINES DEMO *** � таблицы `buyed_tickets`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE buyed_tickets (
                               session_id int NOT NULL,
                               actual_price int NOT NULL,
                               seat_id int NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** � таблицы `films`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE films (
                       id int NOT NULL,
                       name varchar(255) NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** � таблицы `halls`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE halls (
                       id int NOT NULL,
                       name varchar(256) NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** � таблицы `hall_zones`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE hall_zones (
                            id int NOT NULL,
                            hall_id int NOT NULL,
                            name varchar(256) NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** � таблицы `seats`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE seats (
                       id int NOT NULL,
                       hall_zone_id int NOT NULL,
                       row int NOT NULL,
                       seat int NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** � таблицы `sessions`
--

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE sessions (
                          id int NOT NULL,
                          film_id int NOT NULL,
                          hall_zone_id int NOT NULL,
                          price int NOT NULL,
                          time time(0) NOT NULL
) ;

--
-- SQLINES DEMO *** охранённых таблиц
--

--
-- SQLINES DEMO *** аблицы `buyed_tickets`
--
ALTER TABLE buyed_tickets
    ADD PRIMARY KEY (session_id,seat_id),
  ADD KEY `session_id` (session_id),
  ADD KEY `seat_id` (seat_id);

--
-- SQLINES DEMO *** аблицы `films`
--
ALTER TABLE films
    ADD CONSTRAINT id UNIQUE  (id);

--
-- SQLINES DEMO *** аблицы `halls`
--
ALTER TABLE halls
    ADD PRIMARY KEY (id);

--
-- SQLINES DEMO *** аблицы `hall_zones`
--
ALTER TABLE hall_zones
    ADD PRIMARY KEY (id),
  ADD KEY `hall_id` (hall_id);

--
-- SQLINES DEMO *** аблицы `seats`
--
ALTER TABLE seats
    ADD PRIMARY KEY (id),
  ADD KEY `hall_zone_id` (hall_zone_id);

--
-- SQLINES DEMO *** аблицы `sessions`
--
ALTER TABLE sessions
    ADD PRIMARY KEY (id),
  ADD KEY `film_id` (film_id),
  ADD KEY `hall_zone_id` (hall_zone_id);

--
-- SQLINES DEMO *** ля сохранённых таблиц
--

--
-- SQLINES DEMO *** ля таблицы `films`
--
ALTER TABLE films
    MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT;

--
-- SQLINES DEMO *** ля таблицы `halls`
--
ALTER TABLE halls
    MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT;

--
-- SQLINES DEMO *** ля таблицы `hall_zones`
--
ALTER TABLE hall_zones
    MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT;

--
-- SQLINES DEMO *** ля таблицы `seats`
--
ALTER TABLE seats
    MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT;

--
-- SQLINES DEMO *** ля таблицы `sessions`
--
ALTER TABLE sessions
    MODIFY id cast(11 as int) NOT NULL AUTO_INCREMENT;

--
-- SQLINES DEMO *** �ия внешнего ключа сохраненных таблиц
--

--
-- SQLINES DEMO *** �ия внешнего ключа таблицы `buyed_tickets`
--
ALTER TABLE buyed_tickets
    ADD CONSTRAINT buyed_tickets_ibfk_1 FOREIGN KEY (session_id) REFERENCES sessions (id),
  ADD CONSTRAINT buyed_tickets_ibfk_2 FOREIGN KEY (seat_id) REFERENCES `seats` (id);

--
-- SQLINES DEMO *** �ия внешнего ключа таблицы `hall_zones`
--
ALTER TABLE hall_zones
    ADD CONSTRAINT hall_zones_ibfk_1 FOREIGN KEY (hall_id) REFERENCES halls (id);

--
-- SQLINES DEMO *** �ия внешнего ключа таблицы `seats`
--
ALTER TABLE seats
    ADD CONSTRAINT seats_ibfk_1 FOREIGN KEY (hall_zone_id) REFERENCES hall_zones (id);

--
-- SQLINES DEMO *** �ия внешнего ключа таблицы `sessions`
--
ALTER TABLE sessions
    ADD CONSTRAINT sessions_ibfk_2 FOREIGN KEY (film_id) REFERENCES films (id),
  ADD CONSTRAINT sessions_ibfk_3 FOREIGN KEY (hall_zone_id) REFERENCES `hall_zones` (id);
COMMIT;

/* SQLINES DEMO *** ER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** ER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** ON_CONNECTION=@OLD_COLLATION_CONNECTION */;
