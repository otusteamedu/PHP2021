select round(sum(e.price * p.coeficient * o.coeficient)::numeric,2) as amount_money, f.title
from films f
         left join events e ON e.film_id = f.id
         left join orders o on e.id = o.event_id
         left join halls h on h.id = e.hall_id
         left join places p on h.id = p.hall_id
WHERE o.order_status_id = 2
GROUP BY f.title
ORDER BY amount_money
        DESC
    LIMIT 1;