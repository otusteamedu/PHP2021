do $$
begin
	insert into cinema (cinema_id, name, address)
	values (1234, 'Байконур', 'Галушкина, 43');

	insert into cinema_hall (cinema_hall_id, cinema_id)
	values (1, 1234);

	for index in 1..1400000 loop
		insert into film (film_id, name, duration, age_limit)
		values (index, concat('Форсаж ', index), trunc(random() * 1000), trunc(random() * 100));
	
		insert into session (session_id, cinema_hall_id, film_id, session_datetime)
		values (index, 1, index, NOW() + (random() * (NOW()+'90 days' - NOW())));
	
		insert into seat 
		values (index, index, index, 1);
	
		insert into ticket (ticket_id, session_id, seat_id, price, purchase_timestamp)
		values (index, index, index, trunc(random() * 1000), NOW() + (random() * (NOW()+'90 days' - NOW())));
	
		insert into client (client_id, email)
		values (index, concat(index,'somemail@mail.ru'));
	
		insert into public.order (order_id, client_id, status)
		values (index, index, 'RESERVED');
	
		insert into order_to_ticket (id, order_id, ticket_id)
		values (index, index, index);
	end loop;
end;
$$;
