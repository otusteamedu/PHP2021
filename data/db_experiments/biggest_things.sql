SELECT
    nspname || '.' || relname AS "name",
    pg_size_pretty(pg_relation_size(pg_class.oid)) AS "size"
FROM pg_class
JOIN pg_namespace ON (pg_namespace.oid = pg_class.relnamespace)
WHERE nspname NOT IN ('pg_catalog', 'information_schema')
ORDER BY pg_relation_size(pg_class.oid) DESC
LIMIT 15;

--                  name                  |  size
------------------------------------------+--------
-- public.movie_attribute_values          | 696 kB
-- pg_toast.pg_toast_2618                 | 480 kB
-- public.movie_attributes                | 456 kB
-- public.movies                          | 448 kB
-- public.movie_awards                    | 448 kB
-- public.movie_attribute_values_pkey     | 360 kB
-- public.movies_name_idx                 | 288 kB
-- public.movie_awards_pkey               | 240 kB
-- public.movies_pkey                     | 240 kB
-- public.movie_attributes_pkey           | 240 kB
-- public.movie_attribute_values_date_idx | 160 kB
-- public.movie_attribute_values_int_idx  | 88 kB
-- pg_toast.pg_toast_2619                 | 40 kB
-- public.movie_attribute_type_pkey       | 16 kB
-- pg_toast.pg_toast_2618_index           | 16 kB
--(15 rows)
