/*
*Таблица с результатами по каждому из 6 запросов
*
*/





/*
*
*1 запрос
*
*/

EXPLAIN ANALYSE 
SELECT "id_value","attr_id",
CASE 
WHEN "value_date" IS NOT NULL THEN "value_date"::text
WHEN "value_text" IS NOT NULL THEN "value_text"::text
WHEN "value_num" IS NOT NULL THEN "value_num"::text
WHEN "value_bool" IS NOT NULL THEN "value_bool"::text
ELSE NULL
END AS "value",
"film_id" FROM "film_attr_value";
EXPLAIN ANALYSE SELECT * FROM "film_attr_value";


/*==План на 10тыс.строк==*/
QUERY PLAN
---------------------------------------------------------------------------------------------------------------------
 Seq Scan on film_attr_value  (cost=0.00..430.00 rows=10000 width=44) (actual time=0.026..17.157 rows=10000 loops=1)
 Planning Time: 0.217 ms
 Execution Time: 19.325 ms
(3 rows)

/*==План на 100тыс.строк==*/
QUERY PLAN
-------------------------------------------------------------------------------------------------------------------------
 Seq Scan on film_attr_value  (cost=0.00..4291.00 rows=100000 width=44) (actual time=0.024..132.217 rows=100000 loops=1)
 Planning Time: 0.437 ms
 Execution Time: 148.851 ms
(3 rows)

/*==План на 100тыс.строк, с улучшениями==*/

                                                                QUERY PLAN      
------------------------------------------------------------------------------------------------------------------------------------------
 Index Scan using film_attr_value_pk on film_attr_value  (cost=0.29..63.90 rows=911 width=44) (actual time=0.295..2.277 rows=999 loops=1)
   Index Cond: ((id_value >= 0) AND (id_value < 1000))
 Planning Time: 0.359 ms
 Execution Time: 2.500 ms
(4 rows)

/*==Пречень оптимизаций с пояснениями==
*
*1. В данном случае для ускорения запроса поможет 
*Партицирование таблицы при большом объеме по ключевому столбцу "id_value".
*Для этого нужно удалить старую таблицу и создать новую (ALTER TABLE ... ATTACH PARTITION)
*2. Ускоряет выдачу всех полей условие WHERE с диапазоном по ключевому столбцу "id_value", 
что было сделано для плана по оптимизации(новый запрос ниже)
*
*/

EXPLAIN ANALYSE 
SELECT "id_value","attr_id",
CASE 
WHEN "value_date" IS NOT NULL THEN "value_date"::text
WHEN "value_text" IS NOT NULL THEN "value_text"::text
WHEN "value_num" IS NOT NULL THEN "value_num"::text
WHEN "value_bool" IS NOT NULL THEN "value_bool"::text
ELSE NULL
END AS "value",
"film_id" FROM "film_attr_value"
WHERE "id_value">=0 AND "id_value"<1000 ;








/*
*
*2 запрос
*
*/

EXPLAIN ANALYSE 
SELECT film_id 
FROM "film_attr_value" 
WHERE film_id < 2000;

/*==План на 10тыс.строк==*/
    QUERY PLAN
-----------------------------------------------------------------------------------------------------------------
 Seq Scan on film_attr_value  (cost=0.00..330.00 rows=2055 width=4) (actual time=0.029..7.496 rows=2057 loops=1)
   Filter: (film_id < 2000)
   Rows Removed by Filter: 7943
 Planning Time: 0.131 ms
 Execution Time: 8.097 ms
(5 rows)


/*==План на 100тыс.строк==*/
   QUERY PLAN
-------------------------------------------------------------------------------------------------------------------
 Seq Scan on film_attr_value  (cost=0.00..3291.00 rows=1919 width=4) (actual time=0.075..64.747 rows=2070 loops=1)
   Filter: (film_id < 2000)
   Rows Removed by Filter: 97930
 Planning Time: 0.122 ms
 Execution Time: 65.324 ms

/*==План на 100тыс.строк, с улучшениями==*/

                                                               QUERY PLAN       
-----------------------------------------------------------------------------------------------------------------------------------------
 Index Only Scan using req1_filmid on film_attr_value  (cost=0.29..53.87 rows=1919 width=4) (actual time=0.239..1.485 rows=2070 loops=1)
   Index Cond: (film_id < 2000)
   Heap Fetches: 0
 Planning Time: 0.346 ms
 Execution Time: 2.263 ms
(5 rows)


/*==Пречень оптимизаций с пояснениями==
*
*Добавляем индекс на внешний ключ, по которому идет поиск
*CREATE INDEX req1_filmId ON film_attr_value(film_id);
*
*/











/*
*
*3 запрос
*
*/

