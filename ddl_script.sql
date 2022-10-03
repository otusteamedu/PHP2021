SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

CREATE TYPE public.order_status AS ENUM (
    'PAID',
    'CANCELED',
    'RESERVED'
    );


ALTER TYPE public.order_status OWNER TO postgres;

CREATE SEQUENCE public.cinema_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.cinema_id_seq OWNER TO postgres;

SET default_tablespace = '';
SET default_table_access_method = heap;

CREATE TABLE public.cinema (
                               cinema_id integer DEFAULT nextval('public.cinema_id_seq'::regclass) NOT NULL,
                               name character varying(30) NOT NULL,
                               address character varying(50)
);

ALTER TABLE public.cinema OWNER TO postgres;

CREATE SEQUENCE public.cinema_hall_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cinema_hall_id_seq OWNER TO postgres;

CREATE TABLE public.cinema_hall (
                                    cinema_hall_id integer DEFAULT nextval('public.cinema_hall_id_seq'::regclass) NOT NULL,
                                    number integer,
                                    cinema_id integer
);

ALTER TABLE public.cinema_hall OWNER TO postgres;

CREATE SEQUENCE public.client_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.client_id_seq OWNER TO postgres;

CREATE TABLE public.client (
                               client_id integer DEFAULT nextval('public.client_id_seq'::regclass) NOT NULL,
                               email character varying(30)
);

ALTER TABLE public.client OWNER TO postgres;

CREATE SEQUENCE public.film_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.film_id_seq OWNER TO postgres;

CREATE TABLE public.film (
                             film_id integer DEFAULT nextval('public.film_id_seq'::regclass) NOT NULL,
                             name character varying(30) NOT NULL,
                             duration integer,
                             age_limit integer
);

ALTER TABLE public.film OWNER TO postgres;

CREATE SEQUENCE public.order_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_id_seq OWNER TO postgres;

CREATE TABLE public."order" (
                                order_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
                                client_id integer NOT NULL,
                                status public.order_status
);

ALTER TABLE public."order" OWNER TO postgres;

CREATE SEQUENCE public.order_ticket_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.order_ticket_seq OWNER TO postgres;

CREATE TABLE public.order_to_ticket (
                                        id integer DEFAULT nextval('public.order_ticket_seq'::regclass) NOT NULL,
                                        order_id integer NOT NULL,
                                        ticket_id integer NOT NULL
);

ALTER TABLE public.order_to_ticket OWNER TO postgres;

CREATE TABLE public.rows (
                             row_id smallint NOT NULL,
                             price smallint DEFAULT 200 NOT NULL
);

ALTER TABLE public.rows OWNER TO postgres;

CREATE SEQUENCE public.seat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.seat_id_seq OWNER TO postgres;

CREATE TABLE public.seat (
                             seat_id integer DEFAULT nextval('public.seat_id_seq'::regclass) NOT NULL,
                             "row" integer NOT NULL,
                             "place" integer NOT NULL,
                             cinema_hall_id integer NOT NULL
);


ALTER TABLE public.seat OWNER TO postgres;

CREATE SEQUENCE public.session_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.session_id_seq OWNER TO postgres;

CREATE TABLE public.session (
                                session_id integer DEFAULT nextval('public.session_id_seq'::regclass) NOT NULL,
                                cinema_hall_id integer NOT NULL,
                                film_id integer NOT NULL,
                                session_datetime timestamp with time zone NOT NULL
);

ALTER TABLE public.session OWNER TO postgres;

CREATE SEQUENCE public.ticket_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.ticket_id_seq OWNER TO postgres;

CREATE TABLE public.ticket (
                               ticket_id integer DEFAULT nextval('public.ticket_id_seq'::regclass) NOT NULL,
                               session_id integer NOT NULL,
                               seat_id integer NOT NULL,
                               purchase_timestamp timestamp with time zone
);

ALTER TABLE public.ticket OWNER TO postgres;

COPY public.cinema (cinema_id, name, address) FROM stdin;
1	Red star\n	Lenin street 51, Penza
\.

COPY public.cinema_hall (cinema_hall_id, number, cinema_id) FROM stdin;
1	1	1
2	2	1
\.

