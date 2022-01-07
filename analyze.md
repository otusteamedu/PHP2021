1 запрос: не NULL значение атрибута (10000 строк)

EXPLAIN ANALYZE SELECT films.name AS film_name,
attribute_type.name AS attribute_type_name,
attribute.name AS attribute_name,
CASE
WHEN attribute_value."int" IS NOT NULL THEN attribute_value."int"::text
WHEN attribute_value."float" IS NOT NULL THEN attribute_value."float"::text
WHEN attribute_value.text IS NOT NULL THEN attribute_value.text
WHEN attribute_value.datetime IS NOT NULL THEN attribute_value.datetime::text
WHEN attribute_value.bool IS NOT NULL THEN attribute_value.bool::text
ELSE NULL::text
END AS attribute_value_name
FROM films
LEFT JOIN attribute_value ON films.id = attribute_value.film
LEFT JOIN attribute ON attribute_value.atribute = attribute.id
LEFT JOIN attribute_type ON attribute.attribute_type = attribute_type.id;
QUERY PLAN
--------------------------------------------------------------------------------------------------------------------------------------
Hash Left Join  (cost=79.83..582.87 rows=10000 width=102) (actual time=0.299..29.266 rows=10090 loops=1)
Hash Cond: (attribute.attribute_type = attribute_type.id)
->  Hash Left Join  (cost=41.25..342.95 rows=10000 width=111) (actual time=0.268..19.740 rows=10090 loops=1)
Hash Cond: (attribute_value.atribute = attribute.id)
->  Hash Right Join  (cost=4.25..279.61 rows=10000 width=79) (actual time=0.184..11.948 rows=10090 loops=1)
Hash Cond: (attribute_value.film = films.id)
->  Seq Scan on attribute_value  (cost=0.00..248.00 rows=10000 width=77) (actual time=0.007..2.655 rows=10000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.161..0.163 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.022..0.097 rows=100 loops=1)
->  Hash  (cost=22.00..22.00 rows=1200 width=40) (actual time=0.039..0.040 rows=30 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 18kB
->  Seq Scan on attribute  (cost=0.00..22.00 rows=1200 width=40) (actual time=0.008..0.020 rows=30 loops=1)
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.016..0.017 rows=10 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on attribute_type  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.005..0.009 rows=10 loops=1)
Planning Time: 0.658 ms
Execution Time: 30.286 ms
(18 rows)

создаем индекс
create index AVNN on "attribute_value" using btree ("int","float","text","datetime","bool")  where "int" IS NOT NULL or "float" IS NOT NULL or "text" IS NOT NULL or "datetime" IS NOT NULL or "bool" IS NOT NULL;

выполняем explain analyze

EXPLAIN ANALYZE SELECT films.name AS film_name,                                                                                                                                                                    
attribute_type.name AS attribute_type_name,
attribute.name AS attribute_name,
CASE                                                 
WHEN attribute_value."int" IS NOT NULL THEN attribute_value."int"::text
WHEN attribute_value."float" IS NOT NULL THEN attribute_value."float"::text
WHEN attribute_value.text IS NOT NULL THEN attribute_value.text
WHEN attribute_value.datetime IS NOT NULL THEN attribute_value.datetime::text
WHEN attribute_value.bool IS NOT NULL THEN attribute_value.bool::text
ELSE NULL::text
END AS attribute_value_name
FROM films
LEFT JOIN attribute_value ON films.id = attribute_value.film
LEFT JOIN attribute ON attribute_value.atribute = attribute.id
LEFT JOIN attribute_type ON attribute.attribute_type = attribute_type.id;
QUERY PLAN
--------------------------------------------------------------------------------------------------------------------------------------
Hash Left Join  (cost=79.83..582.87 rows=10000 width=102) (actual time=0.218..11.998 rows=10090 loops=1)
Hash Cond: (attribute.attribute_type = attribute_type.id)
->  Hash Left Join  (cost=41.25..342.95 rows=10000 width=111) (actual time=0.188..8.088 rows=10090 loops=1)
Hash Cond: (attribute_value.atribute = attribute.id)
->  Hash Right Join  (cost=4.25..279.61 rows=10000 width=79) (actual time=0.141..4.905 rows=10090 loops=1)
Hash Cond: (attribute_value.film = films.id)
->  Seq Scan on attribute_value  (cost=0.00..248.00 rows=10000 width=77) (actual time=0.006..1.076 rows=10000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.119..0.120 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.020..0.060 rows=100 loops=1)
->  Hash  (cost=22.00..22.00 rows=1200 width=40) (actual time=0.037..0.037 rows=30 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 18kB
->  Seq Scan on attribute  (cost=0.00..22.00 rows=1200 width=40) (actual time=0.006..0.018 rows=30 loops=1)
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.015..0.015 rows=10 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on attribute_type  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.004..0.008 rows=10 loops=1)
Planning Time: 1.166 ms
Execution Time: 12.458 ms
(18 rows)

