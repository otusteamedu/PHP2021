SELECT
    `movies`.`name`,
    SUM(`transactions`.`paid_sum`) AS `total`
FROM `sessions`
INNER JOIN `bookings` ON `bookings`.`session_id` = `sessions`.`id`
INNER JOIN `transactions` ON `transactions`.`id` = `bookings`.`transaction_id`
INNER JOIN `movies` ON `movies`.`id` = `sessions`.`movie_id`
GROUP BY `sessions`.`movie_id`
ORDER BY `total` DESC
LIMIT 1;
