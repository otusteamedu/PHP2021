DO $$
DECLARE var_order_status order_status; -- order_status это кастомный тип данных
BEGIN

	FOR index IN 31..100000 LOOP
	IF floor(random() * (2-1+1) + 1) = 1 THEN
    var_order_status := 'PAID';
    ELSE
    var_order_status := 'RESERVED';
    END IF;
		INSERT INTO film (film_id, name, duration, age_limit)
        VALUES (index, concat('Ёлки ', index), trunc(random() * 98 + 52), trunc(random() * 21));

		INSERT INTO session (session_id, cinema_hall_id, film_id, session_datetime)
		VALUES (index, 1, index, NOW() + (random() * (NOW() + '90 days' - NOW())));

		INSERT INTO seat (seat_id, row, place, cinema_hall_id)
		VALUES (index, trunc(random() * 3 + 1), trunc(random() * 4 + 1), floor(random() * (2-1+1) + 1));

		INSERT INTO ticket (ticket_id, session_id, seat_id, purchase_timestamp)
		VALUES (index, index, index, NOW() + (random() * (NOW() + '90 days' - NOW())));

		INSERT INTO client (client_id, email)
		VALUES (index, concat(index,'somemail@mail.ru'));

		INSERT INTO "order" (order_id, client_id, status)
		VALUES (index, index, var_order_status);

		INSERT INTO order_to_ticket (id, order_id, ticket_id)
		VALUES (index, index, index);
	END LOOP;
END;
$$;