SELECT
    s.dt_start,
    s.dt_end,
    s.film_id
FROM public.session s
WHERE s.dt_start BETWEEN current_date::TIMESTAMP - INTERVAL '1 year' AND current_date::TIMESTAMP - INTERVAL '8 months';

--План на 10000 строк:
-- "Seq Scan on session s  (cost=0.00..374.00 rows=1168 width=20)"
-- "  Filter: ((dt_start >= ((CURRENT_DATE)::timestamp without time zone - '1 year'::interval)) AND (dt_start <= ((CURRENT_DATE)::timestamp without time zone - '8 mons'::interval)))"


--План на 10000000 строк:
-- "Gather  (cost=1000.00..199650.90 rows=1199 width=20)"
-- "  Workers Planned: 2"
-- "  ->  Parallel Seq Scan on session s  (cost=0.00..198531.00 rows=500 width=20)"
-- "        Filter: ((dt_start >= ((CURRENT_DATE)::timestamp without time zone - '1 year'::interval)) AND (dt_start <= ((CURRENT_DATE)::timestamp without time zone - '8 mons'::interval)))"
-- "JIT:"
-- "  Functions: 4"
-- "  Options: Inlining false, Optimization false, Expressions true, Deforming true"


--План на 10000000 строк, что удалось улучшить:
-- "Index Scan using i_ses_ds on session s  (cost=0.45..52.39 rows=1197 width=20)"
-- "  Index Cond: ((dt_start >= ((CURRENT_DATE)::timestamp without time zone - '1 year'::interval)) AND (dt_start <= ((CURRENT_DATE)::timestamp without time zone - '8 mons'::interval)))"


--Перечень оптимизаций с пояснениями
DROP INDEX IF EXISTS "i_ses_ds";
CREATE INDEX "i_ses_ds" ON public."session" USING BTREE ("dt_start");
-- ставим индекс на dt_start. Можно партиционировать, но уже в процессе использования системы, так как мы не знаем какие интервалы будут нужны наиболее часто (месяц/квартал/год/финансовый год и т.д.)