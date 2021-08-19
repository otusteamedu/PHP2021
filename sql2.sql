SELECT
    p.session_id,
    p.row_id,
    p.price
FROM public.price p
WHERE p.price=400;

--План на 10000 строк:
-- "Seq Scan on price p  (cost=0.00..189.19 rows=1870 width=13)"
-- "  Filter: (price = '400'::numeric)"


--План на 10000000 строк:
-- "Seq Scan on price p  (cost=0.00..188693.91 rows=1831317 width=13)"
-- "  Filter: (price = '400'::numeric)"
-- "JIT:"
-- "  Functions: 4"
-- "  Options: Inlining false, Optimization false, Expressions true, Deforming true"


--План на 10000000 строк, что удалось улучшить:
-- "Bitmap Heap Scan on price p  (cost=29621.66..116208.37 rows=1831337 width=13)"
-- "  Recheck Cond: (price = '400'::numeric)"
-- "  ->  Bitmap Index Scan on i_pr_p_400  (cost=0.00..29163.83 rows=1831337 width=0)"
-- "JIT:"
-- "  Functions: 4"
-- "  Options: Inlining false, Optimization false, Expressions true, Deforming true"


--Перечень оптимизаций с пояснениями
DROP INDEX IF EXISTS "i_pr_p_400";
DROP INDEX IF EXISTS "i_pr_p_500";
CREATE INDEX "i_pr_p_400" ON public."price" USING BTREE ("price") WHERE price=400;
CREATE INDEX "i_pr_p_500" ON public."price" USING BTREE ("price") WHERE price=500;
--Делаем частичные индексы на price=400 и price=500, так как эти запросы будут часто запрашиваться (так как сейчас по факту есть 2 цены продажи - 400 и 500). С течением времени можно будет добавить еще