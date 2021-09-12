# Домашнее задание 8

### Схема БД

<a href="https://dbdiagram.io/embed/61276a1a6dc2bb6073bc71c2">dbdiagram.io</a>

### Скрипт создания БД (с предыдущих занятий)

[Открыть](docker/postgres/init/ddl.sql)

### Скрипт заполнения БД тестовыми данными

[Скрипт на 10K строк](seeder10000.sql)<br>
[Скрипт на 10KK строк](seeder10000000.sql)

### Таблица с результатами по каждому из 6 запросов

[Открыть(PDF)](plans.pdf)

### Отсортированный список (15 значений) самых больших по размеру объектов БД (таблицы, включая индексы, сами индексы)

name                            | totalsize | relsize  <br>
---------------------------------+-----------+----------<br>
public.tickets                  | 848 MB    | 498 MB<br>
public.tickets_pkey             | 214 MB    | 214 MB<br>
public.tickets_client_id_idx    | 68 MB     | 68 MB<br>
public.tickets_session_id_idx   | 68 MB     | 68 MB<br>
public.clients                  | 20 MB     | 16 MB<br>
public.seats                    | 16 MB     | 10192 kB<br>
public.sessions                 | 12 MB     | 6672 kB<br>
public.clients_pkey             | 4408 kB   | 4408 kB<br>
public.seats_pkey               | 4408 kB   | 4408 kB<br>
public.sessions_pkey            | 2208 kB   | 2208 kB<br>
public.sessions_id_movie_id_idx | 2208 kB   | 2208 kB<br>
public.seats_hall_id_idx        | 1384 kB   | 1384 kB<br>
public.sessions_movie_id_idx    | 696 kB    | 696 kB<br>
pg_toast.pg_toast_2618          | 528 kB    | 480 kB<br>
public.halls                    | 176 kB    | 48 kB<br>
(15 rows)

## Отсортированные списки (по 5 значений) самых часто и редко используемых индексов
table              | index            | count <br>
--------------------+------------------+----------<br>
public.clients     | clients_pkey     | 10006419<br>
public.seats       | seats_pkey       | 10000004<br>
public.sessions    | sessions_pkey    | 10000000<br>
public.halls       | halls_pkey       |   500002<br>
public.seat_groups | seat_groups_pkey |   400001<br>
(5 rows)

table                   | index                | count <br>
-------------------------+----------------------+----------<br>
pg_toast.pg_toast_16410 | pg_toast_16410_index |        0<br>
public.halls            | halls_name_key       |        0<br>
pg_toast.pg_toast_16399 | pg_toast_16399_index |        0<br>
pg_toast.pg_toast_16386 | pg_toast_16386_index |        0<br>
pg_toast.pg_toast_16440 | pg_toast_16440_index |        0<br>
(5 rows)



