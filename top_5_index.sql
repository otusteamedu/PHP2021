--Rarely used indexes

select indexrelname, idx_scan 
from pg_stat_all_indexes
order by idx_scan asc 
limit 5;

--______________________
--Frequently used indexes

select indexrelname, idx_scan 
from pg_stat_all_indexes
order by idx_scan desc 
limit 5;
