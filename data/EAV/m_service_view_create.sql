CREATE VIEW m_service (`movie`, `doings_before_20_days`, `doings_after_20_days`) AS

SELECT
    `movies`.`name`,
    GROUP_CONCAT(
        IF (`movie_attribute_values`.`val_date` BETWEEN NOW() AND NOW() + INTERVAL 20 DAY, `movie_attributes`.`name` , null)
    ),
    GROUP_CONCAT(
        IF (`movie_attribute_values`.`val_date` >= NOW() + INTERVAL 20 DAY, `movie_attributes`.`name` , null)
    )
FROM
    `movies`
LEFT JOIN `movie_attribute_values` ON `movie_attribute_values`.`movie_id` = `movies`.`id`
INNER JOIN `movie_attributes` ON `movie_attribute_values`.movie_attribute_id = `movie_attributes`.`id`
INNER JOIN `movie_attribute_type` ON `movie_attributes`.`movie_attribute_type_id` = `movie_attribute_type`.`id`
WHERE `movie_attribute_type`.`id` = 4
GROUP BY `movies`.`id`;
