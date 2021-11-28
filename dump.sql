--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)

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

--
-- Name: attribute_types_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.attribute_types_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_types_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: attribute_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attribute_types (
    id integer DEFAULT nextval('public.attribute_types_seq'::regclass) NOT NULL,
    attribute_type_name character varying NOT NULL
);


ALTER TABLE public.attribute_types OWNER TO postgres;

--
-- Name: attribute_values_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.attribute_values_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_values_seq OWNER TO postgres;

--
-- Name: attribute_values; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attribute_values (
    id integer DEFAULT nextval('public.attribute_values_seq'::regclass) NOT NULL,
    film_id integer NOT NULL,
    attribute_id integer NOT NULL,
    date date,
    "boolean" smallint,
    text text,
    "float" numeric(10,2)
);


ALTER TABLE public.attribute_values OWNER TO postgres;

--
-- Name: attributes_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.attributes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attributes_seq OWNER TO postgres;

--
-- Name: attributes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attributes (
    id integer DEFAULT nextval('public.attributes_seq'::regclass) NOT NULL,
    attribute_type_id integer NOT NULL,
    attribute_name character varying NOT NULL
);


ALTER TABLE public.attributes OWNER TO postgres;

--
-- Name: films_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.films_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.films_seq OWNER TO postgres;

--
-- Name: films; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.films (
    id integer DEFAULT nextval('public.films_seq'::regclass) NOT NULL,
    name character varying(255) DEFAULT ''''::character varying NOT NULL
);


ALTER TABLE public.films OWNER TO postgres;

--
-- Name: films_attributes; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.films_attributes AS
 SELECT f.name AS film_name,
    at.attribute_type_name AS attribute_type,
    a.attribute_name,
        CASE
            WHEN ((at.attribute_type_name)::text = 'boolean'::text) THEN (av.id)::text
            WHEN ((at.attribute_type_name)::text = 'date'::text) THEN (av.date)::text
            WHEN ((at.attribute_type_name)::text = 'float'::text) THEN (av."float")::text
            ELSE av.text
        END AS attribute_value
   FROM (((public.films f
     LEFT JOIN public.attribute_values av ON ((av.film_id = f.id)))
     LEFT JOIN public.attributes a ON ((a.id = av.attribute_id)))
     LEFT JOIN public.attribute_types at ON ((at.id = a.attribute_type_id)));


ALTER TABLE public.films_attributes OWNER TO postgres;

--
-- Name: films_tasks; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.films_tasks AS
 SELECT f.name,
    array_to_string(ARRAY( SELECT ((av1.date || ' '::text) || (a1.attribute_name)::text)
           FROM (public.attribute_values av1
             LEFT JOIN public.attributes a1 ON ((a1.id = av1.attribute_id)))
          WHERE ((av1.date = CURRENT_DATE) AND (av1.film_id = f.id))), ', '::text) AS tasks_today,
    array_to_string(ARRAY( SELECT ((av2.date || ' '::text) || (a2.attribute_name)::text)
           FROM (public.attribute_values av2
             LEFT JOIN public.attributes a2 ON ((a2.id = av2.attribute_id)))
          WHERE ((av2.date >= (CURRENT_DATE + 20)) AND (av2.film_id = f.id))), ', '::text) AS tasks_20day
   FROM public.films f;


ALTER TABLE public.films_tasks OWNER TO postgres;

--
-- Name: halls_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.halls_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.halls_seq OWNER TO postgres;

--
-- Name: halls; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.halls (
    id integer DEFAULT nextval('public.halls_seq'::regclass) NOT NULL,
    name character varying(512) DEFAULT ''''::character varying NOT NULL,
    num_rows smallint NOT NULL,
    num_seats smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.halls OWNER TO postgres;

--
-- Name: prices_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prices_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prices_seq OWNER TO postgres;

--
-- Name: prices; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prices (
    id integer DEFAULT nextval('public.prices_seq'::regclass) NOT NULL,
    row_min smallint NOT NULL,
    row_max smallint NOT NULL,
    "time" time(0) without time zone NOT NULL,
    price numeric(10,2) DEFAULT NULL::numeric NOT NULL
);


ALTER TABLE public.prices OWNER TO postgres;

--
-- Name: sales_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sales_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sales_seq OWNER TO postgres;

--
-- Name: sales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sales (
    id integer DEFAULT nextval('public.sales_seq'::regclass) NOT NULL,
    session_id integer NOT NULL,
    "row" smallint NOT NULL,
    seat smallint NOT NULL,
    price numeric(10,2) DEFAULT NULL::numeric NOT NULL
);


ALTER TABLE public.sales OWNER TO postgres;

--
-- Name: sessions_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sessions_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sessions_seq OWNER TO postgres;

--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id integer DEFAULT nextval('public.sessions_seq'::regclass) NOT NULL,
    hall_id integer NOT NULL,
    film_id integer NOT NULL,
    date date NOT NULL,
    "time" time(0) without time zone NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Data for Name: attribute_types; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.attribute_types (id, attribute_type_name) FROM stdin;
1	date
2	boolean
3	text
4	float
\.


--
-- Data for Name: attribute_values; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.attribute_values (id, film_id, attribute_id, date, "boolean", text, "float") FROM stdin;
1	1	1	\N	\N	Рецензия	\N
2	2	1	\N	\N	Рецензия на фильм 2	\N
3	1	2	\N	1	\N	\N
4	2	2	\N	1	\N	\N
9	1	5	2021-09-08	\N	\N	\N
10	2	5	2021-09-08	\N	\N	\N
11	1	6	2021-09-08	\N	\N	\N
12	2	6	2021-09-08	\N	\N	\N
5	1	3	2021-11-30	\N	\N	\N
6	2	3	2021-11-28	\N	\N	\N
8	2	4	2021-11-28	\N	\N	\N
7	1	4	2022-01-01	\N	\N	\N
13	1	7	\N	\N	\N	600.20
14	2	7	\N	\N	\N	800.00
\.


--
-- Data for Name: attributes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.attributes (id, attribute_type_id, attribute_name) FROM stdin;
1	3	Рецензии
2	2	Премия
3	1	Мировая премьера
4	1	Премьера в РФ
5	1	Дата начала продажи билетов
6	1	Дата запуска рекламы на ТВ
7	4	Средняя стоимость билета
\.


--
-- Data for Name: films; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.films (id, name) FROM stdin;
1	Фильм 1
2	Фильм 2
\.


--
-- Data for Name: halls; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.halls (id, name, num_rows, num_seats) FROM stdin;
\.


--
-- Data for Name: prices; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prices (id, row_min, row_max, "time", price) FROM stdin;
\.


--
-- Data for Name: sales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sales (id, session_id, "row", seat, price) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, hall_id, film_id, date, "time") FROM stdin;
\.