EXPLAIN ANALYSE
SELECT id_attr,title_attr, type_id 
FROM film_attr 
ORDER BY type_id 
DESC NULLS LAST; 


/*==План на 10тыс.строк==*/

 QUERY PLAN
---------------------------------------------------------------------------------------------------------------------
 Sort  (cost=937.39..962.39 rows=10000 width=109) (actual time=20.842..25.144 rows=10000 loops=1)
   Sort Key: type_id DESC NULLS LAST
   Sort Method: quicksort  Memory: 1791kB
   ->  Seq Scan on film_attr  (cost=0.00..273.00 rows=10000 width=109) (actual time=0.015..5.125 rows=10000 loops=1)
 Planning Time: 0.183 ms
 Execution Time: 28.128 ms
(6 rows)


/*==План на 100тыс.строк==*/
 QUERY PLAN
-------------------------------------------------------------------------------------------------------------------------
 Sort  (cost=16843.32..17093.32 rows=100000 width=109) (actual time=209.187..254.824 rows=100000 loops=1)
   Sort Key: type_id DESC NULLS LAST
   Sort Method: external merge  Disk: 11944kB
   ->  Seq Scan on film_attr  (cost=0.00..2725.00 rows=100000 width=109) (actual time=0.013..36.979 rows=100000 loops=1)
 Planning Time: 0.541 ms
 Execution Time: 267.868 ms
(6 rows)

/*==План на 100тыс.строк, с улучшениями==*/
QUERY PLAN       
----------------------------------------------------------------------------------------------------------------------------------------
 Index Scan using req2_typeid on film_attr  (cost=0.29..9367.69 rows=100000 width=109) (actual time=0.069..183.640 rows=100000 loops=1)
 Planning Time: 1.225 ms
 Execution Time: 206.275 ms
(3 rows)


/*==Пречень оптимизаций с пояснениями==
*
*1. Добавляем индекс на внешний ключ, по которому идет сортировка
*CREATE INDEX req2_typeId ON film_attr(type_id DESC NULLS LAST);
*2. Ускоряет выдачу всех полей условие WHERE с диапазоном по ключевому столбцу "id_value", 
*что было сделано для плана по оптимизации(новый запрос ниже)
*3. Больше решений пока не могу найти
*/
EXPLAIN ANALYSE
SELECT id_attr,title_attr, type_id 
FROM film_attr 
WHERE type_id<1000
ORDER BY type_id 
DESC NULLS LAST; 

                                                           QUERY PLAN           
--------------------------------------------------------------------------------------------------------------------------------
 Sort  (cost=1644.63..1647.21 rows=1030 width=109) (actual time=4.530..4.795 rows=994 loops=1)
   Sort Key: type_id DESC NULLS LAST
   Sort Method: quicksort  Memory: 164kB
   ->  Bitmap Heap Scan on film_attr  (cost=20.28..1593.09 rows=1030 width=109) (actual time=1.025..3.354 rows=994 loops=1)
         Recheck Cond: (type_id < 1000)
         Heap Blocks: exact=765
         ->  Bitmap Index Scan on req2_typeid  (cost=0.00..20.02 rows=1030 width=0) (actual time=0.583..0.584 rows=994 loops=1)
               Index Cond: (type_id < 1000)
 Planning Time: 0.609 ms
 Execution Time: 5.153 ms
(10 rows)




/*
*
*4 запрос
*
*/

EXPLAIN ANALYSE 
SELECT "film"."title_film","film_attr_type"."title_type","film_attr"."title_attr",
"film_attr_value"."value_date","film_attr_value"."value_text",
"film_attr_value"."value_num","film_attr_value"."value_bool" FROM "film"
INNER JOIN "film_attr_value" ON "film"."id_film" = "film_attr_value"."film_id"
INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
INNER JOIN "film_attr_type" ON  "film_attr"."type_id"= "film_attr_type"."id_type"
WHERE "film"."id_film">100 AND "film"."id_film"<2500;

/*==План на 10тыс.строк==*/
 QUERY PLAN
