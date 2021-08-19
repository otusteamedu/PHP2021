SELECT
    t.seat_id,
    t.status_id,
    t.price_fact
FROM public.ticket t
WHERE t.price_fact = 500;

--План на 10000 строк:
-- "Seq Scan on ticket t  (cost=0.00..189.00 rows=906 width=12)"
-- "  Filter: (price_fact = '500'::numeric)"


--План на 10000000 строк:
-- "Seq Scan on ticket t  (cost=0.00..188693.39 rows=884655 width=12)"
-- "  Filter: (price_fact = '500'::numeric)"
-- "JIT:"
-- "  Functions: 4"
-- "  Options: Inlining false, Optimization false, Expressions true, Deforming true"


--План на 10000000 строк, что удалось улучшить:
-- "Bitmap Heap Scan on ticket t  (cost=14251.00..89004.33 rows=884667 width=12)"
-- "  Recheck Cond: (price_fact = '500'::numeric)"
-- "  ->  Bitmap Index Scan on i_t_p_500  (cost=0.00..14029.83 rows=884667 width=0)"


--Перечень оптимизаций с пояснениями
DROP INDEX IF EXISTS "i_t_p";
DROP INDEX IF EXISTS "i_t_p_400";
DROP INDEX IF EXISTS "i_t_p_500";
CREATE INDEX "i_t_p" ON public."ticket" USING BTREE ("price_fact");
CREATE INDEX "i_t_p_400" ON public."ticket" USING BTREE ("price_fact") WHERE price_fact=400;
CREATE INDEX "i_t_p_500" ON public."ticket" USING BTREE ("price_fact") WHERE price_fact=500;
--Делаем в том числе и частичные индексы на price_fact=400 и price_fact=500, так как эти запросы будут часто запрашиваться (билеты, проданные по полным ценам).