--Самый прибыльный фильм
SELECT
    f.name film_name,
    payment_info.*
FROM (
    SELECT
        s.film_id,
        SUM(CASE WHEN t.status_id=3 THEN t.price_fact ELSE 0 END) sum_paid,
        SUM(CASE WHEN t.status_id IN(2,3) THEN t.price_fact ELSE 0 END) sum_paid_and_reserved,
        SUM(CASE WHEN t.status_id=3 THEN p.price ELSE 0 END) sum_without_discount,
        SUM(CASE WHEN t.status_id IN(2,3) THEN p.price ELSE 0 END) sum_and_reserved_without_discount
    FROM public.ticket t
    INNER JOIN public.price p ON p.id=t.price_id
    INNER JOIN public.session s ON s.id=p.session_id
    WHERE t.status_id IN(2, 3)
    GROUP BY s.film_id
) payment_info
INNER JOIN public.film f ON f.id=payment_info.film_id
ORDER BY payment_info.sum_paid DESC
    LIMIT 1;


--План на 10000 строк:
-- "Limit  (cost=978.48..978.48 rows=1 width=270)"
-- "  ->  Sort  (cost=978.48..978.49 rows=3 width=270)"
-- "        Sort Key: (sum(CASE WHEN (t.status_id = 3) THEN t.price_fact ELSE '0'::numeric END)) DESC"
-- "        ->  Hash Join  (cost=963.02..978.46 rows=3 width=270)"
-- "              Hash Cond: (f.id = s.film_id)"
-- "              ->  Seq Scan on film f  (cost=0.00..14.30 rows=430 width=142)"
-- "              ->  Hash  (cost=962.99..962.99 rows=3 width=132)"
-- "                    ->  HashAggregate  (cost=962.90..962.96 rows=3 width=132)"
-- "                          Group Key: s.film_id"
-- "                          ->  Hash Join  (cost=588.34..812.46 rows=6686 width=17)"
-- "                                Hash Cond: (p.session_id = s.id)"
-- "                                ->  Hash Join  (cost=289.34..495.90 rows=6686 width=17)"
-- "                                      Hash Cond: (t.price_id = p.id)"
-- "                                      ->  Seq Scan on ticket t  (cost=0.00..189.00 rows=6686 width=12)"
-- "                                            Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                                      ->  Hash  (cost=164.15..164.15 rows=10015 width=13)"
-- "                                            ->  Seq Scan on price p  (cost=0.00..164.15 rows=10015 width=13)"
-- "                                ->  Hash  (cost=174.00..174.00 rows=10000 width=8)"
-- "                                      ->  Seq Scan on session s  (cost=0.00..174.00 rows=10000 width=8)"


--План на 10000000 строк:
-- "Limit  (cost=651085.98..651085.98 rows=1 width=270)"
-- "  ->  Sort  (cost=651085.98..651085.99 rows=3 width=270)"
-- "        Sort Key: (sum(CASE WHEN (t.status_id = 3) THEN t.price_fact ELSE '0'::numeric END)) DESC"
-- "        ->  Nested Loop  (cost=651064.66..651085.96 rows=3 width=270)"
-- "              ->  Finalize GroupAggregate  (cost=651064.51..651065.41 rows=3 width=132)"
-- "                    Group Key: s.film_id"
-- "                    ->  Gather Merge  (cost=651064.51..651065.21 rows=6 width=132)"
-- "                          Workers Planned: 2"
-- "                          ->  Sort  (cost=650064.49..650064.50 rows=3 width=132)"
-- "                                Sort Key: s.film_id"
-- "                                ->  Partial HashAggregate  (cost=650064.40..650064.46 rows=3 width=132)"
-- "                                      Group Key: s.film_id"
-- "                                      ->  Parallel Hash Join  (cost=361346.93..587768.34 rows=2768714 width=17)"
-- "                                            Hash Cond: (p.session_id = s.id)"
-- "                                            ->  Parallel Hash Join  (cost=177789.18..348219.71 rows=2768714 width=17)"
-- "                                                  Hash Cond: (t.price_id = p.id)"
-- "                                                  ->  Parallel Seq Scan on ticket t  (cost=0.00..115777.66 rows=2768714 width=12)"
-- "                                                        Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                                                  ->  Parallel Hash  (cost=105361.30..105361.30 rows=4166630 width=13)"
-- "                                                        ->  Parallel Seq Scan on price p  (cost=0.00..105361.30 rows=4166630 width=13)"
-- "                                            ->  Parallel Hash  (cost=115197.00..115197.00 rows=4166700 width=8)"
-- "                                                  ->  Parallel Seq Scan on session s  (cost=0.00..115197.00 rows=4166700 width=8)"
-- "              ->  Index Scan using film_pkey on film f  (cost=0.15..6.83 rows=1 width=142)"
-- "                    Index Cond: (id = s.film_id)"
-- "JIT:"
-- "  Functions: 30"
-- "  Options: Inlining true, Optimization true, Expressions true, Deforming true"