Вывод: создание индекса позволили уменьшить более, чем в два раза время выполнение скрипта

увеличим количество строк в таблице до 10000000

выполним анализ

EXPLAIN ANALYZE SELECT films.name AS film_name,                                                                                                                                                                    
attribute_type.name AS attribute_type_name,
attribute.name AS attribute_name,
CASE                                                 
WHEN attribute_value."int" IS NOT NULL THEN attribute_value."int"::text
WHEN attribute_value."float" IS NOT NULL THEN attribute_value."float"::text
WHEN attribute_value.text IS NOT NULL THEN attribute_value.text
WHEN attribute_value.datetime IS NOT NULL THEN attribute_value.datetime::text
WHEN attribute_value.bool IS NOT NULL THEN attribute_value.bool::text
ELSE NULL::text
END AS attribute_value_name
FROM films
LEFT JOIN attribute_value ON films.id = attribute_value.film
LEFT JOIN attribute ON attribute_value.atribute = attribute.id
LEFT JOIN attribute_type ON attribute.attribute_type = attribute_type.id;
QUERY PLAN
------------------------------------------------------------------------------------------------------------------------------------------------
Hash Left Join  (cost=79.83..502225.32 rows=9998414 width=102) (actual time=168.782..4254.826 rows=10000090 loops=1)
Hash Cond: (attribute.attribute_type = attribute_type.id)
->  Hash Left Join  (cost=41.25..300881.08 rows=9998414 width=111) (actual time=168.770..2929.869 rows=10000090 loops=1)
Hash Cond: (attribute_value.atribute = attribute.id)
->  Hash Right Join  (cost=4.25..274505.55 rows=9998414 width=79) (actual time=168.754..1952.994 rows=10000090 loops=1)
Hash Cond: (attribute_value.film = films.id)
->  Seq Scan on attribute_value  (cost=0.00..247143.14 rows=9998414 width=77) (actual time=0.035..668.274 rows=10000000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=168.713..168.714 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=168.668..168.692 rows=100 loops=1)
->  Hash  (cost=22.00..22.00 rows=1200 width=40) (actual time=0.009..0.009 rows=30 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 18kB
->  Seq Scan on attribute  (cost=0.00..22.00 rows=1200 width=40) (actual time=0.003..0.005 rows=30 loops=1)
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.008..0.008 rows=10 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on attribute_type  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.006..0.006 rows=10 loops=1)
Planning Time: 0.388 ms
JIT:
Functions: 27
Options: Inlining true, Optimization true, Expressions true, Deforming true
Timing: Generation 1.960 ms, Inlining 12.560 ms, Optimization 96.088 ms, Emission 59.784 ms, Total 170.393 ms
Execution Time: 4446.035 ms
(22 rows)

выполним с индексом

