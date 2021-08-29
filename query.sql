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