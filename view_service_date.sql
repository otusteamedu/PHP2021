CREATE VIEW `service_date` AS (
    SELECT
        `movies`.`title`,
        `movies_attributes`.`title` AS `attribute`,
        DATE_FORMAT(`movies_attribute_values`.`value_date`, "%W, %M %e %Y") AS `date`
    FROM
        `movies_attribute_values`
        INNER JOIN `movies` ON `movies`.`id` = `movies_attribute_values`.`movie`
        INNER JOIN `movies_attributes` ON `movies_attributes`.`id` = `movies_attribute_values`.`attribute`
    WHERE
         `movies_attributes`.`type` = 'date_service'
    ORDER BY
        `movies`.`title`,
        `movies_attribute_values`.`value_date`
);