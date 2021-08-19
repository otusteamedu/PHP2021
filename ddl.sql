CREATE OR REPLACE PROCEDURE create_structure()
LANGUAGE SQL
AS $$
CREATE TABLE IF NOT EXISTS public.hall
(
    id serial NOT NULL,
    name character varying(60) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.segment
(
    id serial NOT NULL,
    hall_id integer NOT NULL,
    name character varying(60) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public."row"
(
    id serial NOT NULL,
    segment_id integer NOT NULL,
    "number" integer NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.seat
(
    id serial NOT NULL,
    row_id integer NOT NULL,
    "number" integer NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.film
(
    id serial NOT NULL,
    name character varying(60) NOT NULL,
    duration interval NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.session
(
    id serial NOT NULL,
    dt_start timestamp with time zone NOT NULL,
    dt_end timestamp with time zone NOT NULL,
    film_id integer NOT NULL,
    hall_id integer NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.price
(
    id serial NOT NULL,
    session_id integer NOT NULL,
    row_id integer NOT NULL,
    price numeric(5, 2) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.ticket_status
(
    id serial NOT NULL,
    name character varying(60) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.ticket
(
    id serial NOT NULL,
    seat_id integer NOT NULL,
    price_id integer NOT NULL,
    status_id integer NOT NULL,
    price_fact numeric(5, 2) NOT NULL,
    PRIMARY KEY (id)
);

ALTER TABLE public.segment
    ADD FOREIGN KEY (hall_id)
        REFERENCES public.hall (id)
    NOT VALID;


ALTER TABLE public."row"
    ADD FOREIGN KEY (segment_id)
        REFERENCES public.segment (id)
    NOT VALID;


ALTER TABLE public.seat
    ADD FOREIGN KEY (row_id)
        REFERENCES public."row" (id)
    NOT VALID;


ALTER TABLE public.session
    ADD FOREIGN KEY (film_id)
        REFERENCES public.film (id)
    NOT VALID;


ALTER TABLE public.session
    ADD FOREIGN KEY (hall_id)
        REFERENCES public.hall (id)
    NOT VALID;


ALTER TABLE public.price
    ADD FOREIGN KEY (session_id)
        REFERENCES public.session (id)
    NOT VALID;


ALTER TABLE public.price
    ADD FOREIGN KEY (row_id)
        REFERENCES public."row" (id)
    NOT VALID;


ALTER TABLE public.ticket
    ADD FOREIGN KEY (price_id)
        REFERENCES public.price (id)
    NOT VALID;


ALTER TABLE public.ticket
    ADD FOREIGN KEY (seat_id)
        REFERENCES public.seat (id)
    NOT VALID;


ALTER TABLE public.ticket
    ADD FOREIGN KEY (status_id)
        REFERENCES public.ticket_status (id)
    NOT VALID;
$$;

CREATE OR REPLACE PROCEDURE drop_structure()
LANGUAGE SQL
AS $$
    DROP TABLE IF EXISTS public.ticket;
    DROP TABLE IF EXISTS public.ticket_status;
    DROP TABLE IF EXISTS public.price;
    DROP TABLE IF EXISTS public.session;
    DROP TABLE IF EXISTS public.seat;
    DROP TABLE IF EXISTS public.row;
    DROP TABLE IF EXISTS public.segment;
    DROP TABLE IF EXISTS public.hall;
    DROP TABLE IF EXISTS public.film;
$$;

CALL drop_structure();
CALL create_structure();
