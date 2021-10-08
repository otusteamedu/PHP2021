CREATE TABLE public.clients (
	id serial4 NOT NULL,
	name varchar NOT NULL,
	email varchar NULL,
	phone_number numeric NULL,
	discount int4 NOT NULL,
	CONSTRAINT clients_pkey PRIMARY KEY (id)
);

CREATE TABLE public.halls (
	id serial4 NOT NULL,
	name varchar NOT NULL,
	CONSTRAINT halls_pkey PRIMARY KEY (id)
);

CREATE TABLE public.movies (
	id serial4 NOT NULL,
	name varchar NULL,
	genre varchar NULL,
	CONSTRAINT movies_pkey PRIMARY KEY (id)
);

CREATE TABLE public.seats (
	id serial8 NOT NULL,
	id_hall int4 NOT NULL,
	seat int4 NOT NULL,
	row int4 NOT NULL,
	CONSTRAINT seats_pkey PRIMARY KEY (id),
	CONSTRAINT seats_fk FOREIGN KEY (id_hall) REFERENCES public.halls(id)
);

CREATE TABLE public.sessions (
	id serial8 NOT NULL,
	start_time timestamp NOT NULL,
	start_end timestamp NOT NULL,
	id_hall int4 NOT NULL,
	id_movie int4 NOT NULL,
	price numeric NOT NULL,
	CONSTRAINT sessions_pkey PRIMARY KEY (id),
	CONSTRAINT sessions_fk FOREIGN KEY (id_hall) REFERENCES public.halls(id),
	CONSTRAINT sessions_fk_1 FOREIGN KEY (id_movie) REFERENCES public.movies(id)
);

CREATE TABLE public.tickets (
	id serial8 NOT NULL,
	id_seat int8 NOT NULL,
	id_sessions int8 NOT NULL,
	id_clients int4 NOT NULL,
	final_price numeric NOT NULL,
	CONSTRAINT tickets_pkey PRIMARY KEY (id),
	CONSTRAINT tickets_fk FOREIGN KEY (id_clients) REFERENCES public.clients(id),
	CONSTRAINT tickets_fk_1 FOREIGN KEY (id_seat) REFERENCES public.seats(id),
	CONSTRAINT tickets_fk_2 FOREIGN KEY (id_sessions) REFERENCES public.sessions(id)
);