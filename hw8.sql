-- создадим залы
insert into hall (idHall, name)
values  (1, 'Синий зал'),
        (2, 'Красный зал'),
        (3, 'Зеленый зал'),
        (4, 'Желтый зал');

--добавим места
insert into place (row, seat, idhall)
select row, seat, hall
       from generate_series(1,10) as row,
            generate_series(1,10) as seat,
            generate_series(1,4) as hall;

--добавим клиентов
insert into client (name, email)
select 'Клиент ' || id||' '|| md5(random()::text),'Клиент' || id||'@'|| md5(random()::text)
from generate_series(1,10000) as id;

--добавим мероприятия
insert into show (name)
select 'Фильм ' || id||' '|| md5(random()::text)
from generate_series(1,25) as id;

insert into event (idhall, idshow, begintime)
select hall, show, now() - interval '1 day' * round(random()*100)
                         + interval '1 day' * round(random()*100)
                         - interval '1 hour' * round(random()*24)
                         - interval '1 minute' * round(random()*60)
                         - interval '1 sec' * round(random()*60)
from generate_series(1,25) as show,
     generate_series(1,4) as hall,
     generate_series(1,2) as multi;

-- заполняем 10 000 продаж
insert into ticketrealization ( timerealization, idclient, idevent, idplace, iprice)
select  now() - interval '1 day' * round(random()*100)
                         - interval '1 hour' * round(random()*24)
                         - interval '1 minute' * round(random()*60)
                         - interval '1 sec' * round(random()*60),
       c.idclient, round(random()*199)+1, round(random()*399)+1, 100
from client as c;


--растем до 10 000 000

--добавим зрелища теперь их 1000
insert into show (name)
select 'Фильм ' || id||' '|| md5(random()::text)
from generate_series(26,1000) as id;

--добавим клиентов теперь их 100 000
insert into client (name, email)
select 'Клиент ' || id||' '|| md5(random()::text),'Клиент' || id||'@'|| md5(random()::text)
from generate_series(10001,100000) as id;

-- 20 000 сеансов
insert into event (idhall, idshow, begintime)
select hall, show, now() - interval '1 day' * round(random()*100)
                         + interval '1 day' * round(random()*100)
                         - interval '1 hour' * round(random()*24)
                         - interval '1 minute' * round(random()*60)
                         - interval '1 sec' * round(random()*60)
from generate_series(1,1000) as show,
     generate_series(1,4) as hall,
     generate_series(1,50) as multi;

-- заполняем 10 000 000 продаж
insert into ticketrealization ( timerealization, idclient, idevent, idplace, iprice)
select  now() - interval '1 day' * round(random()*100)
                         - interval '1 hour' * round(random()*24)
                         - interval '1 minute' * round(random()*60)
                         - interval '1 sec' * round(random()*60),
       c.idclient, round(random()*19999)+1, round(random()*399)+1, 100
from client as c,
     generate_series(1,100);


-- 6 запросов
-- сеансы на сегодня
explain analyze
select e.begintime, s.name as showName
from event e
    join show s on e.idshow = s.idshow
where e.begintime between now()::date  and now()::date + interval '1 day';

--Оптимизация 10 000 000
CREATE INDEX event_begintime_index ON event USING btree (begintime);


--выручка за вчерашний день
explain analyze
select  sum(t.iprice)
from  ticketrealization t
where  t.timerealization between now()::date  - interval '1 day' and now()::date;


--Оптимизация 10 000 000
CREATE INDEX ticketrealization_timerealization_index ON ticketrealization USING btree (timerealization);

--10 самых популярных места
explain analyze
select h.name, p.row, p.seat, count(1), sum(t.iprice)
from ticketrealization t
    join place p on t.idplace = p.idplace
    join hall h on h.idhall = p.idhall
group by p.seat, p.row, h.name
order by 4 desc
limit 10;

--Оптимизация 10 000 000
CREATE INDEX ticketrealization_place_index ON ticketrealization USING btree (idplace);
CREATE INDEX place_hall_index ON place USING btree (idhall);



--сборы за вчерашний день
explain analyze
select s.name as showName, sum(t.iprice)
from event  e
    join show s on e.idshow = s.idshow
    join ticketrealization t on t.idevent = e.idevent
where  e.begintime between now()::date  - interval '1 day' and now()::date
group by s.name;


--Оптимизация 10 000 000
CREATE INDEX event_show_index ON event USING btree (idshow);
CREATE INDEX ticketrealization_event_index ON ticketrealization USING btree (idevent);


-- топ пять фильмов по сборам
explain analyze
select s.name as showName, sum(t.iprice)
from event e
    join show s on e.idshow = s.idshow
    join ticketrealization t on t.idevent = e.idevent
group by s.name
order by 2 desc
limit 5;

--список для рассылки клиентам, купившим билет на завтра
explain analyze
select s.name as showName, c.name as clientName, c.email
from ticketrealization t
    join event e on t.idevent = e.idevent
    join show s on e.idshow = s.idshow
    join client c on c.idclient = t.idclient
where  e.begintime between now()::date  + interval '1 day' and now()::date + interval '2 day';

--Оптимизация 10 000 000
CREATE INDEX ticketrealization_client_index ON ticketrealization USING btree (idclient);


