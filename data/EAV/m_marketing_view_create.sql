CREATE VIEW m_marketing (`movie`, `attribute_type`, `attribute`, `value`) AS

SELECT
    `movies`.`name`,
    `movie_attribute_type`.`name`,
    `movie_attributes`.`name`,
    COALESCE(
        `movie_attribute_values`.`val_text`,
        `movie_attribute_values`.`val_date`,
        `movie_attribute_values`.`val_int`,
        `movie_attribute_values`.`val_bool`,
        `movie_attribute_values`.`val_real`,
        `movie_awards`.`name`,
        ''
    )
FROM
    `movies`
LEFT JOIN `movie_attribute_values` ON `movie_attribute_values`.`movie_id` = `movies`.`id`
INNER JOIN `movie_attributes` ON `movie_attribute_values`.movie_attribute_id = `movie_attributes`.`id`
INNER JOIN `movie_attribute_type` ON `movie_attributes`.`movie_attribute_type_id` = `movie_attribute_type`.`id`
LEFT JOIN `movie_awards` ON `movie_attribute_values`.`val_movie_award_id` = `movie_awards`.`id`;
