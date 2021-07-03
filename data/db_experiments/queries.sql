---------------------------------------------------------
--Опыт простого запроса 1.
---------------------------------------------------------

EXPLAIN ANALYZE SELECT id, name FROM movies WHERE NAME LIKE '%27SEpg%';
--QUERY PLAN
---------------------------------------------------------------------------------------------------
--Seq Scan on movies  (cost=0.00..181.00 rows=1 width=12) (actual time=0.866..0.867 rows=1 loops=1)
--   Filter: ((name)::text ~~ '%27SEpg%'::text)
--   Rows Removed by Filter: 9999
-- Planning Time: 0.073 ms
-- Execution Time: 0.877 ms
--(5 rows)

create index movies_name_idx on "movies" using btree ("name");
--CREATE INDEX

EXPLAIN ANALYZE SELECT id, name FROM movies WHERE NAME LIKE '%27SEpg%';
--QUERY PLAN
---------------------------------------------------------------------------------------------------
--Seq Scan on movies  (cost=0.00..181.00 rows=1 width=12) (actual time=0.896..0.897 rows=1 loops=1)
--   Filter: ((name)::text ~~ '%27SEpg%'::text)
--   Rows Removed by Filter: 9999
-- Planning Time: 0.116 ms
-- Execution Time: 0.906 ms
--(5 rows)

---------------------------------------------------------
--ВЫВОД:
--Прироста никакого от индекса в данном случае нет
---------------------------------------------------------


---------------------------------------------------------
--Опыт простого запроса 2.
---------------------------------------------------------

EXPLAIN ANALYZE SELECT * FROM movie_attribute_values WHERE val_date BETWEEN current_date - interval '10' DAY AND NOW();
-- QUERY PLAN
--------------------------------------------------------------------------------------------------------------------------
--Seq Scan on movie_attribute_values  (cost=0.00..313.66 rows=5006 width=117) (actual time=0.005..1.652 rows=5007 loops=1)
--   Filter: ((val_date <= now()) AND (val_date >= (CURRENT_DATE - '10 days'::interval day)))
--   Rows Removed by Filter: 5067
-- Planning Time: 0.102 ms
-- Execution Time: 1.806 ms
--(5 rows)

create index movie_attribute_values_date_idx on "movie_attribute_values" using btree ("val_date");
--CREATE INDEX

EXPLAIN ANALYZE SELECT * FROM movie_attribute_values WHERE val_date BETWEEN current_date - interval '10' DAY AND NOW();
--QUERY PLAN
------------------------------------------------------------------------------------------------------
--Bitmap Heap Scan on movie_attribute_values  (cost=91.61..291.27 rows=5007 width=117) (actual time=0.466..0.932 rows=5007 loops=1)
--   Recheck Cond: ((val_date >= (CURRENT_DATE - '10 days'::interval day)) AND (val_date <= now()))
--   Heap Blocks: exact=87
--   ->  Bitmap Index Scan on movie_attribute_values_date_idx  (cost=0.00..90.36 rows=5007 width=0) (actual time=0.455..0.455 rows=500
--7 loops=1)
--         Index Cond: ((val_date >= (CURRENT_DATE - '10 days'::interval day)) AND (val_date <= now()))
--Planning Time: 0.328 ms
--Execution Time: 1.085 ms
--(7 rows)

---------------------------------------------------------
--ВЫВОД:
--postgres задействовал индексы и получил прирост в скорости. На больших объемах вполне ощутимо
---------------------------------------------------------

---------------------------------------------------------
--Опыт простого запроса 3.
---------------------------------------------------------
EXPLAIN ANALYZE SELECT * FROM movie_attribute_values WHERE val_int > 100;
--QUERY PLAN
--------------------------------------------------------------------------
-- Seq Scan on movie_attribute_values  (cost=0.00..212.93 rows=1 width=117) (actual time=0.678..0.678 rows=0 loops=1)
--Filter: (val_int > 100)
--   Rows Removed by Filter: 10074
-- Planning Time: 0.076 ms
-- Execution Time: 0.691 ms
--(5 rows)

create index movie_attribute_values_int_idx on "movie_attribute_values" using btree ("val_int");
--CREATE INDEX

EXPLAIN ANALYZE SELECT * FROM movie_attribute_values WHERE val_int > 100;
--QUERY PLAN
---------------------------------------------------------------------------------------------------------------
-- Index Scan using movie_attribute_values_int_idx on movie_attribute_values  (cost=0.29..8.30 rows=1 width=117) (actual time=0.011..0
--.011 rows=0 loops=1)
--   Index Cond: (val_int > 100)
-- Planning Time: 0.159 ms
-- Execution Time: 0.024 ms
--(4 rows)

