--Самый прибыльный зал
SELECT
    h.name hall_name,
    payment_info.*
FROM (
    SELECT
        s.hall_id,
        SUM(CASE WHEN t.status_id=3 THEN t.price_fact ELSE 0 END) sum_paid,
        SUM(CASE WHEN t.status_id IN(2,3) THEN t.price_fact ELSE 0 END) sum_paid_and_reserved,
        SUM(CASE WHEN t.status_id=3 THEN p.price ELSE 0 END) sum_without_discount,
        SUM(CASE WHEN t.status_id IN(2,3) THEN p.price ELSE 0 END) sum_and_reserved_without_discount
    FROM public.ticket t
    INNER JOIN public.price p ON p.id=t.price_id
    INNER JOIN public.session s ON s.id=p.session_id
    WHERE
        t.status_id IN(2, 3) AND
        s.dt_start BETWEEN current_date::TIMESTAMP - INTERVAL '36 months' AND current_date::TIMESTAMP - INTERVAL '35 months'
    GROUP BY s.hall_id
) payment_info
INNER JOIN public.hall h ON h.id=payment_info.hall_id
ORDER BY payment_info.sum_paid DESC;

--План на 10000 строк:
-- "Sort  (cost=808.71..808.72 rows=2 width=270)"
-- "  Sort Key: (sum(CASE WHEN (t.status_id = 3) THEN t.price_fact ELSE '0'::numeric END)) DESC"
-- "  ->  Hash Join  (cost=792.63..808.70 rows=2 width=270)"
-- "        Hash Cond: (h.id = s.hall_id)"
-- "        ->  Seq Scan on hall h  (cost=0.00..14.80 rows=480 width=142)"
-- "        ->  Hash  (cost=792.61..792.61 rows=2 width=132)"
-- "              ->  HashAggregate  (cost=792.55..792.59 rows=2 width=132)"
-- "                    Group Key: s.hall_id"
-- "                    ->  Hash Join  (cost=571.95..788.02 rows=201 width=17)"
-- "                          Hash Cond: (t.price_id = p.id)"
-- "                          ->  Seq Scan on ticket t  (cost=0.00..189.00 rows=6686 width=12)"
-- "                                Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                          ->  Hash  (cost=568.20..568.20 rows=300 width=13)"
-- "                                ->  Hash Join  (cost=377.75..568.20 rows=300 width=13)"
-- "                                      Hash Cond: (p.session_id = s.id)"
-- "                                      ->  Seq Scan on price p  (cost=0.00..164.15 rows=10015 width=13)"
-- "                                      ->  Hash  (cost=374.00..374.00 rows=300 width=8)"
-- "                                            ->  Seq Scan on session s  (cost=0.00..374.00 rows=300 width=8)"
-- "                                                  Filter: ((dt_start >= ((CURRENT_DATE)::timestamp without time zone - '3 years'::interval)) AND (dt_start <= ((CURRENT_DATE)::timestamp without time zone - '2 years 11 mons'::interval)))"