------------------------------------------------------------------------------------------------------------------------------------------------------------
 Hash Join  (cost=971.48..1567.97 rows=2399 width=371) (actual time=45.415..59.813 rows=2432 loops=1)
   Hash Cond: (film_attr_type.id_type = film_attr.type_id)
   ->  Seq Scan on film_attr_type  (cost=0.00..535.00 rows=10000 width=55) (actual time=0.016..4.275 rows=10000 loops=1)
   ->  Hash  (cost=941.49..941.49 rows=2399 width=324) (actual time=45.374..45.381 rows=2432 loops=1)
         Buckets: 4096  Batches: 1  Memory Usage: 897kB
         ->  Hash Join  (cost=594.50..941.49 rows=2399 width=324) (actual time=27.184..41.714 rows=2432 loops=1)
               Hash Cond: (film_attr.id_attr = film_attr_value.attr_id)
               ->  Seq Scan on film_attr  (cost=0.00..273.00 rows=10000 width=109) (actual time=0.008..4.424 rows=10000 loops=1)
               ->  Hash  (cost=564.51..564.51 rows=2399 width=223) (actual time=27.149..27.154 rows=2432 loops=1)
                     Buckets: 4096  Batches: 1  Memory Usage: 659kB
                     ->  Hash Join  (cost=233.25..564.51 rows=2399 width=223) (actual time=6.543..23.251 rows=2432 loops=1)
                           Hash Cond: (film_attr_value.film_id = film.id_film)
                           ->  Seq Scan on film_attr_value  (cost=0.00..305.00 rows=10000 width=126) (actual time=0.008..5.191 rows=10000 loops=1)
                           ->  Hash  (cost=203.27..203.27 rows=2399 width=105) (actual time=6.505..6.508 rows=2399 loops=1)
                                 Buckets: 4096  Batches: 1  Memory Usage: 360kB
                                 ->  Index Scan using film_pk on film  (cost=0.29..203.27 rows=2399 width=105) (actual time=0.071..4.053 rows=2399 loops=1)
                                       Index Cond: ((id_film > 100) AND (id_film < 2500))
 Planning Time: 2.013 ms
 Execution Time: 60.418 ms
(19 rows)

/*==План на 100тыс.строк==*/
 QUERY PLAN
--------------------------------------------------------------------------------------------------------------------------------------------------------
 Gather  (cost=1236.38..5556.60 rows=2477 width=371) (actual time=9.567..184.244 rows=2475 loops=1)
   Workers Planned: 1
   Workers Launched: 1
   ->  Nested Loop  (cost=236.38..4308.90 rows=1457 width=371) (actual time=10.795..119.733 rows=1238 loops=2)
         ->  Nested Loop  (cost=236.09..3587.74 rows=1457 width=324) (actual time=10.688..101.303 rows=1238 loops=2)
               ->  Hash Join  (cost=235.79..3019.45 rows=1457 width=223) (actual time=10.603..83.263 rows=1238 loops=2)
                     Hash Cond: (film_attr_value.film_id = film.id_film)
                     ->  Parallel Seq Scan on film_attr_value  (cost=0.00..2629.24 rows=58824 width=126) (actual time=0.028..26.398 rows=50000 loops=2)
                     ->  Hash  (cost=204.83..204.83 rows=2477 width=105) (actual time=10.155..10.157 rows=2399 loops=2)
                           Buckets: 4096  Batches: 1  Memory Usage: 360kB
                           ->  Index Scan using film_pk on film  (cost=0.29..204.83 rows=2477 width=105) (actual time=0.170..5.901 rows=2399 loops=2)
                                 Index Cond: ((id_film > 100) AND (id_film < 2500))
               ->  Index Scan using film_attr_pk on film_attr  (cost=0.29..0.39 rows=1 width=109) (actual time=0.011..0.011 rows=1 loops=2475)
                     Index Cond: (id_attr = film_attr_value.attr_id)
         ->  Index Scan using film_attr_type_pk on film_attr_type  (cost=0.29..0.49 rows=1 width=55) (actual time=0.012..0.012 rows=1 loops=2475)
               Index Cond: (id_type = film_attr.type_id)
 Planning Time: 2.581 ms
 Execution Time: 185.273 ms
(18 rows)

/*==План на 100тыс.строк, с улучшениями==*/
QUERY PLAN
----------------------------------------------------------------------------------------------------------------------------------------------------------
 Gather  (cost=1236.38..5556.60 rows=2477 width=371) (actual time=8.399..109.486 rows=2475 loops=1)
   Workers Planned: 1
   Workers Launched: 1
   ->  Nested Loop  (cost=236.38..4308.90 rows=1457 width=371) (actual time=7.378..94.712 rows=1238 loops=2)
         ->  Nested Loop  (cost=236.09..3587.74 rows=1457 width=324) (actual time=7.342..81.586 rows=1238 loops=2)
               ->  Hash Join  (cost=235.79..3019.45 rows=1457 width=223) (actual time=7.301..67.677 rows=1238 loops=2)
                     Hash Cond: (film_attr_value.film_id = film.id_film)
                     ->  Parallel Seq Scan on film_attr_value  (cost=0.00..2629.24 rows=58824 width=126) (actual time=0.049..22.199 rows=50000 loops=2)
                     ->  Hash  (cost=204.83..204.83 rows=2477 width=105) (actual time=6.972..6.974 rows=2399 loops=2)
                           Buckets: 4096  Batches: 1  Memory Usage: 360kB
                           ->  Index Scan using req4_idfilm on film  (cost=0.29..204.83 rows=2477 width=105) (actual time=0.106..4.244 rows=2399 loops=2)
                                 Index Cond: ((id_film > 100) AND (id_film < 2500))
               ->  Index Scan using film_attr_pk on film_attr  (cost=0.29..0.39 rows=1 width=109) (actual time=0.009..0.009 rows=1 loops=2475)
                     Index Cond: (id_attr = film_attr_value.attr_id)
         ->  Index Scan using film_attr_type_pk on film_attr_type  (cost=0.29..0.49 rows=1 width=55) (actual time=0.008..0.008 rows=1 loops=2475)
               Index Cond: (id_type = film_attr.type_id)
 Planning Time: 3.211 ms
 Execution Time: 110.287 ms
