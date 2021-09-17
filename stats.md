### отсортированный список (15 значений) самых больших по размеру объектов БД (таблицы, включая индексы, сами индексы)

```
SELECT 
	`information_schema`.`TABLES`.`table_name` AS `name`, 
	round(((`information_schema`.`TABLES`.data_length + `information_schema`.`TABLES`.index_length) / 1024 / 1024), 2) `size_in_MB` 
FROM 
	`information_schema`.`TABLES`
	
WHERE `information_schema`.`TABLES`.table_schema = 'cinema'

UNION

SELECT
	`mysql`.`innodb_index_stats`.index_name AS `name`,
	ROUND(`mysql`.`innodb_index_stats`.stat_value * @@innodb_page_size / 1024 / 1024, 2) AS `size_in_MB`
FROM 
	`mysql`.`innodb_index_stats`
	
WHERE 
	`mysql`.`innodb_index_stats`.stat_name = 'size' 
	AND 
	`mysql`.`innodb_index_stats`.index_name != 'PRIMARY'
	AND
	`mysql`.`innodb_index_stats`.database_name = 'cinema'


ORDER BY `size_in_MB` DESC

LIMIT 15
;

+--------------------------+------------+
| name                     | size_in_MB |
+--------------------------+------------+
| orders                   |     782.23 |
| screening                |     247.66 |
| seat                     |     195.77 |
| screening_2              |     192.75 |
| screenings               |       0.97 |
| movie                    |       0.22 |
| hall                     |       0.20 |
| hall_2                   |       0.17 |
| price_range              |       0.16 |
| id                       |       0.16 |
| id_2                     |       0.14 |
| seats                    |       0.09 |
| price_types_price_ranges |       0.05 |
| hall                     |       0.02 |
| halls                    |       0.02 |
+--------------------------+------------+
```

### * отсортированные списки (по 5 значений) самых часто и редко используемых индексов

```
SELECT 
	`OBJECT_NAME`, 
	`INDEX_NAME`, 
	`COUNT_STAR` 
FROM 
	`performance_schema`.`table_io_waits_summary_by_index_usage`
WHERE `object_schema` = 'cinema'
ORDER BY `COUNT_STAR` DESC
LIMIT 5;

+-------------+-------------+------------+
| OBJECT_NAME | INDEX_NAME  | COUNT_STAR |
+-------------+-------------+------------+
| orders      | screening_2 |  220361726 |
| orders      | screening   |   47798481 |
| seats       | PRIMARY     |   33462791 |
| orders      | NULL        |   10000000 |
| screenings  | hall_2      |        412 |
+-------------+-------------+------------+


SELECT 
	`OBJECT_NAME`, 
	`INDEX_NAME`, 
	`COUNT_STAR` 
FROM 
	`performance_schema`.`table_io_waits_summary_by_index_usage`
WHERE 
	`object_schema` = 'cinema'
	AND 
	`COUNT_STAR` > 0
ORDER BY `COUNT_STAR` ASC
LIMIT 5;

+--------------+------------+------------+
| OBJECT_NAME  | INDEX_NAME | COUNT_STAR |
+--------------+------------+------------+
| movies       | NULL       |         20 |
| halls        | NULL       |         24 |
| halls        | PRIMARY    |         75 |
| movies       | PRIMARY    |         75 |
| price_ranges | PRIMARY    |         75 |
+--------------+------------+------------+

```