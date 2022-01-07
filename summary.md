Индекс показал результат только в тех запросах, где происходят вычесления, просто в сложных запросах индекс показал результат, когда 10000 строк, 
если просто добавить индекс по условию он не даст результат, лучше пересмотреть структуру таблиц, настройки СУБД и сами запросы

отсортированный список (15 значений) самых больших по размеру объектов БД (таблицы, включая индексы, сами индексы)
запрос:
SELECT nspname || '.' || relname AS "relation",
pg_size_pretty(pg_relation_size(C.oid)) AS "size"
FROM pg_class C
LEFT JOIN pg_namespace N ON (N.oid = C.relnamespace)
WHERE nspname NOT IN ('pg_catalog', 'information_schema')
ORDER BY pg_relation_size(C.oid) DESC
LIMIT 15;

ответ:
relation         |  size   
--------------------------+---------
public.halls             | 2112 MB
public.attribute_value   | 1149 MB
public.avnn              | 986 MB
public.avdt              | 986 MB
public.films             | 946 MB
public.session           | 651 MB
public.tickets           | 645 MB
public.attribute         | 495 MB
public.attribute_type    | 455 MB
public.id                | 415 MB
public.atribute_value_pk | 214 MB
public.films_id_idx      | 214 MB
public.t_id              | 214 MB
public.films_pk          | 214 MB
public.atributes_type_pk | 214 MB
(15 rows)

отсортированные списки (по 5 значений) самых часто и редко используемых индексов
запрос:
SELECT
idx_stat.indexrelid,
idx_stat.schemaname || '.' || idx_stat.relname table_name,
idx_stat.indexrelname index_name,
idx_stat.idx_scan
FROM pg_stat_all_indexes idx_stat
ORDER BY idx_scan DESC
LIMIT 5;

ответ:
indexrelid |      table_name       |    index_name     | idx_scan
------------+-----------------------+-------------------+----------
16513 | public.films          | films_id_idx      | 20000000
16397 | public.attribute_type | atributes_type_pk | 10000030
16519 | public.attribute      | atributes_pk      | 10000000
16496 | public.halls          | id                | 10000000
16550 | public.session        | s_id              | 10000000
(5 rows)