EXPLAIN ANALYZE SELECT films.name AS film_name,                                                                                                                                                                    
attribute_type.name AS attribute_type_name,
attribute.name AS attribute_name,
CASE                                                 
WHEN attribute_value."int" IS NOT NULL THEN attribute_value."int"::text
WHEN attribute_value."float" IS NOT NULL THEN attribute_value."float"::text
WHEN attribute_value.text IS NOT NULL THEN attribute_value.text
WHEN attribute_value.datetime IS NOT NULL THEN attribute_value.datetime::text
WHEN attribute_value.bool IS NOT NULL THEN attribute_value.bool::text
ELSE NULL::text
END AS attribute_value_name
FROM films
LEFT JOIN attribute_value ON films.id = attribute_value.film
LEFT JOIN attribute ON attribute_value.atribute = attribute.id
LEFT JOIN attribute_type ON attribute.attribute_type = attribute_type.id;
QUERY PLAN
-------------------------------------------------------------------------------------------------------------------------------------------------
Hash Left Join  (cost=79.83..502281.63 rows=10000000 width=102) (actual time=174.288..4295.016 rows=10000090 loops=1)
Hash Cond: (attribute.attribute_type = attribute_type.id)
->  Hash Left Join  (cost=41.25..300905.45 rows=10000000 width=111) (actual time=174.280..2964.179 rows=10000090 loops=1)
Hash Cond: (attribute_value.atribute = attribute.id)
->  Hash Right Join  (cost=4.25..274525.75 rows=10000000 width=79) (actual time=174.263..1984.319 rows=10000090 loops=1)
Hash Cond: (attribute_value.film = films.id)
->  Seq Scan on attribute_value  (cost=0.00..247159.00 rows=10000000 width=77) (actual time=0.047..669.356 rows=10000000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=174.209..174.210 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=174.173..174.188 rows=100 loops=1)
->  Hash  (cost=22.00..22.00 rows=1200 width=40) (actual time=0.009..0.010 rows=30 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 18kB
->  Seq Scan on attribute  (cost=0.00..22.00 rows=1200 width=40) (actual time=0.003..0.005 rows=30 loops=1)
->  Hash  (cost=22.70..22.70 rows=1270 width=36) (actual time=0.005..0.005 rows=10 loops=1)
Buckets: 2048  Batches: 1  Memory Usage: 17kB
->  Seq Scan on attribute_type  (cost=0.00..22.70 rows=1270 width=36) (actual time=0.002..0.003 rows=10 loops=1)
Planning Time: 1.341 ms
JIT:
Functions: 27
Options: Inlining true, Optimization true, Expressions true, Deforming true
Timing: Generation 3.994 ms, Inlining 10.591 ms, Optimization 103.445 ms, Emission 59.900 ms, Total 177.930 ms
Execution Time: 4488.364 ms
(22 rows)

Вывод: индекс не дал никаких результатов, возможно из-за того что очень много неуникальных значений

2 запрос: задачи актуальные на сегодня, задачи актуальные через 20 дней (10000 строк)

анализ без индекса

EXPLAIN ANALYZE SELECT films.name AS film_name,
CASE
WHEN attribute_value.datetime::date = now()::date THEN attribute_value.datetime
ELSE NULL::timestamp without time zone
END AS today,
CASE
WHEN attribute_value.datetime::date = (now()::date + '20 days'::interval) THEN attribute_value.datetime
ELSE NULL::timestamp without time zone
END AS future
FROM films
LEFT JOIN attribute_value ON films.id = attribute_value.atribute
LEFT JOIN attribute ON attribute_value.atribute = attribute.id
LEFT JOIN attribute_type ON attribute.attribute_type = attribute_type.id
WHERE attribute_type.name::text = 'dateTime'::text AND (attribute_value.datetime::date = now()::date OR attribute_value.datetime = (now()::date + '20 days'::interval))
GROUP BY films.name, (
CASE
WHEN attribute_value.datetime::date = now()::date THEN attribute_value.datetime
ELSE NULL::timestamp without time zone
END), (
CASE
WHEN attribute_value.datetime::date = (now()::date + '20 days'::interval) THEN attribute_value.datetime
ELSE NULL::timestamp without time zone
END);
QUERY PLAN
                                                                                                
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------
Group  (cost=148386.01..148386.04 rows=1 width=22) (actual time=227.396..227.398 rows=0 loops=1)
Group Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::date + '20 d
ays'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
->  Sort  (cost=148386.01..148386.01 rows=1 width=22) (actual time=227.395..227.396 rows=0 loops=1)
Sort Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::date +
'20 days'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
Sort Method: quicksort  Memory: 25kB
->  Nested Loop  (cost=0.00..148386.00 rows=1 width=22) (actual time=227.384..227.385 rows=0 loops=1)
Join Filter: (attribute_value.atribute = films.id)
->  Nested Loop  (cost=0.00..148381.73 rows=1 width=16) (actual time=227.383..227.384 rows=0 loops=1)
Join Filter: (attribute.attribute_type = attribute_type.id)
->  Nested Loop  (cost=0.00..148351.97 rows=43 width=20) (actual time=227.383..227.383 rows=0 loops=1)
Join Filter: (attribute_value.atribute = attribute.id)
->  Seq Scan on attribute  (cost=0.00..22.00 rows=1200 width=8) (actual time=0.014..0.016 rows=30 loops=1)
->  Materialize  (cost=0.00..147556.07 rows=43 width=12) (actual time=7.579..7.579 rows=0 loops=30)
->  Seq Scan on attribute_value  (cost=0.00..147555.86 rows=43 width=12) (actual time=227.358..227.358 rows=0 loops=1)
Filter: (((datetime)::date = (now())::date) OR (datetime = ((now())::date + '20 days'::interval)))
Rows Removed by Filter: 10000
->  Materialize  (cost=0.00..25.91 rows=6 width=4) (never executed)
->  Seq Scan on attribute_type  (cost=0.00..25.88 rows=6 width=4) (never executed)
Filter: ((name)::text = 'dateTime'::text)
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (never executed)
Planning Time: 1.366 ms
JIT:
Functions: 24
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 6.004 ms, Inlining 0.000 ms, Optimization 0.670 ms, Emission 11.485 ms, Total 18.158 ms
Execution Time: 233.545 ms
(26 rows)

создадим индекс
create index AVDT on "attribute_value" using btree ("int","float","text","datetime","bool")  where "datetime" IS NOT NULL;

выполним анализ

QUERY PLAN
                                                                                                
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------
Group  (cost=32160.09..32160.13 rows=1 width=22) (actual time=6.137..6.140 rows=0 loops=1)
Group Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::date + '20 d
ays'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
->  Sort  (cost=32160.09..32160.10 rows=1 width=22) (actual time=6.136..6.139 rows=0 loops=1)
Sort Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::date +
'20 days'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
Sort Method: quicksort  Memory: 25kB
->  Nested Loop  (cost=566.86..32160.08 rows=1 width=22) (actual time=6.128..6.130 rows=0 loops=1)
->  Hash Join  (cost=566.71..32149.21 rows=51 width=18) (actual time=6.127..6.129 rows=0 loops=1)
Hash Cond: (attribute_value.atribute = films.id)
->  Nested Loop  (cost=562.46..32144.81 rows=51 width=20) (actual time=6.011..6.012 rows=0 loops=1)
->  Bitmap Heap Scan on attribute_value  (cost=562.30..32115.20 rows=51 width=12) (actual time=6.010..6.011 rows=0 loops=1)
Recheck Cond: (datetime IS NOT NULL)
Filter: (((datetime)::date = (now())::date) OR (datetime = ((now())::date + '20 days'::interval)))
Rows Removed by Filter: 10000
Heap Blocks: exact=167
->  Bitmap Index Scan on avdt  (cost=0.00..562.28 rows=10000 width=0) (actual time=1.779..1.779 rows=10000 loops=1)
->  Memoize  (cost=0.16..1.12 rows=1 width=8) (never executed)
Cache Key: attribute_value.atribute
->  Index Scan using atributes_pk on attribute  (cost=0.15..1.11 rows=1 width=8) (never executed)
Index Cond: (id = attribute_value.atribute)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.109..0.110 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.013..0.065 rows=100 loops=1)
->  Index Scan using atributes_type_pk on attribute_type  (cost=0.15..0.21 rows=1 width=4) (never executed)
Index Cond: (id = attribute.attribute_type)
Filter: ((name)::text = 'dateTime'::text)
Planning Time: 1.298 ms
Execution Time: 6.233 ms
(27 rows)