(18 rows)




/*==Пречень оптимизаций с пояснениями==
*
*1.Добавляем индекс на внешний ключ, по которому идет сортировка и связь JOIN
*CREATE INDEX req4_idFilm ON film(id_film);
*CREATE INDEX req4_filmId ON film_attr_value(film_id);
*CREATE INDEX req4_attrID ON film_attr_value(attr_id);
*CREATE INDEX req4_typeID ON film_attr(type_id);
*
*Уменьшилось время на обработку запроса
*/




/*
*
*5 запрос
*
*/

EXPLAIN ANALYSE 
SELECT "film"."title_film","film_attr_type"."title_type","film_attr"."title_attr", 
CASE 
WHEN "film_attr_value"."value_date" IS NOT NULL THEN "film_attr_value"."value_date"::text
WHEN "film_attr_value"."value_text" IS NOT NULL THEN "film_attr_value"."value_text"::text
WHEN "film_attr_value"."value_num" IS NOT NULL THEN "film_attr_value"."value_num"::text
WHEN "film_attr_value"."value_bool" IS NOT NULL THEN "film_attr_value"."value_bool"::text
ELSE NULL
END AS "value" FROM "film"
INNER JOIN "film_attr_value" ON	"film"."id_film" = "film_attr_value"."film_id"
INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
INNER JOIN "film_attr_type" ON  "film_attr"."type_id"= "film_attr_type"."id_type";

/*==План на 10тыс.строк==*/
 QUERY PLAN
---------------------------------------------------------------------------------------------------------------------------------------
 Hash Join  (cost=1783.00..2291.78 rows=10000 width=285) (actual time=50.848..108.084 rows=10000 loops=1)
   Hash Cond: (film_attr.type_id = film_attr_type.id_type)
   ->  Hash Join  (cost=1123.00..1480.52 rows=10000 width=324) (actual time=33.941..69.047 rows=10000 loops=1)
         Hash Cond: (film_attr_value.attr_id = film_attr.id_attr)
         ->  Hash Join  (cost=725.00..1056.26 rows=10000 width=223) (actual time=17.698..37.745 rows=10000 loops=1)
               Hash Cond: (film_attr_value.film_id = film.id_film)
               ->  Seq Scan on film_attr_value  (cost=0.00..305.00 rows=10000 width=126) (actual time=0.017..3.954 rows=10000 loops=1)
               ->  Hash  (cost=600.00..600.00 rows=10000 width=105) (actual time=17.460..17.461 rows=10000 loops=1)
                     Buckets: 16384  Batches: 1  Memory Usage: 1496kB
                     ->  Seq Scan on film  (cost=0.00..600.00 rows=10000 width=105) (actual time=0.014..8.029 rows=10000 loops=1)
         ->  Hash  (cost=273.00..273.00 rows=10000 width=109) (actual time=16.174..16.174 rows=10000 loops=1)
               Buckets: 16384  Batches: 1  Memory Usage: 1535kB
               ->  Seq Scan on film_attr  (cost=0.00..273.00 rows=10000 width=109) (actual time=0.021..7.775 rows=10000 loops=1)
   ->  Hash  (cost=535.00..535.00 rows=10000 width=55) (actual time=16.868..16.869 rows=10000 loops=1)
         Buckets: 16384  Batches: 1  Memory Usage: 988kB
         ->  Seq Scan on film_attr_type  (cost=0.00..535.00 rows=10000 width=55) (actual time=0.066..8.179 rows=10000 loops=1)
 Planning Time: 1.790 ms
 Execution Time: 110.175 ms
(18 rows)

/*==План на 100тыс.строк==*/
 QUERY PLAN
