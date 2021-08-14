SELECT
	f.name film_name,
	payment_info.*
FROM
(
	SELECT
		s.film_id,
		SUM(CASE WHEN t.status_id=3 THEN t.price_fact ELSE 0 END) sum_paid,
		SUM(CASE WHEN t.status_id IN(2,3) THEN t.price_fact ELSE 0 END) sum_paid_and_reserved,
		SUM(CASE WHEN t.status_id=3 THEN p.price ELSE 0 END) sum_without_discount,
		SUM(CASE WHEN t.status_id IN(2,3) THEN p.price ELSE 0 END) sum_and_reserved_without_discount
	FROM public.ticket t
	INNER JOIN public.price p ON p.id=t.price_id
	INNER JOIN public.session s ON s.id=p.session_id
	WHERE t.status_id IN(2, 3)
	GROUP BY s.film_id
) payment_info
INNER JOIN public.film f ON f.id=payment_info.film_id
ORDER BY payment_info.sum_paid DESC
LIMIT 1;