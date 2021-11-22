CREATE VIEW `marketing` AS (
    SELECT
        `movies`.`title`,
        `movies_attribute_types`.`title` AS `type`,
        `movies_attributes`.`title` AS `attribute`,
        CASE
            WHEN ( `movies_attributes`.`type` = 'date_service' ) OR ( `movies_attributes`.`type` = 'date_public' ) THEN DATE_FORMAT(`movies_attribute_values`.`value_date`, "%W, %M %e %Y")
            WHEN ( `movies_attributes`.`type` = 'boolean' ) THEN
                CASE
                    WHEN ( `movies_attribute_values`.`value_boolean` = '0' ) THEN 'Лауреат'
                    WHEN ( `movies_attribute_values`.`value_boolean` = '1' ) THEN 'Победитель'
                END
            WHEN ( `movies_attributes`.`type` = 'integer' ) THEN FORMAT(`movies_attribute_values`.`value_integer`, 0)
            WHEN ( `movies_attributes`.`type` = 'float' ) THEN FORMAT(`movies_attribute_values`.`value_float`, 1)
            ELSE
                COALESCE(
                    `movies_attribute_values`.`value_string`,
                    `movies_attribute_values`.`value_text`
                )
        END AS `value`
    FROM
        `movies_attribute_values`
        INNER JOIN `movies` ON `movies`.`id` = `movies_attribute_values`.`movie`
        INNER JOIN `movies_attributes` ON `movies_attributes`.`id` = `movies_attribute_values`.`attribute`
        INNER JOIN `movies_attribute_types` ON `movies_attribute_types`.`name` = `movies_attributes`.`type`

    ORDER BY
        `movies`.`title`,
        `type`,
        `attribute`
);

