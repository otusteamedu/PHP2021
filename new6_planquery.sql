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
 Gather  (cost=1236.38..5556.60 rows=2477 width=371) (actual time=9.325..142.953 rows=2475 loops=1)
   Workers Planned: 1
   Workers Launched: 1
   ->  Nested Loop  (cost=236.38..4308.90 rows=1457 width=371) (actual time=8.052..124.597 rows=1238 loops=2)
         ->  Nested Loop  (cost=236.09..3587.74 rows=1457 width=324) (actual time=7.999..105.020 rows=1238 loops=2)
               ->  Hash Join  (cost=235.79..3019.45 rows=1457 width=223) (actual time=7.931..85.974 rows=1238 loops=2)
                     Hash Cond: (film_attr_value.film_id = film.id_film)
                     ->  Parallel Seq Scan on film_attr_value  (cost=0.00..2629.24 rows=58824 width=126) (actual time=0.026..28.273 rows=50000 loops=2)
                     ->  Hash  (cost=204.83..204.83 rows=2477 width=105) (actual time=7.601..7.603 rows=2399 loops=2)
                           Buckets: 4096  Batches: 1  Memory Usage: 360kB
                           ->  Index Scan using req4_idfilm on film  (cost=0.29..204.83 rows=2477 width=105) (actual time=0.086..4.413 rows=2399 loops=2)
                                 Index Cond: ((id_film > 100) AND (id_film < 2500))
               ->  Index Scan using film_attr_pk on film_attr  (cost=0.29..0.39 rows=1 width=109) (actual time=0.012..0.012 rows=1 loops=2475)
                     Index Cond: (id_attr = film_attr_value.attr_id)
         ->  Index Scan using film_attr_type_pk on film_attr_type  (cost=0.29..0.49 rows=1 width=55) (actual time=0.013..0.013 rows=1 loops=2475)
               Index Cond: (id_type = film_attr.type_id)
 Planning Time: 3.308 ms
 Execution Time: 144.466 ms
(18 rows)


/*==Пречень оптимизаций с пояснениями==
*
*1.Добавляем индекс на внешний ключ, по которому идет сортировка
*CREATE INDEX req4_idFilm ON film(id_film);
*2. Как оптимизировать дальше, не понимаю
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
 Gather  (cost=20207.97..42053.55 rows=100000 width=285) (actual time=655.703..792.883 rows=100000 loops=1)
   Workers Planned: 1
   Workers Launched: 1
   ->  Parallel Hash Join  (cost=19207.97..31053.55 rows=58824 width=285) (actual time=626.811..711.136 rows=50000 loops=2)
         Hash Cond: (film_attr_value.attr_id = film_attr.id_attr)
         ->  Parallel Hash Join  (cost=6629.50..12289.16 rows=58824 width=223) (actual time=163.729..241.871 rows=50000 loops=2)
               Hash Cond: (film_attr_value.film_id = film.id_film)
               ->  Parallel Seq Scan on film_attr_value  (cost=0.00..2629.24 rows=58824 width=126) (actual time=0.008..30.576 rows=50000 loops=2)
               ->  Parallel Hash  (cost=5416.67..5416.67 rows=41667 width=105) (actual time=66.960..66.961 rows=50000 loops=2)
                     Buckets: 32768  Batches: 4  Memory Usage: 3840kB
                     ->  Parallel Seq Scan on film  (cost=0.00..5416.67 rows=41667 width=105) (actual time=0.018..20.916 rows=50000 loops=2)
         ->  Parallel Hash  (cost=10521.16..10521.16 rows=58824 width=156) (actual time=299.258..299.261 rows=50000 loops=2)
               Buckets: 32768  Batches: 8  Memory Usage: 2688kB
               ->  Parallel Hash Join  (cost=5692.50..10521.16 rows=58824 width=156) (actual time=178.066..228.811 rows=50000 loops=2)
                     Hash Cond: (film_attr.type_id = film_attr_type.id_type)
                     ->  Parallel Seq Scan on film_attr  (cost=0.00..2313.24 rows=58824 width=109) (actual time=0.010..29.376 rows=50000 loops=2)
                     ->  Parallel Hash  (cost=4764.67..4764.67 rows=41667 width=55) (actual time=99.181..99.182 rows=50000 loops=2)
                           Buckets: 65536  Batches: 4  Memory Usage: 2688kB
                           ->  Parallel Seq Scan on film_attr_type  (cost=0.00..4764.67 rows=41667 width=55) (actual time=0.025..40.897 rows=50000 loops=2)
 Planning Time: 1.469 ms
 Execution Time: 803.579 ms
(21 rows)

/*==План на 100тыс.строк, с улучшениями==*/
/*==Пречень оптимизаций с пояснениями==
*
*
*
*
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
На 100 тыс завис
/*==План на 100тыс.строк, с улучшениями==*/
/*==Пречень оптимизаций с пояснениями==
*
*
*
*
*/