Вывод: индекс помог снизить время выполнения в 40 раз

увеличим количество строк до 10000000

выполним анализ

QUERY PLAN
                                                                                                            
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------
Group  (cost=273678.84..273711.43 rows=236 width=22) (actual time=823.062..826.671 rows=0 loops=1)
Group Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::date + '20 d
ays'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
->  Gather Merge  (cost=273678.84..273704.65 rows=196 width=22) (actual time=823.061..826.669 rows=0 loops=1)
Workers Planned: 2
Workers Launched: 2
->  Group  (cost=272678.82..272682.00 rows=98 width=22) (actual time=790.857..790.859 rows=0 loops=3)
Group Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::
date + '20 days'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
->  Sort  (cost=272678.82..272679.06 rows=98 width=22) (actual time=790.857..790.859 rows=0 loops=3)
Sort Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now
())::date + '20 days'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
Sort Method: quicksort  Memory: 25kB
Worker 0:  Sort Method: quicksort  Memory: 25kB
Worker 1:  Sort Method: quicksort  Memory: 25kB
->  Hash Join  (cost=50.69..272675.58 rows=98 width=22) (actual time=790.828..790.830 rows=0 loops=3)
Hash Cond: (attribute_value.atribute = films.id)
->  Parallel Seq Scan on attribute_value  (cost=0.00..272542.47 rows=20834 width=12) (actual time=790.826..790.827 rows=0 loops=3)
Filter: (((datetime)::date = (now())::date) OR (datetime = ((now())::date + '20 days'::interval)))
Rows Removed by Filter: 3333333
->  Hash  (cost=50.68..50.68 rows=1 width=14) (never executed)
->  Nested Loop  (cost=4.40..50.68 rows=1 width=14) (never executed)
->  Hash Join  (cost=4.25..29.41 rows=100 width=18) (never executed)
Hash Cond: (attribute.id = films.id)
->  Seq Scan on attribute  (cost=0.00..22.00 rows=1200 width=8) (never executed)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (never executed)
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (never executed)
->  Index Scan using atributes_type_pk on attribute_type  (cost=0.15..0.21 rows=1 width=4) (never executed)
Index Cond: (id = attribute.attribute_type)
Filter: ((name)::text = 'dateTime'::text)
Planning Time: 1.453 ms
JIT:
Functions: 95
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 12.285 ms, Inlining 0.000 ms, Optimization 3.409 ms, Emission 51.250 ms, Total 66.943 ms
Execution Time: 833.763 ms
(33 rows)

добавим индекс и выполним анализ

