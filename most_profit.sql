SELECT film.name, sum(seat.price) as paid_tickets_price FROM public.order_to_ticket
INNER JOIN public.ticket ON public.ticket.ticket_id = public.order_to_ticket.ticket_id
INNER JOIN public.seat ON public.seat.seat_id = public.ticket.ticket_id
INNER JOIN public.session ON session.session_id = public.ticket.session_id
INNER JOIN public.film ON film.film_id= session.film_id
INNER JOIN public."order" ON public."order".order_id = order_to_ticket.order_id
WHERE "order".status = 'PAID'
GROUP BY film.name
ORDER BY paid_tickets_price DESC
LIMIT 1;