------------------------------------------------------------------------------------------------------------------------------------------------------------
 Gather  (cost=20207.97..42053.55 rows=100000 width=285) (actual time=909.747..1165.689 rows=100000 loops=1)
   Workers Planned: 1
   Workers Launched: 1
   ->  Parallel Hash Join  (cost=19207.97..31053.55 rows=58824 width=285) (actual time=900.936..1068.352 rows=50000 loops=2)
         Hash Cond: (film_attr_value.attr_id = film_attr.id_attr)
         ->  Parallel Hash Join  (cost=6629.50..12289.16 rows=58824 width=223) (actual time=255.408..376.877 rows=50000 loops=2)
               Hash Cond: (film_attr_value.film_id = film.id_film)
               ->  Parallel Seq Scan on film_attr_value  (cost=0.00..2629.24 rows=58824 width=126) (actual time=0.011..50.193 rows=50000 loops=2)
               ->  Parallel Hash  (cost=5416.67..5416.67 rows=41667 width=105) (actual time=122.913..122.915 rows=50000 loops=2)
                     Buckets: 32768  Batches: 4  Memory Usage: 3840kB
                     ->  Parallel Seq Scan on film  (cost=0.00..5416.67 rows=41667 width=105) (actual time=0.068..57.274 rows=50000 loops=2)
         ->  Parallel Hash  (cost=10521.16..10521.16 rows=58824 width=156) (actual time=424.165..424.169 rows=50000 loops=2)
               Buckets: 32768  Batches: 8  Memory Usage: 2688kB
               ->  Parallel Hash Join  (cost=5692.50..10521.16 rows=58824 width=156) (actual time=236.242..345.047 rows=50000 loops=2)
                     Hash Cond: (film_attr.type_id = film_attr_type.id_type)
                     ->  Parallel Seq Scan on film_attr  (cost=0.00..2313.24 rows=58824 width=109) (actual time=0.017..43.399 rows=50000 loops=2)
                     ->  Parallel Hash  (cost=4764.67..4764.67 rows=41667 width=55) (actual time=115.952..115.954 rows=50000 loops=2)
                           Buckets: 65536  Batches: 4  Memory Usage: 2688kB
                           ->  Parallel Seq Scan on film_attr_type  (cost=0.00..4764.67 rows=41667 width=55) (actual time=0.088..54.571 rows=50000 loops=2)
 Planning Time: 1.919 ms
 Execution Time: 1188.032 ms
(21 rows)



/*==План на 100тыс.строк, с улучшениями==*/
  QUERY PLAN
------------------------------------------------------------------------------------------------------------------------------------------------------------
 Gather  (cost=20207.97..42053.55 rows=100000 width=285) (actual time=383.867..498.108 rows=100000 loops=1)
   Workers Planned: 1
   Workers Launched: 1
   ->  Parallel Hash Join  (cost=19207.97..31053.55 rows=58824 width=285) (actual time=374.949..448.725 rows=50000 loops=2)
         Hash Cond: (film_attr_value.attr_id = film_attr.id_attr)
         ->  Parallel Hash Join  (cost=6629.50..12289.16 rows=58824 width=223) (actual time=99.711..149.658 rows=50000 loops=2)
               Hash Cond: (film_attr_value.film_id = film.id_film)
               ->  Parallel Seq Scan on film_attr_value  (cost=0.00..2629.24 rows=58824 width=126) (actual time=0.007..19.214 rows=50000 loops=2)
               ->  Parallel Hash  (cost=5416.67..5416.67 rows=41667 width=105) (actual time=48.807..48.808 rows=50000 loops=2)
                     Buckets: 32768  Batches: 4  Memory Usage: 3840kB
                     ->  Parallel Seq Scan on film  (cost=0.00..5416.67 rows=41667 width=105) (actual time=0.037..22.459 rows=50000 loops=2)
         ->  Parallel Hash  (cost=10521.16..10521.16 rows=58824 width=156) (actual time=182.197..182.200 rows=50000 loops=2)
               Buckets: 32768  Batches: 8  Memory Usage: 2688kB
               ->  Parallel Hash Join  (cost=5692.50..10521.16 rows=58824 width=156) (actual time=103.884..149.047 rows=50000 loops=2)
                     Hash Cond: (film_attr.type_id = film_attr_type.id_type)
                     ->  Parallel Seq Scan on film_attr  (cost=0.00..2313.24 rows=58824 width=109) (actual time=0.014..17.012 rows=50000 loops=2)
                     ->  Parallel Hash  (cost=4764.67..4764.67 rows=41667 width=55) (actual time=57.041..57.041 rows=50000 loops=2)
                           Buckets: 65536  Batches: 4  Memory Usage: 2720kB
                           ->  Parallel Seq Scan on film_attr_type  (cost=0.00..4764.67 rows=41667 width=55) (actual time=0.082..26.864 rows=50000 loops=2)
 Planning Time: 3.465 ms
 Execution Time: 507.572 ms
(21 rows)




