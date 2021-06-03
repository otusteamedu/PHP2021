SELECT
    `movies`.`name`,
    SUM(IFNULL(`sessions`.`coefficient`, 1) * `group_prices`.`base_price`) AS `total`
FROM `sessions`
INNER JOIN `bookings` ON `bookings`.`session_id` = `sessions`.`id`
INNER JOIN `group_prices` ON `group_prices`.`id` = `bookings`.group_price_id
INNER JOIN `movies` ON `movies`.`id` = `sessions`.`movie_id`
GROUP BY `sessions`.`movie_id`
ORDER BY `total` DESC
LIMIT 1;
