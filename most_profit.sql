SELECT f.name as film_name, sum(t.price) as paid_tickets_price
FROM public.order AS o INNER JOIN public.order_to_ticket AS o_to_t ON o_to_t.order_id = o.order_id
INNER JOIN public.ticket AS t ON o_to_t.ticket_id = t.ticket_id
INNER JOIN public.session AS s ON t.session_id = s.session_id
INNER JOIN public.film AS f ON s.film_id = f.film_id
WHERE o.status = 'PAID'
GROUP BY f.name
ORDER BY paid_tickets_price DESC
LIMIT 1;