--План на 10000000 строк, что удалось улучшить:
-- "Limit  (cost=550759.37..550759.37 rows=1 width=270)"
-- "  ->  Sort  (cost=550759.37..550759.37 rows=3 width=270)"
-- "        Sort Key: (sum(CASE WHEN (t.status_id = 3) THEN t.price_fact ELSE '0'::numeric END)) DESC"
-- "        ->  Nested Loop  (cost=550738.05..550759.35 rows=3 width=270)"
-- "              ->  Finalize GroupAggregate  (cost=550737.90..550738.79 rows=3 width=132)"
-- "                    Group Key: s.film_id"
-- "                    ->  Gather Merge  (cost=550737.90..550738.60 rows=6 width=132)"
-- "                          Workers Planned: 2"
-- "                          ->  Sort  (cost=549737.88..549737.88 rows=3 width=132)"
-- "                                Sort Key: s.film_id"
-- "                                ->  Partial HashAggregate  (cost=549737.79..549737.85 rows=3 width=132)"
-- "                                      Group Key: s.film_id"
-- "                                      ->  Parallel Hash Join  (cost=330173.15..487238.75 rows=2777735 width=18)"
-- "                                            Hash Cond: (t.price_id = p.id)"
-- "                                            ->  Parallel Seq Scan on ticket_23 t  (cost=0.00..77184.69 rows=2777735 width=13)"
-- "                                                  Filter: (status_id = ANY ('{2,3}'::integer[]))"
-- "                                            ->  Parallel Hash  (cost=257743.71..257743.71 rows=4166675 width=13)"
-- "                                                  ->  Merge Join  (cost=119.15..257743.71 rows=4166675 width=13)"
-- "                                                        Merge Cond: (p.session_id = s.id)"
-- "                                                        ->  Parallel Index Scan using i_p_si on price p  (cost=0.43..192397.29 rows=4166675 width=13)"
-- "                                                        ->  Index Scan using session_pkey on session s  (cost=0.43..333217.43 rows=10000000 width=8)"
-- "              ->  Index Scan using film_pkey on film f  (cost=0.15..6.83 rows=1 width=142)"
-- "                    Index Cond: (id = s.film_id)"
-- "JIT:"
-- "  Functions: 27"
-- "  Options: Inlining true, Optimization true, Expressions true, Deforming true"


--Перечень оптимизаций с пояснениями

--Индекс на price.session_id
DROP INDEX IF EXISTS "i_p_si";
CREATE INDEX "i_p_si" ON public."price" USING BTREE ("session_id");

--Партиционируем таблицу "ticket", одна партиция - дефолтная, вторая - в которой лежат оплаченные или забронированные билеты:
CREATE TABLE IF NOT EXISTS public.ticket_new
(
    id integer NOT NULL DEFAULT nextval('ticket_new_id_seq'::regclass),
    seat_id integer NOT NULL,
    price_id integer NOT NULL,
    status_id integer NOT NULL,
    price_fact numeric(5,2) NOT NULL,
    CONSTRAINT ticket_new_pkey PRIMARY KEY (id, status_id)
    ) PARTITION BY LIST (status_id);

CREATE TABLE public."ticket_not_23" PARTITION OF public."ticket_new" DEFAULT;
CREATE TABLE public."ticket_23" PARTITION OF public."ticket_new" FOR VALUES IN (2, 3);

INSERT INTO public.ticket_new SELECT * FROM public.ticket;

DROP TABLE public.ticket;
ALTER TABLE public.ticket_new RENAME TO "ticket";