/*==Пречень оптимизаций с пояснениями==
*1.Добавляем индекс на внешний ключ, по которому идет связь JOIN
*
*CREATE INDEX req5_idType ON film_attr_type(id_type);
*CREATE INDEX req5_idAttr ON film_attr(id_attr);
*CREATE INDEX req5_filmId ON film_attr_value(film_id);
*
*Время выполнения запроса сократилось
*/




/*
*
*6 запрос
*
*/

EXPLAIN ANALYSE 
SELECT "film"."title_film", 
(SELECT string_agg("film_attr"."title_attr", ', ' ORDER BY "film_attr"."title_attr") FROM "film_attr_value"
	INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
	WHERE DATE("film_attr_value"."value_date") = CURRENT_DATE AND "film_attr_value"."film_id"="film"."id_film")
	AS "act_tasks",
(SELECT string_agg("film_attr"."title_attr", ', ' ORDER BY "film_attr"."title_attr") FROM "film_attr_value"
	INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
	WHERE DATE("film_attr_value"."value_date") > (CURRENT_DATE + INTERVAL '20 days') AND "film_attr_value"."film_id"="film"."id_film")
	AS "after20day_tasks"
FROM "film"
INNER JOIN "film_attr_value" ON	"film"."id_film" = "film_attr_value"."film_id"
INNER JOIN "film_attr" ON "film_attr_value"."attr_id" = "film_attr"."id_attr"
INNER JOIN "film_attr_type" ON  "film_attr"."type_id"= "film_attr_type"."id_type"
GROUP BY "film"."id_film"
ORDER BY "film"."title_film" ASC;

/*==План на 10тыс.строк==*/
QUERY PLAN                                                              
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Sort  (cost=8519834.93..8519859.93 rows=10000 width=169) (actual time=21702.094..21703.078 rows=6278 loops=1)
   Sort Key: film.title_film
   Sort Method: quicksort  Memory: 2620kB
   ->  Group  (cost=1815.80..8519170.54 rows=10000 width=169) (actual time=1133.318..21664.210 rows=6278 loops=1)
         Group Key: film.id_film
         ->  Merge Join  (cost=1815.80..2763.47 rows=10000 width=105) (actual time=1129.935..1166.013 rows=10000 loops=1)
               Merge Cond: (film.id_film = film_attr_value.film_id)
               ->  Index Scan using film_pk on film  (cost=0.29..773.28 rows=10000 width=105) (actual time=0.037..14.000 rows=10000 loops=1)
               ->  Sort  (cost=1815.19..1840.19 rows=10000 width=4) (actual time=36.797..43.006 rows=10000 loops=1)
                     Sort Key: film_attr_value.film_id
                     Sort Method: quicksort  Memory: 853kB
                     ->  Hash Join  (cost=793.29..1150.81 rows=10000 width=4) (actual time=15.838..29.440 rows=10000 loops=1)
                           Hash Cond: (film_attr.type_id = film_attr_type.id_type)
                           ->  Hash Join  (cost=398.00..729.26 rows=10000 width=8) (actual time=8.112..16.416 rows=10000 loops=1)
                                 Hash Cond: (film_attr_value.attr_id = film_attr.id_attr)
                                 ->  Seq Scan on film_attr_value  (cost=0.00..305.00 rows=10000 width=8) (actual time=0.012..2.322 rows=10000 loops=1)
                                 ->  Hash  (cost=273.00..273.00 rows=10000 width=8) (actual time=7.992..7.994 rows=10000 loops=1)
                                       Buckets: 16384  Batches: 1  Memory Usage: 519kB
                                       ->  Seq Scan on film_attr  (cost=0.00..273.00 rows=10000 width=8) (actual time=0.014..3.378 rows=10000 loops=1)
                           ->  Hash  (cost=270.29..270.29 rows=10000 width=4) (actual time=7.667..7.688 rows=10000 loops=1)
                                 Buckets: 16384  Batches: 1  Memory Usage: 480kB
                                 ->  Index Only Scan using film_attr_type_pk on film_attr_type  (cost=0.29..270.29 rows=10000 width=4) (actual time=0.036..3.228 rows=10000 loops=1)
                                       Heap Fetches: 0
         SubPlan 1
           ->  Aggregate  (cost=413.31..413.32 rows=1 width=32) (actual time=1.615..1.615 rows=1 loops=6278)
                 ->  Nested Loop  (cost=0.29..413.30 rows=1 width=101) (actual time=1.609..1.609 rows=0 loops=6278)
                       ->  Seq Scan on film_attr_value film_attr_value_1  (cost=0.00..405.00 rows=1 width=4) (actual time=1.605..1.605 rows=0 loops=6278)
                             Filter: ((film_id = film.id_film) AND (date(value_date) = CURRENT_DATE))
                             Rows Removed by Filter: 10000
                       ->  Index Scan using film_attr_pk on film_attr film_attr_1  (cost=0.29..8.30 rows=1 width=105) (never executed)
                             Index Cond: (id_attr = film_attr_value_1.attr_id)
         SubPlan 2
           ->  Aggregate  (cost=438.31..438.32 rows=1 width=32) (actual time=1.643..1.643 rows=1 loops=6278)
                 ->  Nested Loop  (cost=0.29..438.30 rows=1 width=101) (actual time=0.687..1.632 rows=2 loops=6278)
                       ->  Seq Scan on film_attr_value film_attr_value_2  (cost=0.00..430.00 rows=1 width=4) (actual time=0.673..1.613 rows=2 loops=6278)
                             Filter: ((film_id = film.id_film) AND (date(value_date) > (CURRENT_DATE + '20 days'::interval)))
                             Rows Removed by Filter: 9998
                       ->  Index Scan using film_attr_pk on film_attr film_attr_2  (cost=0.29..8.30 rows=1 width=105) (actual time=0.006..0.006 rows=1 loops=10000)
