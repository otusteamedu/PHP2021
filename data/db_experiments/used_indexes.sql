-------------------
-- часто используемые индексы
-------------------
SELECT
    pg_stat_user_indexes.schemaname || '.' || pg_indexes.tablename AS "table_name",
    indexrelname AS "index_name",
    pg_stat_user_indexes.idx_scan AS "qnt"
FROM pg_stat_user_indexes
JOIN pg_indexes ON pg_stat_user_indexes.indexrelname = pg_indexes.indexname
JOIN pg_stat_user_tables ON pg_stat_user_indexes.relid = pg_stat_user_tables.relid
WHERE pg_stat_user_indexes.schemaname = pg_indexes.schemaname
ORDER by pg_stat_user_indexes.idx_scan DESC
LIMIT  5;

--           table_name           |           index_name           |  qnt
-- -------------------------------+--------------------------------+-------
--  public.movies                 | movies_pkey                    | 79968
--  public.movie_awards           | movie_awards_pkey              | 79852
--  public.movie_attributes       | movie_attributes_pkey          |   190
--  public.movie_attribute_type   | movie_attribute_type_pkey      |    10
--  public.movie_attribute_values | movie_attribute_values_int_idx |     0
-- (5 rows)


-------------------
-- редко используемые индексы
-------------------

SELECT
    pg_stat_user_indexes.schemaname || '.' || pg_indexes.tablename AS "table_name",
    indexrelname AS "index_name",
    pg_stat_user_indexes.idx_scan AS "qnt"
FROM pg_stat_user_indexes
JOIN pg_indexes ON pg_stat_user_indexes.indexrelname = pg_indexes.indexname
JOIN pg_stat_user_tables ON pg_stat_user_indexes.relid = pg_stat_user_tables.relid
WHERE pg_stat_user_indexes.schemaname = pg_indexes.schemaname
ORDER by pg_stat_user_indexes.idx_scan
LIMIT  5;

--           table_name           |           index_name            | qnt
-- -------------------------------+---------------------------------+-----
--  public.movie_attribute_values | movie_attribute_values_int_idx  |   0
--  public.movie_attribute_values | movie_attribute_values_pkey     |   0
--  public.movies                 | movies_name_idx                 |   0
--  public.movie_attribute_values | movie_attribute_values_date_idx |   0
--  public.movie_attribute_type   | movie_attribute_type_pkey       |  10
-- (5 rows)