COPY public.client (client_id, email) FROM stdin;
1	pupkin@mail.ru\n
2	ivanov@email.com
3	zalupin@mail.ru
4	jopinko@mail.ru
5	petuhov@mail.com
6	petuhov-burianov@mail.ru
7	ulanov@mail.ru
8	balabay@mail.ru\n
9	serducov@mail.ru
10	svirdovskiy@mail.ru
\.

COPY public.film (film_id, name, duration, age_limit) FROM stdin;
1	Batman	120	6
2	Suckman	90	15
3	Alince in wonderland	110	9
4	Look up	80	6
5	Straight ahead	100	10
\.

COPY public."order" (order_id, client_id, status) FROM stdin;
1	1	PAID
2	2	PAID
3	3	PAID
4	4	PAID
5	5	PAID
6	6	PAID
7	7	RESERVED
8	8	PAID
9	9	PAID
10	10	PAID
11	1	PAID
12	2	PAID
13	3	PAID
14	4	PAID
15	5	PAID
16	6	PAID
17	7	PAID
18	8	PAID
19	9	PAID
20	10	PAID
21	1	PAID
22	2	PAID
23	3	PAID
24	4	PAID
25	5	PAID
26	6	PAID
27	7	PAID
28	8	PAID
29	9	PAID
30	10	PAID
\.

COPY public.order_to_ticket (id, order_id, ticket_id) FROM stdin;
1	1	1
2	2	2
3	3	3
4	4	4
5	5	5
6	6	6
7	7	7
8	8	8
9	9	9
10	10	10
11	11	11
12	12	12
13	13	13
14	14	14
15	15	15
16	16	16
17	17	17
18	18	18
19	19	19
20	20	20
21	21	21
22	22	22
23	23	23
24	24	24
25	25	25
26	26	26
27	27	27
28	28	28
29	29	29
30	30	30
\.

COPY public.rows (row_id, price) FROM stdin;
1	200
2	300
3	400
\.

COPY public.seat (seat_id, "row", "place", cinema_hall_id) FROM stdin;
1	1	1	1
2	1	2	1
3	1	3	1
4	1	4	1
5	1	5	1
6	2	1	1
7	2	2	1
8	2	3	1
9	2	4	1
10	2	5	1
11	1	1	2
12	1	2	2
13	1	3	2
14	1	4	2
15	1	5	2
16	2	1	2
17	2	2	2
18	2	3	2
19	2	4	2
20	2	5	2
21	3	1	1
22	3	2	1
23	3	3	1
24	3	4	1
25	3	5	1
26	3	1	2
27	3	2	2
28	3	3	2
29	3	4	2
30	3	5	2
\.

COPY public.session (session_id, cinema_hall_id, film_id, session_datetime) FROM stdin;
1	1	2	2022-05-30 00:00:00+03
2	1	1	2022-05-29 00:00:00+03
3	1	2	2022-05-30 00:00:00+03
4	1	4	2022-05-28 00:00:00+03
5	1	2	2022-05-29 00:00:00+03
6	2	3	2022-05-25 00:00:00+03
7	2	4	2022-05-28 00:00:00+03
8	2	1	2022-05-30 00:00:00+03
9	2	5	2022-05-27 00:00:00+03
10	2	4	2022-05-28 00:00:00+03
\.

