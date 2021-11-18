SELECT `film`.`title_film`,sum(`ticket`.`price_fact`) as `max_total` from `film` 
INNER JOIN `session` ON `film`.`id_film` = `session`.`film_id` 
INNER JOIN `ticket` ON `session`.`id_session` = `ticket`.`session_id` 
INNER JOIN `price` ON `session`.`id_session` = `price`.`session_id` 
WHERE `ticket`.`stat_paidfor`=1
GROUP BY `film`.`title_film`
ORDER BY `max_total` DESC
LIMIT 1