...
/*==План на 100тыс.строк==*/
 QUERY PLAN                                                               
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Sort  (cost=4146804.67..4147054.67 rows=100000 width=169) (actual time=3455.298..3533.295 rows=63226 loops=1)
   Sort Key: film.title_film
   Sort Method: external merge  Disk: 17328kB
   ->  Group  (cost=22828.98..4129952.85 rows=100000 width=169) (actual time=1159.056..3222.599 rows=63226 loops=1)
         Group Key: film.id_film
         ->  Merge Join  (cost=22828.98..32185.03 rows=100000 width=105) (actual time=1158.789..1364.099 rows=100000 loops=1)
               Merge Cond: (film.id_film = film_attr_value.film_id)
               ->  Index Scan using req4_idfilm on film  (cost=0.29..7607.29 rows=100000 width=105) (actual time=0.061..105.235 rows=100000 loops=1)
               ->  Sort  (cost=22828.13..23078.13 rows=100000 width=4) (actual time=422.158..448.981 rows=100000 loops=1)
                     Sort Key: film_attr_value.film_id
                     Sort Method: external sort  Disk: 1768kB
                     ->  Hash Join  (cost=8611.29..14523.31 rows=100000 width=4) (actual time=120.862..313.958 rows=100000 loops=1)
                           Hash Cond: (film_attr.type_id = film_attr_type.id_type)
                           ->  Hash Join  (cost=4366.00..8842.51 rows=100000 width=8) (actual time=53.646..160.691 rows=100000 loops=1)
                                 Hash Cond: (film_attr_value.attr_id = film_attr.id_attr)
                                 ->  Seq Scan on film_attr_value  (cost=0.00..3041.00 rows=100000 width=8) (actual time=0.023..24.619 rows=100000 loops=1)
                                 ->  Hash  (cost=2725.00..2725.00 rows=100000 width=8) (actual time=53.183..53.185 rows=100000 loops=1)
                                       Buckets: 131072  Batches: 2  Memory Usage: 2976kB
                                       ->  Seq Scan on film_attr  (cost=0.00..2725.00 rows=100000 width=8) (actual time=0.008..22.593 rows=100000 loops=1)
                           ->  Hash  (cost=2604.29..2604.29 rows=100000 width=4) (actual time=66.688..66.689 rows=100000 loops=1)
                                 Buckets: 131072  Batches: 2  Memory Usage: 2781kB
                                 ->  Index Only Scan using req5_idtype on film_attr_type  (cost=0.29..2604.29 rows=100000 width=4) (actual time=0.029..27.749 rows=100000 loops=1)
                                       Heap Fetches: 0
         SubPlan 1
           ->  Aggregate  (cost=20.48..20.49 rows=1 width=32) (actual time=0.009..0.010 rows=1 loops=63226)
                 ->  Nested Loop  (cost=4.60..20.47 rows=1 width=101) (actual time=0.008..0.008 rows=0 loops=63226)
                       ->  Bitmap Heap Scan on film_attr_value film_attr_value_1  (cost=4.31..12.16 rows=1 width=4) (actual time=0.006..0.006 rows=0 loops=63226)
                             Recheck Cond: (film_id = film.id_film)
                             Filter: (date(value_date) = CURRENT_DATE)
                             Rows Removed by Filter: 2
                             Heap Blocks: exact=99970
                             ->  Bitmap Index Scan on req5_filmid  (cost=0.00..4.31 rows=2 width=0) (actual time=0.003..0.003 rows=2 loops=63226)
                                   Index Cond: (film_id = film.id_film)
                       ->  Index Scan using req5_idattr on film_attr film_attr_1  (cost=0.29..8.31 rows=1 width=105) (never executed)
                             Index Cond: (id_attr = film_attr_value_1.attr_id)
         SubPlan 2
           ->  Aggregate  (cost=20.48..20.49 rows=1 width=32) (actual time=0.017..0.018 rows=1 loops=63226)
                 ->  Nested Loop  (cost=4.60..20.48 rows=1 width=101) (actual time=0.010..0.013 rows=2 loops=63226)
