--Сколько билетов было продано/зарезервировано со скидкой и без в разрезе фильма
SELECT
    s.film_id,
    f.name,
    SUM(CASE WHEN t.price_fact = p.price THEN 1 ELSE 0 END) sold_without_discount,
    SUM(CASE WHEN t.price_fact != p.price THEN 1 ELSE 0 END) sold_with_discount
FROM public.ticket t
INNER JOIN public.price p ON p.id = t.price_id
INNER JOIN public.session s ON s.id = p.session_id
INNER JOIN public.film f ON f.id = s.film_id
WHERE t.status_id IN(2, 3)
GROUP BY s.film_id, f.name;

--План на 10000 строк:
-- "HashAggregate  (cost=950.15..956.15 rows=600 width=158)"
-- "  Group Key: s.film_id, f.name"
-- "  ->  Hash Join  (cost=608.01..849.86 rows=6686 width=151)"
-- "        Hash Cond: (s.film_id = f.id)"
-- "        ->  Hash Join  (cost=588.34..812.46 rows=6686 width=13)"
-- "              Hash Cond: (p.session_id = s.id)"
-- "              ->  Hash Join  (cost=289.34..495.90 rows=6686 width=13)"
-- "                    Hash Cond: (t.price_id = p.id)"
-- "                    ->  Seq Scan on ticket t  (cost=0.00..189.00 rows=6686 width=8)"
-- "                          Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                    ->  Hash  (cost=164.15..164.15 rows=10015 width=13)"
-- "                          ->  Seq Scan on price p  (cost=0.00..164.15 rows=10015 width=13)"
-- "              ->  Hash  (cost=174.00..174.00 rows=10000 width=8)"
-- "                    ->  Seq Scan on session s  (cost=0.00..174.00 rows=10000 width=8)"
-- "        ->  Hash  (cost=14.30..14.30 rows=430 width=142)"
-- "              ->  Seq Scan on film f  (cost=0.00..14.30 rows=430 width=142)"


--План на 10000000 строк:
-- "Finalize GroupAggregate  (cost=626877.94..627035.95 rows=600 width=158)"
-- "  Group Key: s.film_id, f.name"
-- "  ->  Gather Merge  (cost=626877.94..627017.95 rows=1200 width=158)"
-- "        Workers Planned: 2"
-- "        ->  Sort  (cost=625877.92..625879.42 rows=600 width=158)"
-- "              Sort Key: s.film_id, f.name"
-- "              ->  Partial HashAggregate  (cost=625844.23..625850.23 rows=600 width=158)"
-- "                    Group Key: s.film_id, f.name"
-- "                    ->  Hash Join  (cost=361366.60..584313.52 rows=2768714 width=151)"
-- "                          Hash Cond: (s.film_id = f.id)"
-- "                          ->  Parallel Hash Join  (cost=361346.93..576954.34 rows=2768714 width=13)"
-- "                                Hash Cond: (p.session_id = s.id)"
-- "                                ->  Parallel Hash Join  (cost=177789.18..342811.71 rows=2768714 width=13)"
-- "                                      Hash Cond: (t.price_id = p.id)"
-- "                                      ->  Parallel Seq Scan on ticket t  (cost=0.00..115777.66 rows=2768714 width=8)"
-- "                                            Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                                      ->  Parallel Hash  (cost=105361.30..105361.30 rows=4166630 width=13)"
-- "                                            ->  Parallel Seq Scan on price p  (cost=0.00..105361.30 rows=4166630 width=13)"
-- "                                ->  Parallel Hash  (cost=115197.00..115197.00 rows=4166700 width=8)"
-- "                                      ->  Parallel Seq Scan on session s  (cost=0.00..115197.00 rows=4166700 width=8)"
-- "                          ->  Hash  (cost=14.30..14.30 rows=430 width=142)"
-- "                                ->  Seq Scan on film f  (cost=0.00..14.30 rows=430 width=142)"
-- "JIT:"
-- "  Functions: 33"
-- "  Options: Inlining true, Optimization true, Expressions true, Deforming true"


--План на 10000000 строк, что удалось улучшить:
-- "Finalize GroupAggregate  (cost=537321.59..537479.60 rows=600 width=158)"
-- "  Group Key: s.film_id, f.name"
-- "  ->  Gather Merge  (cost=537321.59..537461.60 rows=1200 width=158)"
-- "        Workers Planned: 2"
-- "        ->  Sort  (cost=536321.56..536323.06 rows=600 width=158)"
-- "              Sort Key: s.film_id, f.name"
-- "              ->  Partial HashAggregate  (cost=536287.88..536293.88 rows=600 width=158)"
-- "                    Group Key: s.film_id, f.name"
-- "                    ->  Hash Join  (cost=330192.82..494621.85 rows=2777735 width=152)"
-- "                          Hash Cond: (s.film_id = f.id)"
-- "                          ->  Parallel Hash Join  (cost=330173.15..487238.75 rows=2777735 width=14)"
-- "                                Hash Cond: (t.price_id = p.id)"
-- "                                ->  Parallel Seq Scan on ticket_23 t  (cost=0.00..77184.69 rows=2777735 width=9)"
-- "                                      Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                                ->  Parallel Hash  (cost=257743.71..257743.71 rows=4166675 width=13)"
-- "                                      ->  Merge Join  (cost=119.15..257743.71 rows=4166675 width=13)"
-- "                                            Merge Cond: (p.session_id = s.id)"
-- "                                            ->  Parallel Index Scan using i_p_si on price p  (cost=0.43..192397.29 rows=4166675 width=13)"
-- "                                            ->  Index Scan using session_pkey on session s  (cost=0.43..333217.43 rows=10000000 width=8)"
-- "                          ->  Hash  (cost=14.30..14.30 rows=430 width=142)"
-- "                                ->  Seq Scan on film f  (cost=0.00..14.30 rows=430 width=142)"
-- "JIT:"
-- "  Functions: 30"
-- "  Options: Inlining true, Optimization true, Expressions true, Deforming true"


--Перечень оптимизаций с пояснениями
--Сработал Индекс на price.session_id (i_p_si, изменения применены в sql4.sql) и индекс session.dt_start (i_ses_ds, изменения применены в sql1.sql)
--По партициям - тоже, что и в sql4.sql