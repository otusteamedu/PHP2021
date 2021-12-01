### SORT LIST 15 ITEMS THE BIGGEST SIZE

```
SELECT relname as name,
    pg_size_pretty(pg_total_relation_size(C.oid)) as totalSize,
    pg_size_pretty(pg_relation_size(C.oid)) as relsize
FROM pg_class C
LEFT JOIN pg_namespace pn on C.relnamespace = pn.oid
WHERE nspname NOT IN ('pg_catalog', 'information_schema')
ORDER BY pg_total_relation_size(C.oid) DESC
LIMIT 15;
```

### * 5 most popular index keys

```
SELECT
    idx_stat.indexrelid,
    idx_stat.schemaname || '.' || idx_stat.relname table_name,
    idx_stat.indexrelname index_name,
    idx_stat.idx_scan
FROM pg_stat_all_indexes idx_stat
ORDER BY idx_scan DESC
    LIMIT 5;
```