--
-- Name: attribute_types_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.attribute_types_seq', 3, true);


--
-- Name: attribute_values_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.attribute_values_seq', 14, true);


--
-- Name: attributes_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.attributes_seq', 6, true);


--
-- Name: films_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.films_seq', 2, true);


--
-- Name: halls_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.halls_seq', 1, false);


--
-- Name: prices_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prices_seq', 1, false);


--
-- Name: sales_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sales_seq', 1, false);


--
-- Name: sessions_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sessions_seq', 1, false);


--
-- Name: attribute_types attribute_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_types
    ADD CONSTRAINT attribute_types_pkey PRIMARY KEY (id);


--
-- Name: attribute_values attribute_values_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_pkey PRIMARY KEY (id);


--
-- Name: attributes attributes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attributes
    ADD CONSTRAINT attributes_pkey PRIMARY KEY (id);


--
-- Name: films films_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.films
    ADD CONSTRAINT films_pkey PRIMARY KEY (id);


--
-- Name: halls halls_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.halls
    ADD CONSTRAINT halls_name_key UNIQUE (name);


--
-- Name: halls halls_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.halls
    ADD CONSTRAINT halls_pkey PRIMARY KEY (id);


--
-- Name: prices prices_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_pkey PRIMARY KEY (id);


--
-- Name: prices prices_row_min_row_max_time_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_row_min_row_max_time_key UNIQUE (row_min, row_max, "time");


--
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- Name: sales sales_session_id_row_seat_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_session_id_row_seat_key UNIQUE (session_id, "row", seat);


--
-- Name: sessions sessions_hall_id_date_time_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_hall_id_date_time_key UNIQUE (hall_id, date, "time");


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: attribute_values attribute_values_attribute_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES public.attributes(id);


--
-- Name: attribute_values attribute_values_film_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_film_id_fkey FOREIGN KEY (film_id) REFERENCES public.films(id);


--
-- Name: attributes attributes_attribute_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attributes
    ADD CONSTRAINT attributes_attribute_type_id_fkey FOREIGN KEY (attribute_type_id) REFERENCES public.attribute_types(id);


--
-- Name: sales sales_session_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_session_id_fkey FOREIGN KEY (session_id) REFERENCES public.sessions(id);


--
-- Name: sessions sessions_film_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_film_id_fkey FOREIGN KEY (film_id) REFERENCES public.films(id);


--
-- Name: sessions sessions_hall_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_hall_id_fkey FOREIGN KEY (hall_id) REFERENCES public.halls(id);


--
-- PostgreSQL database dump complete
--