---------------------------------------------------------
--ВЫВОД:
--postgres задействовал индексы и получил прирост в скорости
---------------------------------------------------------

---------------------------------------------------------
-- Опыт сложного запроса 1.
-- Вывести не более 2 примеров фильмов для каждой награды
---------------------------------------------------------

SELECT SUB_QUERY.movie, SUB_QUERY.award FROM
    (
        SELECT
            movies.name AS movie,
            movie_awards.name AS award,
            ROW_NUMBER () OVER(PARTITION BY movie_awards.name ORDER BY movie_awards.name) AS row_number
        FROM
            movies
                JOIN movie_attribute_values ON movie_attribute_values.movie_id = movies.id
                JOIN movie_awards ON movie_awards.id = movie_attribute_values.val_movie_award_id
                JOIN movie_attributes ON movie_attributes.id = movie_attribute_values.movie_attribute_id
                JOIN movie_attribute_type ON movie_attribute_type.id = movie_attributes.movie_attribute_type_id
        WHERE
                movie_attribute_type.name = 'Награда'
    ) SUB_QUERY
WHERE
    SUB_QUERY.row_number <= 2;

---------------------------------------------------------
-- Опыт сложного запроса 2.
-- Вывести атрибуты фильмов и их значения
---------------------------------------------------------

EXPLAIN ANALYZE SELECT
    movies.name,
    movie_attribute_type.name,
    movie_attributes.name,
    COALESCE(
            movie_attribute_values.val_text,
            movie_attribute_values.val_date::VARCHAR,
            movie_attribute_values.val_int::VARCHAR,
            movie_awards.name,
            ''
        )
FROM
    movies
LEFT JOIN movie_attribute_values ON movie_attribute_values.movie_id = movies.id
INNER JOIN movie_attributes ON movie_attribute_values.movie_attribute_id = movie_attributes.id
INNER JOIN movie_attribute_type ON movie_attributes.movie_attribute_type_id = movie_attribute_type.id
LEFT JOIN movie_awards ON movie_attribute_values.val_movie_award_id = movie_awards.id;

--QUERY PLAN

------------------------------------------------------------------------------------------------------------------------------------
---------------
--Hash Left Join  (cost=857.15..1252.23 rows=10074 width=563) (actual time=5.966..17.062 rows=10074 loops=1)
--   Hash Cond: (movie_attribute_values.val_movie_award_id = movie_awards.id)
--   ->  Hash Join  (cost=576.15..844.05 rows=10074 width=603) (actual time=3.809..12.486 rows=10074 loops=1)
--         Hash Cond: (movie_attributes.movie_attribute_type_id = movie_attribute_type.id)
--         ->  Hash Join  (cost=563.00..803.65 rows=10074 width=91) (actual time=3.796..10.421 rows=10074 loops=1)
--               Hash Cond: (movie_attribute_values.movie_attribute_id = movie_attributes.id)
--               ->  Hash Join  (cost=281.00..495.20 rows=10074 width=84) (actual time=1.872..5.725 rows=10074 loops=1)
--                     Hash Cond: (movie_attribute_values.movie_id = movies.id)
--                     ->  Seq Scan on movie_attribute_values  (cost=0.00..187.74 rows=10074 width=80) (actual time=0.005..0.785 rows=
--10074 loops=1)
--                     ->  Hash  (cost=156.00..156.00 rows=10000 width=12) (actual time=1.853..1.855 rows=10000 loops=1)
--                           Buckets: 16384  Batches: 1  Memory Usage: 584kB
--                           ->  Seq Scan on movies  (cost=0.00..156.00 rows=10000 width=12) (actual time=0.004..0.879 rows=10000 loop
--s=1)
--               ->  Hash  (cost=157.00..157.00 rows=10000 width=15) (actual time=1.914..1.915 rows=10000 loops=1)
--                     Buckets: 16384  Batches: 1  Memory Usage: 605kB
--                     ->  Seq Scan on movie_attributes  (cost=0.00..157.00 rows=10000 width=15) (actual time=0.003..0.878 rows=10000
--loops=1)
--         ->  Hash  (cost=11.40..11.40 rows=140 width=520) (actual time=0.010..0.010 rows=4 loops=1)
--               Buckets: 1024  Batches: 1  Memory Usage: 9kB
--               ->  Seq Scan on movie_attribute_type  (cost=0.00..11.40 rows=140 width=520) (actual time=0.007..0.008 rows=4 loops=1)
--   ->  Hash  (cost=156.00..156.00 rows=10000 width=13) (actual time=2.139..2.140 rows=10000 loops=1)
--         Buckets: 16384  Batches: 1  Memory Usage: 584kB
--         ->  Seq Scan on movie_awards  (cost=0.00..156.00 rows=10000 width=13) (actual time=0.005..0.863 rows=10000 loops=1)
-- Planning Time: 7.415 ms
-- Execution Time: 17.433 ms
--(23 rows)