COPY public.ticket (ticket_id, session_id, seat_id, purchase_timestamp) FROM stdin;
1	1	1	2022-05-30 00:00:00+03
2	1	2	2022-05-30 00:00:00+03
3	1	3	2022-05-30 00:00:00+03
4	1	4	2022-05-30 00:00:00+03
5	1	5	2022-05-30 00:00:00+03
6	2	6	2022-05-30 00:00:00+03
7	2	7	2022-05-30 00:00:00+03
8	2	8	2022-05-30 00:00:00+03
9	3	9	2022-05-30 00:00:00+03
10	3	10	2022-05-30 00:00:00+03
11	3	11	2022-05-30 00:00:00+03
12	3	12	2022-05-30 00:00:00+03
13	4	13	2022-05-25 00:00:00+03
14	4	14	2022-05-25 00:00:00+03
15	4	15	2022-05-25 00:00:00+03
16	5	16	2022-05-30 00:00:00+03
17	5	17	2022-05-30 00:00:00+03
18	6	18	2022-05-25 00:00:00+03
19	6	19	2022-05-25 00:00:00+03
20	6	20	2022-05-25 00:00:00+03
21	6	21	2022-05-25 00:00:00+03
22	7	22	2022-05-28 00:00:00+03
23	7	23	2022-05-28 00:00:00+03
24	8	24	2022-05-30 00:00:00+03
25	8	25	2022-05-30 00:00:00+03
26	8	26	2022-05-30 00:00:00+03
27	8	27	2020-05-30 00:00:00+03
28	9	28	2022-05-27 00:00:00+03
29	9	29	2022-05-27 00:00:00+03
30	10	30	2022-05-28 00:00:00+03
\.

SELECT pg_catalog.setval('public.cinema_hall_id_seq', 1, false);
SELECT pg_catalog.setval('public.cinema_id_seq', 1, false);
SELECT pg_catalog.setval('public.client_id_seq', 1, false);
SELECT pg_catalog.setval('public.film_id_seq', 1, false);
SELECT pg_catalog.setval('public.order_id_seq', 1, false);
SELECT pg_catalog.setval('public.order_ticket_seq', 1, false);
SELECT pg_catalog.setval('public.seat_id_seq', 1, false);
SELECT pg_catalog.setval('public.session_id_seq', 1, false);
SELECT pg_catalog.setval('public.ticket_id_seq', 1, false);

ALTER TABLE ONLY public.cinema_hall
    ADD CONSTRAINT cinema_hall_pk PRIMARY KEY (cinema_hall_id);

ALTER TABLE ONLY public.cinema
    ADD CONSTRAINT cinema_pkey PRIMARY KEY (cinema_id);

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (client_id);

ALTER TABLE ONLY public.film
    ADD CONSTRAINT film_pkey PRIMARY KEY (film_id);

ALTER TABLE ONLY public."order"
    ADD CONSTRAINT order_pkey PRIMARY KEY (order_id);

ALTER TABLE ONLY public.order_to_ticket
    ADD CONSTRAINT order_to_ticket_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.rows
    ADD CONSTRAINT rows_pkey PRIMARY KEY (row_id);

ALTER TABLE ONLY public.seat
    ADD CONSTRAINT seat_pkey PRIMARY KEY (seat_id);

ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_id_pk PRIMARY KEY (session_id);

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_pkey PRIMARY KEY (ticket_id);

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_seat_uni UNIQUE (seat_id);

ALTER TABLE ONLY public.cinema_hall
    ADD CONSTRAINT cinema_hall_fk FOREIGN KEY (cinema_id) REFERENCES public.cinema(cinema_id) NOT VALID;

ALTER TABLE ONLY public."order"
    ADD CONSTRAINT order_client_fk FOREIGN KEY (client_id) REFERENCES public.client(client_id) NOT VALID;

ALTER TABLE ONLY public.order_to_ticket
    ADD CONSTRAINT order_fk FOREIGN KEY (order_id) REFERENCES public."order"(order_id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;

ALTER TABLE ONLY public.seat
    ADD CONSTRAINT seat_hall_fk FOREIGN KEY (cinema_hall_id) REFERENCES public.cinema_hall(cinema_hall_id);

ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_film_fk FOREIGN KEY (film_id) REFERENCES public.film(film_id) NOT VALID;

ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_hall_fk FOREIGN KEY (cinema_hall_id) REFERENCES public.cinema_hall(cinema_hall_id);

ALTER TABLE ONLY public.order_to_ticket
    ADD CONSTRAINT ticket_fk FOREIGN KEY (ticket_id) REFERENCES public.ticket(ticket_id) NOT VALID;

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_seat_fk FOREIGN KEY (seat_id) REFERENCES public.seat(seat_id) NOT VALID;

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_session_fk FOREIGN KEY (session_id) REFERENCES public.session(session_id) NOT VALID;