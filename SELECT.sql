SELECT 
    film_name
FROM 
    films
WHERE
    id = (
        SELECT
            film_id 
        FROM
            sessions 
        WHERE
            id = 
            (
                SELECT
                    session_id,
                    MAX(price_sum) 
                FROM
                    (
                        SELECT
                        session_id,
                        SUM(ticket_price) as price_sum 
                        FROM
                        tickets 
                        GROUP BY
                        session_id 
                    )
                GROUP BY
                    session_id 
            )
    )

