##Подготовить список из 6 основных запросов к БД, разработанной на предыдущих занятиях. Целесообразно выбрать 3 "простых" (задействована 1 таблица), 3 "сложных" (агрегатные функции, связи таблиц).
1. Выручка за определенную дату
`
   select sum(price) FROM sales sa
   LEFT JOIN sessions se ON se.id = sa.session_id
   WHERE date = '2010-01-01' AND hall_id = 1;
`
2. Выручка за месяц
`
   select sum(price) FROM sales sa
   LEFT JOIN sessions se ON se.id = sa.session_id
   WHERE date_part('year', date) = 2010 AND date_part('month', date) = 1;
`
3. Выручка за месяц по определенному фильму
`
   select sum(price) FROM sales sa
   LEFT JOIN sessions se ON se.id = sa.session_id
   WHERE date_part('year', date) = 2010 AND date_part('month', date) = 1 AND film_id = 5161;
`
4. Инфориация о сеансе
`
   select s.*, h.* FROM sessions s
   LEFT JOIN halls h ON s.hall_id = h.id
   WHERE date = '2010-01-01'
   AND time = '09:00:00'
   AND hall_id = 1;
`
5. Продажи по конкретному сеансу
`
   select sa.*, se.* FROM sales sa
   LEFT JOIN sessions se ON se.id = sa.session_id
   WHERE date = '2010-01-01'
   AND time = '09:00:00'
   AND hall_id = 1;
`
6. Фильм с максимальрой доходностью
`
   SELECT films.id, sum(sales.price), films.name FROM sales
   LEFT JOIN sessions ON sessions.id = sales.session_id
   LEFT JOIN films ON films.id = sessions.film_id
   GROUP BY films.id ORDER BY sum(sales.price) DESC LIMIT 1;
`


##Скрипт для наполнения основных таблиц БД тестовыми данными за 1 месяц за 1 год (500 000 строк в таблице sales).Провести анализ производительности запросов к БД, сохранить планы выполнения.
Создать БД и выполнить скрипт ddl.sql
Добавить функции выполнить файл functions.sql
Выполнить скрипт insert_data_2009_12.sql
Провести анализ запросов - результат сохранить в папке explain_2009_12


Сделать еще один инстанс БД
Добавить функции выполнить файл functions.sql
Выполнить скрипт insert_data_2010.sql
Провести анализ запросов - результат сохранить в папке explain_2010



##Отсортированные списки (по 5 значений) самых часто и редко используемых индексов
<a href="https://wiki.postgresql.org/wiki/Index_Maintenance">Источник</a>

Иноформация

seq_scan - количество последовательных чтений, запущенных по этой таблице.
seq_tup_read  - количество "живых" строк, прочитанных при последовательных чтениях.
idx_scan - количество сканирований по индексу, запущенных по этой таблице.
idx_tup_fetch - количество "живых" строк, отобранных при сканированиях по индексу.
Количество вставленных, изменённых, удалённых строк:
n_tup_ins
n_tup_upd
n_tup_del

###Запрос
`
SELECT
    t.schemaname,
    t.tablename,
    c.reltuples::bigint                            AS num_rows,
    pg_size_pretty(pg_relation_size(c.oid))        AS table_size,
    psai.indexrelname                              AS index_name,
    pg_size_pretty(pg_relation_size(i.indexrelid)) AS index_size,
    CASE WHEN i.indisunique THEN 'Y' ELSE 'N' END  AS "unique",
    psai.idx_scan                                  AS number_of_scans,
    psai.idx_tup_read                              AS tuples_read,
    psai.idx_tup_fetch                             AS tuples_fetched
FROM
    pg_tables t
    LEFT JOIN pg_class c ON t.tablename = c.relname
    LEFT JOIN pg_index i ON c.oid = i.indrelid
    LEFT JOIN pg_stat_all_indexes psai ON i.indexrelid = psai.indexrelid
WHERE
    t.schemaname NOT IN ('pg_catalog', 'information_schema')
ORDER BY 9;
`
###Результат для данных за 1 месяц
| schemaname 	| tablename        	| num_rows 	| table_size 	| index_name                              	| index_size 	| unique 	| number_of_scans 	| tuples_read 	| tuples_fetched 	|
|------------	|------------------	|----------	|------------	|-----------------------------------------	|------------	|--------	|-----------------	|-------------	|----------------	|
| public     	| attribute_types  	| 0        	| 0 bytes    	| attribute_types_pkey                    	| 8192 bytes 	| Y      	| 0               	| 0           	| 0              	|
| public     	| attribute_values 	| 0        	| 0 bytes    	| attribute_values_pkey                   	| 8192 bytes 	| Y      	| 0               	| 0           	| 0              	|
| public     	| attributes       	| 0        	| 0 bytes    	| attributes_pkey                         	| 8192 bytes 	| Y      	| 0               	| 0           	| 0              	|
| public     	| sales            	| 523280   	| 26 MB      	| sales_index_price                       	| 11 MB      	| N      	| 0               	| 0           	| 0              	|
| public     	| halls            	| 0        	| 8192 bytes 	| halls_name_key                          	| 16 kB      	| Y      	| 0               	| 0           	| 0              	|