--отсортированный список (15 значений) самых больших по размеру объектов БД (таблицы, включая индексы, сами индексы)

SELECT
    nspname || '.' || relname as name,
    pg_size_pretty(pg_total_relation_size(pg_class.oid)) as totalsize,
    pg_size_pretty(pg_relation_size(pg_class.oid)) as relsize
FROM pg_class
LEFT JOIN pg_namespace ON (pg_namespace.oid = pg_class.relnamespace)
WHERE nspname NOT IN ('pg_catalog', 'information_schema')
ORDER BY pg_total_relation_size(pg_class.oid) DESC
    LIMIT 15;

-- +----------------------------+---------+----------+
-- |name                        |totalsize|relsize   |
-- +----------------------------+---------+----------+
-- |public.ticketrealization    |946 MB   |731 MB    |
-- |public.ticketrealization_pk |214 MB   |214 MB    |
-- |public.event                |16 MB    |12 MB     |
-- |public.client               |16 MB    |13 MB     |
-- |public.event_pk             |4408 kB  |4408 kB   |
-- |public.client_pk            |2208 kB  |2208 kB   |
-- |pg_toast.pg_toast_2618      |528 kB   |480 kB    |
-- |public.show                 |152 kB   |88 kB     |
-- |pg_toast.pg_toast_2619      |96 kB    |48 kB     |
-- |public.place                |64 kB    |24 kB     |
-- |public.show_pk              |40 kB    |40 kB     |
-- |public.hall                 |24 kB    |8192 bytes|
-- |public.place_pk             |16 kB    |16 kB     |
-- |pg_toast.pg_toast_2618_index|16 kB    |16 kB     |
-- |public.hall_pk              |16 kB    |16 kB     |
-- +----------------------------+---------+----------+

--После добавления индексов

-- +-------------------------------------+---------+-------+
-- |name                                 |totalsize|relsize|
-- +-------------------------------------+---------+-------+
-- |public.ticketrealization             |1147 MB  |731 MB |
-- |public.ticketrealization_pk          |214 MB   |214 MB |
-- |public.ticketrealization_event_index |69 MB    |69 MB  |
-- |public.ticketrealization_place_index |66 MB    |66 MB  |
-- |public.ticketrealization_client_index|66 MB    |66 MB  |
-- |public.event                         |21 MB    |12 MB  |
-- |public.client                        |16 MB    |13 MB  |
-- |public.event_begintime_index         |4408 kB  |4408 kB|
-- |public.event_pk                      |4408 kB  |4408 kB|
-- |public.client_pk                     |2208 kB  |2208 kB|
-- |public.event_show_index              |1352 kB  |1352 kB|
-- |pg_toast.pg_toast_2618               |528 kB   |480 kB |
-- |public.show                          |152 kB   |88 kB  |
-- |pg_toast.pg_toast_2619               |96 kB    |48 kB  |
-- |public.place                         |80 kB    |24 kB  |
-- +-------------------------------------+---------+-------+




--отсортированные списки (по 5 значений) самых часто и редко используемых индексов
--часто
SELECT
    idx_stat.schemaname || '.' || idx_stat.relname table_name,
    idx_stat.indexrelname index_name,
    idx_stat.idx_scan
FROM pg_stat_all_indexes idx_stat
ORDER BY idx_scan DESC
    LIMIT 5;

-- +-----------------------------+---------------------------------------+--------+
-- |table_name                   |index_name                             |idx_scan|
-- +-----------------------------+---------------------------------------+--------+
-- |public.client                |client_pk                              |10010435|
-- |public.event                 |event_pk                               |10000047|
-- |public.hall                  |hall_pk                                |200600  |
-- |public.show                  |show_pk                                |200214  |
-- |pg_catalog.pg_db_role_setting|pg_db_role_setting_databaseid_rol_index|4190    |
-- +-----------------------------+---------------------------------------+--------+

--После добавления индексов

-- +-------------------------+--------------------------+--------+
-- |table_name               |index_name                |idx_scan|
-- +-------------------------+--------------------------+--------+
-- |public.client            |client_pk                 |10010441|
-- |public.event             |event_pk                  |10000058|
-- |public.hall              |hall_pk                   |200600  |
-- |public.show              |show_pk                   |200232  |
-- |pg_catalog.pg_description|pg_description_o_c_o_index|10585   |
-- +-------------------------+--------------------------+--------+



SELECT
    idx_stat.schemaname || '.' || idx_stat.relname table_name,
    idx_stat.indexrelname index_name,
    idx_stat.idx_scan
FROM pg_stat_all_indexes idx_stat
ORDER BY idx_scan
    LIMIT 5;
--редко
-- +------------------------+--------------------+--------+
-- |table_name              |index_name          |idx_scan|
-- +------------------------+--------------------+--------+
-- |public.ticketprice      |ticketprice_pk      |0       |
-- |pg_toast.pg_toast_2600  |pg_toast_2600_index |0       |
-- |pg_toast.pg_toast_25021 |pg_toast_25021_index|0       |
-- |public.ticketrealization|ticketrealization_pk|0       |
-- |pg_toast.pg_toast_2604  |pg_toast_2604_index |0       |
-- +------------------------+--------------------+--------+
