### 1. Получение фильма "Мстители"
#### запрос
```
EXPLAIN ANALYZE
SELECT id FROM films WHERE name = 'Мстители';
```

#### план на БД до 10000 строк
![alt text](md_screenshots/1_10000.png)

#### перечень оптимизаций
```
CREATE INDEX name ON public.films USING btree (name);
```

### 2. Получение цены сеансов, которые стоят дешевле 300
#### запрос
```
EXPLAIN ANALYZE
SELECT price FROM sessions WHERE price < 300 ORDER BY price;
```

#### план на БД до 10000 строк
![alt text](md_screenshots/2_10000.png)

#### перечень оптимизаций
```
CREATE INDEX price ON public.sessions USING btree (price);
```

### 3. Получение названий фильмов с названием длиной в 8 символов
#### запрос
```
EXPLAIN ANALYZE 
SELECT name FROM films WHERE length(name) = 8;
```

#### план на БД до 10000 строк
![alt text](md_screenshots/3_10000.png)

#### перечень оптимизаций
```
CREATE INDEX name_len ON public.films USING btree (length(name)) INCLUDE (name);
```

### 4. Получение сессий с суммарной ценой фильма за все сессии
#### запрос
```
EXPLAIN ANALYZE 
SELECT sessions.id, films.name, sum(price) OVER w
FROM films JOIN sessions ON sessions.film_id = films.id
    WINDOW w AS (PARTITION BY film_id);
```

#### план на БД до 10000 строк
![alt text](md_screenshots/4_10000.png)

#### перечень оптимизаций
```
CREATE INDEX fild_id ON public.sessions USING btree (fild_id);
```


### 5. Получение залов, в которых сессии не дороже 300 рублей
#### запрос
```
EXPLAIN ANALYZE 
SELECT halls.name FROM sessions
    JOIN hall_zones on sessions.hall_zone_id = hall_zones.id
    JOIN halls on halls.id = hall_zones.hall_id
    WHERE price < 300
```
#### перечень оптимизаций
```
CREATE INDEX price ON public.sessions USING btree (price);
```

#### план на БД до 10000 строк
![alt text](md_screenshots/5_10000.png)

### 6. Получение кол-ва мест в зонах залов, в которых показывают не фильм "Мстители"
#### запрос
```
EXPLAIN ANALYZE 
SELECT COUNT(seats.id) FROM seats
    JOIN hall_zones on seats.hall_zone_id = hall_zones.id
    JOIN sessions on sessions.hall_zone_id = hall_zones.id
    JOIN films ON sessions.film_id = films.id
WHERE films.name != 'Мстители'
```

#### план на БД до 10000 строк
![alt text](md_screenshots/6_10000.png)

#### перечень оптимизаций
```
CREATE INDEX name ON public.films USING btree (name);
```