QUERY PLAN
                                                                                                            
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------
Group  (cost=273677.37..273709.96 rows=236 width=22) (actual time=836.289..839.909 rows=0 loops=1)
Group Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::date + '20 d
ays'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
->  Gather Merge  (cost=273677.37..273703.18 rows=196 width=22) (actual time=836.289..839.908 rows=0 loops=1)
Workers Planned: 2
Workers Launched: 2
->  Group  (cost=272677.34..272680.53 rows=98 width=22) (actual time=799.832..799.835 rows=0 loops=3)
Group Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now())::
date + '20 days'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
->  Sort  (cost=272677.34..272677.59 rows=98 width=22) (actual time=799.832..799.834 rows=0 loops=3)
Sort Key: films.name, (CASE WHEN ((attribute_value.datetime)::date = (now())::date) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END), (CASE WHEN ((attribute_value.datetime)::date = ((now
())::date + '20 days'::interval)) THEN attribute_value.datetime ELSE NULL::timestamp without time zone END)
Sort Method: quicksort  Memory: 25kB
Worker 0:  Sort Method: quicksort  Memory: 25kB
Worker 1:  Sort Method: quicksort  Memory: 25kB
->  Hash Join  (cost=50.69..272674.10 rows=98 width=22) (actual time=799.801..799.804 rows=0 loops=3)
Hash Cond: (attribute_value.atribute = films.id)
->  Parallel Seq Scan on attribute_value  (cost=0.00..272541.00 rows=20834 width=12) (actual time=799.800..799.800 rows=0 loops=3)
Filter: (((datetime)::date = (now())::date) OR (datetime = ((now())::date + '20 days'::interval)))
Rows Removed by Filter: 3333333
->  Hash  (cost=50.68..50.68 rows=1 width=14) (never executed)
->  Nested Loop  (cost=4.40..50.68 rows=1 width=14) (never executed)
->  Hash Join  (cost=4.25..29.41 rows=100 width=18) (never executed)
Hash Cond: (attribute.id = films.id)
->  Seq Scan on attribute  (cost=0.00..22.00 rows=1200 width=8) (never executed)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (never executed)
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (never executed)
->  Index Scan using atributes_type_pk on attribute_type  (cost=0.15..0.21 rows=1 width=4) (never executed)
Index Cond: (id = attribute.attribute_type)
Filter: ((name)::text = 'dateTime'::text)
Planning Time: 3.917 ms
JIT:
Functions: 95
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 17.522 ms, Inlining 0.000 ms, Optimization 4.389 ms, Emission 59.466 ms, Total 81.377 ms
Execution Time: 852.661 ms
(33 rows)

вывод: при 10000000 индекс опять не дал результат

3 запрос: самый прибыльный фильм (10000 строк)
SELECT films.name, SUM(tickets.cost) FROM films LEFT JOIN "session" ON films.id = "session".film LEFT JOIN tickets ON "session".id = tickets."session" GROUP BY films.name, tickets.cost ORDER BY tickets.cost DESC LIMIT 1;



анализ

