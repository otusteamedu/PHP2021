### 1. Получение фильма "Мстители"
#### запрос
```
EXPLAIN ANALYZE
SELECT id FROM films WHERE name = 'Мстители';
```

#### план на БД до 10000 строк
![alt text](md_screenshots/1_10000.png)

#### план на БД до 10000000 строк
![alt text](md_screenshots/1_10000000.png)

#### перечень оптимизаций
```
CREATE INDEX name ON public.films USING btree (name);
```
Добавление индекса значительно ускорило выполнение запроса,
тк мы получили указатель на строку таблицы, не просматривая всю таблицу,
а взяли указатель на запись из таблицы индекса. Запись с таким индексом одна, что
тоже в свою очередь повлияло на скорость ответа

### 2. Получение цены сеансов, которые стоят дешевле 300
#### запрос
```
EXPLAIN ANALYZE
SELECT price FROM sessions WHERE price < 300 ORDER BY price;
```

#### план на БД до 10000 строк
![alt text](md_screenshots/2_10000.png)

#### план на БД до 10000000 строк
![alt text](md_screenshots/2_10000000.png)

#### перечень оптимизаций
```
CREATE INDEX cheap_price ON public.sessions USING btree (price)
WHERE price > 300;
```
Добавление фильтрованного индекса позволило получить сразу из таблицы индекса указатели
на все сеансы дешевле 300. В таблице индекса в свою очередь хранились только 
сеансы дешевле 300, благодаря чему мы получили быстро указатели на все, требуемые записи


### 3. Получение названий фильмов с названием длиной в 8 символов
#### запрос
```
EXPLAIN ANALYZE 
SELECT name FROM films WHERE length(name) = 8;
```

#### план на БД до 10000 строк
![alt text](md_screenshots/3_10000.png)

#### план на БД до 10000000 строк
![alt text](md_screenshots/3_10000000.png)

#### перечень оптимизаций
```
CREATE INDEX name_len ON public.films USING btree (length(name)) INCLUDE (name);
```
Использование покрывающего функционального индекса позволило нам сохранить в таблице индексов
длину названия фильмов вместе с указателями на записи, а так-же самим названием включенным в индекс. 
Это ускорило запрос

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

#### план на БД до 10000000 строк
![alt text](md_screenshots/4_10000000.png)

#### перечень оптимизаций
```
CREATE INDEX film_id ON public.sessions USING btree (film_id);
CREATE INDEX id ON public.films USING btree (id);
```
Добавление индексов для внешнего ключа и ключа для id внешней таблицы 
позволило ускорить запрос, тк больше нет необходимости искать по всей таблице
идентификаторы фильмов и указатели на таблицу фильмов в сессии. Теперь поиск
происходит по таблице индексов и алгоритм поиска другой


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
CREATE INDEX cheap_price ON public.sessions USING btree (price)
WHERE price < 300;
```
Добавление фильтрованного индекса позволило получить сразу из таблицы индекса указатели
на все сеансы дешевле 300 и присоеденить к записи 2 таблицы. В таблице индекса в свою очередь хранились только
сеансы дешевле 300, благодаря чему мы получили быстро указатели на все, требуемые записи

#### план на БД до 10000 строк
![alt text](md_screenshots/5_10000.png)

#### план на БД до 10000000 строк
![alt text](md_screenshots/5_10000000.png)

### 6. Получение кол-ва мест в зонах залов, в которых показывают не фильм "Мстители" и зона зала не имеет id 3
#### запрос
```
EXPLAIN ANALYZE 
SELECT COUNT(seats.id) FROM seats
    JOIN hall_zones on seats.hall_zone_id = hall_zones.id
    JOIN sessions on sessions.hall_zone_id = hall_zones.id
    JOIN films ON sessions.film_id = films.id
WHERE films.name != 'Мстители' AND seats.hall_zone_id != 3
```

#### план на БД до 10000 строк
![alt text](md_screenshots/6_10000.png)

#### план на БД до 10000000 строк
![alt text](md_screenshots/6_10000000.png)

#### перечень оптимизаций
```
CREATE INDEX name ON public.films USING btree (name);
CREATE INDEX seat_hall_zone_id ON public.seats USING btree (hall_zone_id);
```
Добавление индексов ускорило выполнение запросов