--План на 10000000 строк:
-- "Sort  (cost=441998.46..441998.46 rows=1 width=270)"
-- "  Sort Key: (sum(CASE WHEN (t.status_id = 3) THEN t.price_fact ELSE '0'::numeric END)) DESC"
-- "  ->  Nested Loop  (cost=441990.34..441998.45 rows=1 width=270)"
-- "        ->  GroupAggregate  (cost=441990.19..441990.24 rows=1 width=132)"
-- "              Group Key: s.hall_id"
-- "              ->  Sort  (cost=441990.19..441990.20 rows=1 width=17)"
-- "                    Sort Key: s.hall_id"
-- "                    ->  Gather  (cost=315829.73..441990.18 rows=1 width=17)"
-- "                          Workers Planned: 2"
-- "                          ->  Parallel Hash Join  (cost=314829.73..440990.08 rows=1 width=17)"
-- "                                Hash Cond: (t.price_id = p.id)"
-- "                                ->  Parallel Seq Scan on ticket t  (cost=0.00..115777.66 rows=2768714 width=12)"
-- "                                      Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                                ->  Parallel Hash  (cost=314829.72..314829.72 rows=1 width=13)"
-- "                                      ->  Parallel Hash Join  (cost=198531.01..314829.72 rows=1 width=13)"
-- "                                            Hash Cond: (p.session_id = s.id)"
-- "                                            ->  Parallel Seq Scan on price p  (cost=0.00..105361.30 rows=4166630 width=13)"
-- "                                            ->  Parallel Hash  (cost=198531.00..198531.00 rows=1 width=8)"
-- "                                                  ->  Parallel Seq Scan on session s  (cost=0.00..198531.00 rows=1 width=8)"
-- "                                                        Filter: ((dt_start >= ((CURRENT_DATE)::timestamp without time zone - '3 years'::interval)) AND (dt_start <= ((CURRENT_DATE)::timestamp without time zone - '2 years 11 mons'::interval)))"
-- "        ->  Index Scan using hall_pkey on hall h  (cost=0.15..8.17 rows=1 width=142)"
-- "              Index Cond: (id = s.hall_id)"
-- "JIT:"
-- "  Functions: 33"
-- "  Options: Inlining false, Optimization false, Expressions true, Deforming true"


--План на 10000000 строк, что удалось улучшить:
-- "Sort  (cost=91854.94..91854.95 rows=2 width=270)"
-- "  Sort Key: (sum(CASE WHEN (t.status_id = 3) THEN t.price_fact ELSE '0'::numeric END)) DESC"
-- "  ->  Hash Join  (cost=91838.86..91854.93 rows=2 width=270)"
-- "        Hash Cond: (h.id = s.hall_id)"
-- "        ->  Seq Scan on hall h  (cost=0.00..14.80 rows=480 width=142)"
-- "        ->  Hash  (cost=91838.84..91838.84 rows=2 width=132)"
-- "              ->  Finalize GroupAggregate  (cost=91836.06..91838.82 rows=2 width=132)"
-- "                    Group Key: s.hall_id"
-- "                    ->  Gather Merge  (cost=91836.06..91838.69 rows=4 width=132)"
-- "                          Workers Planned: 2"
-- "                          ->  Partial GroupAggregate  (cost=90836.04..90838.20 rows=2 width=132)"
-- "                                Group Key: s.hall_id"
-- "                                ->  Sort  (cost=90836.04..90836.25 rows=85 width=18)"
-- "                                      Sort Key: s.hall_id"
-- "                                      ->  Hash Join  (cost=3231.26..90833.31 rows=85 width=18)"
-- "                                            Hash Cond: (t.price_id = p.id)"
-- "                                            ->  Parallel Seq Scan on ticket_23 t  (cost=0.00..77184.69 rows=2777735 width=13)"
-- "                                                  Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                                            ->  Hash  (cost=3227.45..3227.45 rows=305 width=13)"
-- "                                                  ->  Nested Loop  (cost=0.89..3227.45 rows=305 width=13)"
-- "                                                        ->  Index Scan using i_ses_ds on session s  (cost=0.45..16.55 rows=305 width=8)"
-- "                                                              Index Cond: ((dt_start >= ((CURRENT_DATE)::timestamp without time zone - '3 years'::interval)) AND (dt_start <= ((CURRENT_DATE)::timestamp without time zone - '2 years 11 mons'::interval)))"
-- "                                                        ->  Index Scan using i_p_si on price p  (cost=0.43..9.75 rows=78 width=13)"
-- "                                                              Index Cond: (session_id = s.id)"


--Перечень оптимизаций с пояснениями
--Сработал Индекс на price.session_id (i_p_si, изменения применены в sql4.sql) и индекс session.dt_start (i_ses_ds, изменения применены в sql1.sql)
--По партициям - тоже, что и в sql4.sql