QUERY PLAN
-----------------------------------------------------------------------------------------------------------------------------------------------
Limit  (cost=774.87..774.88 rows=1 width=18) (actual time=16.548..16.551 rows=1 loops=1)
->  Sort  (cost=774.87..799.87 rows=10000 width=18) (actual time=16.546..16.548 rows=1 loops=1)
Sort Key: tickets.cost DESC
Sort Method: top-N heapsort  Memory: 25kB
->  HashAggregate  (cost=624.87..724.87 rows=10000 width=18) (actual time=16.060..16.326 rows=2082 loops=1)
Group Key: tickets.cost, films.name
Batches: 1  Memory Usage: 657kB
->  Hash Right Join  (cost=313.25..549.87 rows=10000 width=10) (actual time=5.753..12.119 rows=19989 loops=1)
Hash Cond: (session.film = films.id)
->  Hash Right Join  (cost=309.00..518.26 rows=10000 width=8) (actual time=5.676..9.266 rows=19899 loops=1)
Hash Cond: (tickets.session = session.id)
->  Seq Scan on tickets  (cost=0.00..183.00 rows=10000 width=8) (actual time=0.006..0.694 rows=10000 loops=1)
->  Hash  (cost=184.00..184.00 rows=10000 width=8) (actual time=5.649..5.650 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 519kB
->  Seq Scan on session  (cost=0.00..184.00 rows=10000 width=8) (actual time=0.005..2.654 rows=10000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.069..0.070 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.012..0.036 rows=100 loops=1)
Planning Time: 0.293 ms
Execution Time: 16.953 ms
(20 rows)

создадим индекс
create index tic_sum on "tickets" using btree ("session","cost");

проведем анализ
QUERY PLAN
-----------------------------------------------------------------------------------------------------------------------------------------------
Limit  (cost=774.87..774.88 rows=1 width=18) (actual time=16.066..16.068 rows=1 loops=1)
->  Sort  (cost=774.87..799.87 rows=10000 width=18) (actual time=16.064..16.066 rows=1 loops=1)
Sort Key: tickets.cost DESC
Sort Method: top-N heapsort  Memory: 25kB
->  HashAggregate  (cost=624.87..724.87 rows=10000 width=18) (actual time=15.456..15.788 rows=2082 loops=1)
Group Key: tickets.cost, films.name
Batches: 1  Memory Usage: 657kB
->  Hash Right Join  (cost=313.25..549.87 rows=10000 width=10) (actual time=4.460..11.286 rows=19989 loops=1)
Hash Cond: (session.film = films.id)
->  Hash Right Join  (cost=309.00..518.26 rows=10000 width=8) (actual time=4.359..8.115 rows=19899 loops=1)
Hash Cond: (tickets.session = session.id)
->  Seq Scan on tickets  (cost=0.00..183.00 rows=10000 width=8) (actual time=0.002..0.688 rows=10000 loops=1)
->  Hash  (cost=184.00..184.00 rows=10000 width=8) (actual time=4.305..4.305 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 519kB
->  Seq Scan on session  (cost=0.00..184.00 rows=10000 width=8) (actual time=0.007..2.135 rows=10000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.094..0.095 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.016..0.047 rows=100 loops=1)
Planning Time: 0.757 ms
Execution Time: 16.197 ms
(20 rows)

Вывод: для суммы индекс оказался не эфективен

увеличим количество строк до 10000000

QUERY PLAN
---------------------------------------------------------------------------------------------------------------------------------------------------
Limit  (cost=311820.58..311820.59 rows=1 width=18) (actual time=5036.281..5036.285 rows=1 loops=1)
->  Sort  (cost=311820.58..311870.33 rows=19899 width=18) (actual time=5025.703..5025.706 rows=1 loops=1)
Sort Key: tickets.cost DESC
Sort Method: top-N heapsort  Memory: 25kB
->  HashAggregate  (cost=311522.10..311721.09 rows=19899 width=18) (actual time=5025.179..5025.477 rows=2109 loops=1)
Group Key: tickets.cost, films.name
Batches: 1  Memory Usage: 1041kB
->  Hash Right Join  (cost=313.25..236523.67 rows=9999791 width=10) (actual time=2.747..3484.507 rows=10009989 loops=1)
Hash Cond: (session.film = films.id)
->  Hash Right Join  (cost=309.00..209157.49 rows=9999791 width=8) (actual time=2.700..2347.392 rows=10009899 loops=1)
Hash Cond: (tickets.session = session.id)
->  Seq Scan on tickets  (cost=0.00..182587.91 rows=9999791 width=8) (actual time=0.229..615.811 rows=10000000 loops=1)
->  Hash  (cost=184.00..184.00 rows=10000 width=8) (actual time=2.424..2.425 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 519kB
->  Seq Scan on session  (cost=0.00..184.00 rows=10000 width=8) (actual time=0.003..1.260 rows=10000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.041..0.041 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.011..0.026 rows=100 loops=1)
Planning Time: 0.424 ms
JIT:
Functions: 25
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 3.218 ms, Inlining 0.000 ms, Optimization 0.511 ms, Emission 9.885 ms, Total 13.615 ms
Execution Time: 5040.006 ms
(24 rows)

добавим индекс

QUERY PLAN
---------------------------------------------------------------------------------------------------------------------------------------------------
Limit  (cost=311820.58..311820.59 rows=1 width=18) (actual time=5036.281..5036.285 rows=1 loops=1)
->  Sort  (cost=311820.58..311870.33 rows=19899 width=18) (actual time=5025.703..5025.706 rows=1 loops=1)
Sort Key: tickets.cost DESC
Sort Method: top-N heapsort  Memory: 25kB
->  HashAggregate  (cost=311522.10..311721.09 rows=19899 width=18) (actual time=5025.179..5025.477 rows=2109 loops=1)
Group Key: tickets.cost, films.name
Batches: 1  Memory Usage: 1041kB
->  Hash Right Join  (cost=313.25..236523.67 rows=9999791 width=10) (actual time=2.747..3484.507 rows=10009989 loops=1)
Hash Cond: (session.film = films.id)
->  Hash Right Join  (cost=309.00..209157.49 rows=9999791 width=8) (actual time=2.700..2347.392 rows=10009899 loops=1)
Hash Cond: (tickets.session = session.id)
->  Seq Scan on tickets  (cost=0.00..182587.91 rows=9999791 width=8) (actual time=0.229..615.811 rows=10000000 loops=1)
->  Hash  (cost=184.00..184.00 rows=10000 width=8) (actual time=2.424..2.425 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 519kB
->  Seq Scan on session  (cost=0.00..184.00 rows=10000 width=8) (actual time=0.003..1.260 rows=10000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.041..0.041 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.011..0.026 rows=100 loops=1)
Planning Time: 0.424 ms
JIT:
Functions: 25
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 3.218 ms, Inlining 0.000 ms, Optimization 0.511 ms, Emission 9.885 ms, Total 13.615 ms
Execution Time: 5040.006 ms
(24 rows)

postgres=# create index tic_sum on "tickets" using btree ("session","cost");
CREATE INDEX
postgres=# explain analyze SELECT films.name, SUM(tickets.cost) FROM films LEFT JOIN "session" ON films.id = "session".film LEFT JOIN tickets ON "session".id = tickets."session" GROUP BY films.name, tickets.cost ORDER BY tickets.cost DESC LIMIT 1;
QUERY PLAN
----------------------------------------------------------------------------------------------------------------------------------------------------
Limit  (cost=311825.36..311825.36 rows=1 width=18) (actual time=4842.075..4842.079 rows=1 loops=1)
->  Sort  (cost=311825.36..311875.11 rows=19899 width=18) (actual time=4831.726..4831.729 rows=1 loops=1)
Sort Key: tickets.cost DESC
Sort Method: top-N heapsort  Memory: 25kB
->  HashAggregate  (cost=311526.88..311725.86 rows=19899 width=18) (actual time=4831.217..4831.506 rows=2109 loops=1)
Group Key: tickets.cost, films.name
Batches: 1  Memory Usage: 1041kB
->  Hash Right Join  (cost=313.25..236526.88 rows=10000000 width=10) (actual time=2.583..3335.780 rows=10009989 loops=1)
Hash Cond: (session.film = films.id)
->  Hash Right Join  (cost=309.00..209160.12 rows=10000000 width=8) (actual time=2.538..2240.359 rows=10009899 loops=1)
Hash Cond: (tickets.session = session.id)
->  Seq Scan on tickets  (cost=0.00..182590.00 rows=10000000 width=8) (actual time=0.230..593.324 rows=10000000 loops=1)
->  Hash  (cost=184.00..184.00 rows=10000 width=8) (actual time=2.281..2.282 rows=10000 loops=1)
Buckets: 16384  Batches: 1  Memory Usage: 519kB
->  Seq Scan on session  (cost=0.00..184.00 rows=10000 width=8) (actual time=0.004..1.129 rows=10000 loops=1)
->  Hash  (cost=3.00..3.00 rows=100 width=10) (actual time=0.039..0.039 rows=100 loops=1)
Buckets: 1024  Batches: 1  Memory Usage: 13kB
->  Seq Scan on films  (cost=0.00..3.00 rows=100 width=10) (actual time=0.014..0.024 rows=100 loops=1)
Planning Time: 1.287 ms
JIT:
Functions: 25
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 2.900 ms, Inlining 0.000 ms, Optimization 0.462 ms, Emission 9.691 ms, Total 13.052 ms
Execution Time: 4845.101 ms
(24 rows)

индекс дал совсем небольшой прирост

4 запрос: стоимость сеанса более 200
select * from "session" where cost > 200;

анализ

QUERY PLAN
----------------------------------------------------------------------------------------------------------
Seq Scan on session  (cost=0.00..292.00 rows=7899 width=38) (actual time=0.515..2.638 rows=7908 loops=1)
Filter: (cost > 200)
Rows Removed by Filter: 2092
Planning Time: 0.086 ms
Execution Time: 3.040 ms
(5 rows)

добавим индекс
create index ses_cost on "session" using btree ("cost") where cost > 200;

QUERY PLAN
----------------------------------------------------------------------------------------------------------
Seq Scan on session  (cost=0.00..292.00 rows=7899 width=38) (actual time=0.094..3.395 rows=7908 loops=1)
Filter: (cost > 200)
Rows Removed by Filter: 2092
Planning Time: 0.358 ms
Execution Time: 4.081 ms
(5 rows)

Вывод: индекс только увеличил время выполнения

увеличим до 10000000

QUERY PLAN
---------------------------------------------------------------------------------------------------------------------
Seq Scan on session  (cost=0.00..208334.96 rows=7990199 width=38) (actual time=3.942..858.659 rows=8004687 loops=1)
Filter: (cost > 200)
Rows Removed by Filter: 1995313
Planning Time: 0.301 ms
JIT:
Functions: 2
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 0.814 ms, Inlining 0.000 ms, Optimization 0.344 ms, Emission 3.474 ms, Total 4.632 ms
Execution Time: 1012.627 ms
(9 rows)

создадим индекс и проанализируем заново

QUERY PLAN
---------------------------------------------------------------------------------------------------------------------
Seq Scan on session  (cost=0.00..208337.00 rows=7990329 width=38) (actual time=1.962..856.538 rows=8004687 loops=1)
Filter: (cost > 200)
Rows Removed by Filter: 1995313
Planning Time: 0.885 ms
JIT:
Functions: 2
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 0.570 ms, Inlining 0.000 ms, Optimization 0.259 ms, Emission 1.592 ms, Total 2.421 ms
Execution Time: 1010.034 ms
(9 rows)

5 запрос: холлы, в которых посадочних мест от 90 до 110

select * from halls where places > 90 AND places < 110;

анализ

QUERY PLAN
-----------------------------------------------------------------------------------------------------------
Seq Scan on halls  (cost=0.00..421.00 rows=10000 width=186) (actual time=0.019..2.628 rows=10000 loops=1)
Filter: ((places > 90) AND (places < 110))
Planning Time: 0.100 ms
Execution Time: 3.093 ms

индекс
create index places on "halls" using btree ("places") where places > 90 AND places < 110;

анализ с индексом

Seq Scan on halls  (cost=0.00..421.00 rows=10000 width=186) (actual time=0.014..4.014 rows=10000 loops=1)
Filter: ((places > 90) AND (places < 110))
Planning Time: 0.306 ms
Execution Time: 4.831 ms

увеличим до 1000000 строк

анализ

QUERY PLAN
----------------------------------------------------------------------------------------------------------------------
Seq Scan on halls  (cost=0.00..420305.29 rows=9999553 width=186) (actual time=7.683..1289.232 rows=10000000 loops=1)
Filter: ((places > 90) AND (places < 110))
Planning Time: 0.525 ms
JIT:
Functions: 2
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 1.173 ms, Inlining 0.000 ms, Optimization 0.515 ms, Emission 6.922 ms, Total 8.610 ms
Execution Time: 1489.678 ms

анализ с индексом

QUERY PLAN
-----------------------------------------------------------------------------------------------------------------------
Seq Scan on halls  (cost=0.00..420312.00 rows=10000000 width=186) (actual time=4.564..1239.670 rows=10000000 loops=1)
Filter: ((places > 90) AND (places < 110))
Planning Time: 0.486 ms
JIT:
Functions: 2
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 0.837 ms, Inlining 0.000 ms, Optimization 0.486 ms, Emission 3.953 ms, Total 5.276 ms
Execution Time: 1434.372 ms

6 запрос: длина имени типа атрибута
select * from attribute_type where length(name) < 3;

анализ

QUERY PLAN
-------------------------------------------------------------------------------------------------------------------------
Bitmap Heap Scan on attribute_type  (cost=42.12..151.11 rows=3333 width=16) (actual time=0.177..0.765 rows=746 loops=1)
Recheck Cond: (length((name)::text) < 3)
Heap Blocks: exact=59
->  Bitmap Index Scan on latn  (cost=0.00..41.28 rows=3333 width=0) (actual time=0.131..0.132 rows=746 loops=1)
Index Cond: (length((name)::text) < 3)
Planning Time: 0.177 ms
Execution Time: 0.907 ms

создадим индекс
create index LATN on "attribute_type" using btree (length("name"));

QUERY PLAN
-------------------------------------------------------------------------------------------------------------------------
Bitmap Heap Scan on attribute_type  (cost=42.12..151.11 rows=3333 width=16) (actual time=0.087..0.460 rows=746 loops=1)
Recheck Cond: (length((name)::text) < 3)
Heap Blocks: exact=59
->  Bitmap Index Scan on latn  (cost=0.00..41.28 rows=3333 width=0) (actual time=0.060..0.060 rows=746 loops=1)
Index Cond: (length((name)::text) < 3)
Planning Time: 0.100 ms
Execution Time: 0.549 ms

увеличим до 10000000

QUERY PLAN
---------------------------------------------------------------------------------------------------------------------
Seq Scan on attribute_type  (cost=0.00..58219.00 rows=1 width=16) (actual time=0.016..1137.460 rows=748612 loops=1)
Filter: (length((name)::text) < 3)
Rows Removed by Filter: 9251388
Planning Time: 0.080 ms
Execution Time: 1152.764 ms

с индексом

QUERY PLAN
----------------------------------------------------------------------------------------------------------------------------------------
Bitmap Heap Scan on attribute_type  (cost=37117.77..145336.76 rows=3333333 width=16) (actual time=43.358..299.268 rows=748612 loops=1)
Recheck Cond: (length((name)::text) < 3)
Heap Blocks: exact=58163
->  Bitmap Index Scan on latn  (cost=0.00..36284.43 rows=3333333 width=0) (actual time=33.118..33.118 rows=748612 loops=1)
Index Cond: (length((name)::text) < 3)
Planning Time: 0.332 ms
JIT:
Functions: 2
Options: Inlining false, Optimization false, Expressions true, Deforming true
Timing: Generation 0.701 ms, Inlining 0.000 ms, Optimization 0.000 ms, Emission 0.000 ms, Total 0.701 ms
Execution Time: 319.613 ms
