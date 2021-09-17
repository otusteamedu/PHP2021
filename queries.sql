-- query 1 (simple) (заказы, для показа с ID = 50)
EXPLAIN ANALYZE
SELECT
     `orders`.`id`,
     `orders`.`seat`
FROM `orders`
WHERE
    `screening` = 50
     AND
     `seat` = 1641
;

-- query 2 (simple) (залы, в которых проходили показы 2000-01-06)
EXPLAIN ANALYZE
SELECT
    DISTINCT(`hall`)
FROM `screenings`
WHERE `ts_start` LIKE '2000-01-06%'
;

-- query 3 (simple) (на какой сеанс продано больше всего билетов)
EXPLAIN ANALYZE
SELECT
    `price_range`, `ts_start`
FROM `screenings`
WHERE
    `hall` = 2
    AND
    `movie` = 1
;


-- query 4 (complex) (самый прибыльный фильм)
EXPLAIN ANALYZE
SELECT
	`movies`.`title`,
	SUM( `price_types_price_ranges`.`value` ) as `total`

FROM
	`orders`
	INNER JOIN `seats` ON  `seats`.`id` = `orders`.`seat`
	INNER JOIN `screenings` ON  `screenings`.`id` = `orders`.`screening`
	INNER JOIN `movies` ON `movies`.`id` = `screenings`.`movie`
	,
	`price_types_price_ranges`

WHERE
	`seats`.`type` = `price_types_price_ranges`.`type`
	AND
	`screenings`.`price_range` = `price_types_price_ranges`.`range`

GROUP BY `screenings`.`movie`

ORDER BY `total` DESC

LIMIT 1
;

-- query 5 (complex) ( средняя цена проданных билетов по каждому залу )
EXPLAIN ANALYZE
SELECT
	`halls`.`title`,
	AVG( `price_types_price_ranges`.`value` ) as `avg_price`

FROM
	`orders`
	INNER JOIN `seats` ON  `seats`.`id` = `orders`.`seat`
	INNER JOIN `screenings` ON  `screenings`.`id` = `orders`.`screening`
	INNER JOIN `halls` ON `halls`.`id` = `screenings`.`hall`
	,
	`price_types_price_ranges`

WHERE
	`seats`.`type` = `price_types_price_ranges`.`type`
	AND
	`screenings`.`price_range` = `price_types_price_ranges`.`range`

GROUP BY `screenings`.`hall`

ORDER BY `halls`.`title`

;


-- query 6 (complex) ( количество билетов, проданных на сеансы каждого дня, когда проводились показы (по дням показов) )
EXPLAIN ANALYZE
SELECT
	COUNT(`orders`.`id`) AS `count_orders`,
	DATE( `screenings`.`ts_start` ) as `YYYY-MM-DD`

FROM
	`orders`
	INNER JOIN `screenings` ON  `screenings`.`id` = `orders`.`screening`

GROUP BY `YYYY-MM-DD`

ORDER BY `YYYY-MM-DD`
;