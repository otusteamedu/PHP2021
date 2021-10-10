--Генерация 10000000 строк
do $$

declare
	max_movies int := 1000;
	max_clients int := 20000;
	max_halls int := 100;
	max_seats int := 10000000;
	max_sessions int := 100000;
	max_tickets int := 10000000;
	
	min_id_halls int;
	max_id_halls int;
	min_id_movies int;
	max_id_movies int;
	min_id_clients int;
	max_id_clients int;
	min_id_seats int;
	max_id_seats int;
	min_id_sessions int;
	max_id_sessions int;

begin

	insert into public.movies (name, genre)
	select
	  CONCAT('Фильм ' || gs.id)::text,
	  CONCAT('Жанр ' || floor(random()*(10-1+1))+1)::text
	from generate_series(1,max_movies) as gs(id);

	insert into public.clients (name, email, phone_number, discount)
	select
	  CONCAT('Имя ' || gs.id)::text,
	  CONCAT(gs.id || '@' || gs.id || '.com')::text,
	  CONCAT('+7', floor(random()*(9999999999-1111111111)))::int8,
	  CONCAT(floor(random()*(30-1)+1))::int4
	from generate_series(1,max_clients) as gs(id);

	insert into public.halls ("name")
	select
	  CONCAT(gs.id)::int4
	from generate_series(1,max_halls) as gs(id);

	min_id_halls := (select min(id) from halls);
	max_id_halls := (select max(id) from halls);

	insert into public.seats (id_hall, seat, row)
	select
	  CONCAT(floor(random()*(max_id_halls-min_id_halls+1)+min_id_halls))::int8,
	  CONCAT(floor(random()*(10-1+1)+1))::int4,
	  CONCAT(floor(random()*(10-1+1)+1))::int4
	from generate_series(1,max_seats) as gs(id);

	min_id_movies := (select min(id) from movies);
	max_id_movies := (select max(id) from movies);

	insert into public.sessions (start_time, start_end, id_hall, id_movie, price)
	select
	  CONCAT(to_timestamp(1633246568 + gs.id))::timestamp,
	  CONCAT(to_timestamp(1633246568 + gs.id + 3600 + (random() * (10800 - 5400))))::timestamp,
	  CONCAT(floor(random()*(max_id_halls-min_id_halls+1)+min_id_halls))::int8,
	  CONCAT(floor(random()*(max_id_movies-min_id_movies+1)+min_id_movies))::int8,
	  CONCAT(floor(random()*(500-150+1)+150))::int4
	from generate_series(1,max_sessions) as gs(id);

	min_id_clients := (select min(id) from clients);
	max_id_clients := (select max(id) from clients);

	min_id_seats := (select min(id) from seats);
	max_id_seats := (select max(id) from seats);

	min_id_sessions := (select min(id) from sessions);
	max_id_sessions := (select max(id) from sessions);

	insert into public.tickets (id_seat, id_sessions, id_clients, final_price)
	select
		CONCAT(floor(random()*(max_id_seats-min_id_seats+1)+min_id_seats))::int8, 
		CONCAT(floor(random()*(max_id_sessions-min_id_sessions+1)+min_id_sessions))::int8,
		CONCAT(floor(random()*(max_id_clients-min_id_clients+1)+min_id_clients))::int8,
		CONCAT(floor(random()*(500-150+1)+150))::int4
	from generate_series(1,max_tickets) as gs(id);
end $$;