###Результат для данных за 1 год
| schemaname 	| tablename        	| num_rows 	| table_size 	| index_name                              	| index_size 	| unique 	| number_of_scans 	| tuples_read 	| tuples_fetched 	|
|------------	|------------------	|----------	|------------	|-----------------------------------------	|------------	|--------	|-----------------	|-------------	|----------------	|
| public     	| attribute_types  	| 0        	| 0 bytes    	| attribute_types_pkey                    	| 8192 bytes 	| Y      	| 0               	| 0           	| 0              	|
| public     	| attribute_values 	| 0        	| 0 bytes    	| attribute_values_pkey                   	| 8192 bytes 	| Y      	| 0               	| 0           	| 0              	|
| public     	| attributes       	| 0        	| 0 bytes    	| attributes_pkey                         	| 8192 bytes 	| Y      	| 0               	| 0           	| 0              	|
| public     	| sessions         	| 29200    	| 2976 kB    	| sessions_index_date_month               	| 656 kB     	| N      	| 0               	| 0           	| 0              	|
| public     	| halls            	| 0        	| 8192 bytes 	| halls_name_key                          	| 16 kB      	| Y      	| 0               	| 0           	| 0              	|


##Отсортированный список (15 значений) самых больших по размеру объектов БД (таблицы, включая индексы, сами индексы)

<a href="https://wiki.postgresql.org/wiki/Index_Maintenance">Источник</a>

###Запрос
`
SELECT nspname || '.' || relname AS "relation",
pg_size_pretty(pg_relation_size(C.oid)) AS "size"
FROM pg_class C
LEFT JOIN pg_namespace N ON (N.oid = C.relnamespace)
WHERE nspname NOT IN ('pg_catalog', 'information_schema')
ORDER BY pg_relation_size(C.oid) DESC
LIMIT 15;
`
###Результат для данных за 1 месяц
| relation                                       	| size   	|
|------------------------------------------------	|--------	|
| public.sales                                   	| 26 MB  	|
| public.sales_index_price                       	| 11 MB  	|
| public.sales_index_session_id                  	| 11 MB  	|
| public.sales_pkey                              	| 11 MB  	|
| public.sales_session_id_row_seat_key           	| 11 MB  	|
| public.films                                   	| 832 kB 	|
| pg_toast.pg_toast_2618                         	| 464 kB 	|
| public.films_pkey                              	| 240 kB 	|
| public.sessions                                	| 128 kB 	|
| public.sessions_hall_id_date_time_key          	| 112 kB 	|
| public.sessions_pkey                           	| 72 kB  	|
| public.sessions_index_date_year                	| 72 kB  	|
| public.sessions_index_date_month               	| 72 kB  	|
| public.sessions_index_film_id                  	| 72 kB  	|
| public.prices_row_min_row_max_time_hall_id_key 	| 40 kB  	|

###Результат для данных за 1 год
| relation                                       	| size    	|
|------------------------------------------------	|---------	|
| public.sales                                   	| 328 MB  	|
| public.sales_pkey                              	| 261 MB  	|
| public.sales_session_id_row_seat_key           	| 260 MB  	|
| public.sessions                                	| 2976 kB 	|
| public.sessions_pkey                           	| 1296 kB 	|
| public.sessions_hall_id_date_time_key          	| 912 kB  	|
| public.films                                   	| 840 kB  	|
| public.sessions_index_date_month               	| 656 kB  	|
| public.sessions_index_date_year                	| 656 kB  	|
| pg_toast.pg_toast_2618                         	| 464 kB  	|
| public.films_pkey                              	| 240 kB  	|
| public.prices_row_min_row_max_time_hall_id_key 	| 56 kB   	|
| public.prices                                  	| 48 kB   	|
| public.fki_prices_hall_id_fkey                 	| 48 kB   	|
| pg_toast.pg_toast_2619                         	| 32 kB   	|