:

/*==План на 100тыс.строк, с улучшениями==*/
  QUERY PLAN                                                               
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Sort  (cost=4146804.67..4147054.67 rows=100000 width=169) (actual time=2920.631..2996.641 rows=63226 loops=1)
   Sort Key: film.title_film
   Sort Method: external merge  Disk: 17328kB
   ->  Group  (cost=22828.98..4129952.85 rows=100000 width=169) (actual time=843.965..2708.632 rows=63226 loops=1)
         Group Key: film.id_film
         ->  Merge Join  (cost=22828.98..32185.03 rows=100000 width=105) (actual time=843.791..993.779 rows=100000 loops=1)
               Merge Cond: (film.id_film = film_attr_value.film_id)
               ->  Index Scan using req4_idfilm on film  (cost=0.29..7607.29 rows=100000 width=105) (actual time=0.013..54.420 rows=100000 loops=1)
               ->  Sort  (cost=22828.13..23078.13 rows=100000 width=4) (actual time=408.964..435.178 rows=100000 loops=1)
                     Sort Key: film_attr_value.film_id
                     Sort Method: external sort  Disk: 1768kB
                     ->  Hash Join  (cost=8611.29..14523.31 rows=100000 width=4) (actual time=117.002..308.121 rows=100000 loops=1)
                           Hash Cond: (film_attr.type_id = film_attr_type.id_type)
                           ->  Hash Join  (cost=4366.00..8842.51 rows=100000 width=8) (actual time=64.037..173.866 rows=100000 loops=1)
                                 Hash Cond: (film_attr_value.attr_id = film_attr.id_attr)
                                 ->  Seq Scan on film_attr_value  (cost=0.00..3041.00 rows=100000 width=8) (actual time=0.029..25.734 rows=100000 loops=1)
                                 ->  Hash  (cost=2725.00..2725.00 rows=100000 width=8) (actual time=63.486..63.487 rows=100000 loops=1)
                                       Buckets: 131072  Batches: 2  Memory Usage: 2976kB
                                       ->  Seq Scan on film_attr  (cost=0.00..2725.00 rows=100000 width=8) (actual time=0.024..28.068 rows=100000 loops=1)
                           ->  Hash  (cost=2604.29..2604.29 rows=100000 width=4) (actual time=52.506..52.507 rows=100000 loops=1)
                                 Buckets: 131072  Batches: 2  Memory Usage: 2781kB
                                 ->  Index Only Scan using req5_idtype on film_attr_type  (cost=0.29..2604.29 rows=100000 width=4) (actual time=0.027..20.335 rows=100000 loops=1)
                                       Heap Fetches: 0
         SubPlan 1
           ->  Aggregate  (cost=20.48..20.49 rows=1 width=32) (actual time=0.009..0.009 rows=1 loops=63226)
                 ->  Nested Loop  (cost=4.60..20.47 rows=1 width=101) (actual time=0.007..0.007 rows=0 loops=63226)
                       ->  Bitmap Heap Scan on film_attr_value film_attr_value_1  (cost=4.31..12.16 rows=1 width=4) (actual time=0.005..0.005 rows=0 loops=63226)
                             Recheck Cond: (film_id = film.id_film)
                             Filter: (date(value_date) = CURRENT_DATE)
                             Rows Removed by Filter: 2
                             Heap Blocks: exact=99970
                             ->  Bitmap Index Scan on req6_filmid  (cost=0.00..4.31 rows=2 width=0) (actual time=0.002..0.002 rows=2 loops=63226)
                                   Index Cond: (film_id = film.id_film)
                       ->  Index Scan using req5_idattr on film_attr film_attr_1  (cost=0.29..8.31 rows=1 width=105) (never executed)
                             Index Cond: (id_attr = film_attr_value_1.attr_id)
         SubPlan 2
           ->  Aggregate  (cost=20.48..20.49 rows=1 width=32) (actual time=0.016..0.016 rows=1 loops=63226)
                 ->  Nested Loop  (cost=4.60..20.48 rows=1 width=101) (actual time=0.009..0.012 rows=2 loops=63226)
...


/*==Пречень оптимизаций с пояснениями==
*
*CREATE INDEX req6_valDate ON film_attr_value(value_date);
*CREATE INDEX req6_filmId ON film_attr_value(film_id);
CREATE INDEX req6_titleFilm ON film(title_film);
*
* По JOIN ключи были созданы ранее;
* Уменьшилась стоимость запросов
*/