---------------------------------------------------------
-- Опыт сложного запроса 3.
-- Вывести запланированные дела для каждого фильма. Две группировки - запланированные до 20 дней и после.
---------------------------------------------------------

EXPLAIN ANALYZE SELECT
   movies.name,
   array_agg(
           CASE WHEN movie_attribute_values.val_date BETWEEN NOW() AND (NOW() + INTERVAL '20 days') THEN movie_attributes.name::VARCHAR END
       ),
   array_agg(
           CASE WHEN movie_attribute_values.val_date >= NOW() + INTERVAL '20 days' THEN movie_attributes.name::VARCHAR END
       )
FROM
   movies
       LEFT JOIN movie_attribute_values ON movie_attribute_values.movie_id = movies.id
       INNER JOIN movie_attributes ON movie_attribute_values.movie_attribute_id = movie_attributes.id
       INNER JOIN movie_attribute_type ON movie_attributes.movie_attribute_type_id = movie_attribute_type.id
WHERE movie_attribute_type.id = 10
GROUP BY movies.id;
--QUERY PLAN
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- GroupAggregate  (cost=866.00..979.44 rows=2521 width=76) (actual time=5.350..7.202 rows=2251 loops=1)
--   Group Key: movies.id
--   ->  Sort  (cost=866.00..872.30 rows=2521 width=27) (actual time=5.336..5.444 rows=2529 loops=1)
--         Sort Key: movies.id
--         Sort Method: quicksort  Memory: 294kB
--         ->  Nested Loop  (cost=459.13..723.57 rows=2521 width=27) (actual time=3.073..5.082 rows=2529 loops=1)
--               ->  Index Only Scan using movie_attribute_type_pkey on movie_attribute_type  (cost=0.14..8.16 rows=1 width=4) (actual time=0.005..0.008 rows=1 loops=1)
--                     Index Cond: (id = 10)
--                     Heap Fetches: 1
--               ->  Hash Join  (cost=458.98..690.19 rows=2521 width=31) (actual time=3.067..4.832 rows=2529 loops=1)
--                     Hash Cond: (movies.id = movie_attribute_values.movie_id)
--                     ->  Seq Scan on movies  (cost=0.00..156.00 rows=10000 width=12) (actual time=0.005..0.531 rows=10000 loops=1)
--                     ->  Hash  (cost=427.47..427.47 rows=2521 width=23) (actual time=3.053..3.054 rows=2529 loops=1)
--                           Buckets: 4096  Batches: 1  Memory Usage: 173kB
--                           ->  Hash Join  (cost=213.28..427.47 rows=2521 width=23) (actual time=1.022..2.777 rows=2529 loops=1)
--                                 Hash Cond: (movie_attribute_values.movie_attribute_id = movie_attributes.id)
--                                 ->  Seq Scan on movie_attribute_values  (cost=0.00..187.74 rows=10074 width=16) (actual time=0.002..0.544 rows=10074 loops=1)
--                                 ->  Hash  (cost=182.00..182.00 rows=2502 width=15) (actual time=1.013..1.014 rows=2502 loops=1)
--                                       Buckets: 4096  Batches: 1  Memory Usage: 152kB
--                                       ->  Seq Scan on movie_attributes  (cost=0.00..182.00 rows=2502 width=15) (actual time=0.004..0.755 rows=2502 loops=1)
--                                             Filter: (movie_attribute_type_id = 10)
--                                             Rows Removed by Filter: 7498
-- Planning Time: 0.297 ms
-- Execution Time: 7.312 ms
--(24 rows)

---------------------------------------------------------
-- Опыты сложных запросов совершенно однозначно показывают пользу связующих индексов между таблицами на большом объеме данных
---------------------------------------------------------
