select *
from 
(select 
	all_indexes.name as name,
	pg_relation_size(quote_ident(all_indexes.name)::text) as size
from (select indexrelname as name from pg_stat_all_indexes where indexrelname !~ 'pg_toast') as all_indexes
union
select
    TABLE_NAME as name,
    total_size AS size
from (
    select
        TABLE_NAME,
        pg_total_relation_size(TABLE_NAME) AS total_size
    from (
        select ('"' || table_schema || '"."' || TABLE_NAME || '"') AS TABLE_NAME
        from information_schema.tables
    ) as all_tables
    order by total_size desc
) as pretty_sizes) as total
order by size desc
limit 15;
