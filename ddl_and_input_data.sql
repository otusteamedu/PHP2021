--
-- PostgreSQL database dump
--

-- Dumped from database version 10.19 (Ubuntu 10.19-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.19 (Ubuntu 10.19-0ubuntu0.18.04.1)

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
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: attribute_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.attribute_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_id_seq OWNER TO bender;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: attribute; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.attribute (
    attribute_id integer DEFAULT nextval('public.attribute_id_seq'::regclass) NOT NULL,
    name character varying(30) NOT NULL,
    attribute_type_id integer NOT NULL
);


ALTER TABLE public.attribute OWNER TO bender;

--
-- Name: attribute_type_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.attribute_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_type_id_seq OWNER TO bender;

--
-- Name: attribute_type; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.attribute_type (
    attribute_type_id integer DEFAULT nextval('public.attribute_type_id_seq'::regclass) NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.attribute_type OWNER TO bender;

--
-- Name: film_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.film_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.film_id_seq OWNER TO bender;

--
-- Name: film; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.film (
    film_id integer DEFAULT nextval('public.film_id_seq'::regclass) NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.film OWNER TO bender;

--
-- Name: film_attributes_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.film_attributes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.film_attributes_id_seq OWNER TO bender;

--
-- Name: film_attributes; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.film_attributes (
    film_attributes_id integer DEFAULT nextval('public.film_attributes_id_seq'::regclass) NOT NULL,
    attribute_id integer NOT NULL,
    film_id integer NOT NULL,
    value_text character varying(100),
    value_integer integer,
    value_numeric numeric(10,2),
    value_boolean boolean,
    value_date date
);


ALTER TABLE public.film_attributes OWNER TO bender;

--
-- Name: film_attributes_values; Type: VIEW; Schema: public; Owner: bender
--

CREATE VIEW public.film_attributes_values AS
SELECT
    NULL::character varying(50) AS name,
    NULL::character varying(50) AS attribute_type,
    NULL::character varying(30) AS attribute_name,
    NULL::character varying AS attribute_value;


ALTER TABLE public.film_attributes_values OWNER TO bender;

--
-- Name: film_tasks; Type: VIEW; Schema: public; Owner: bender
--

CREATE VIEW public.film_tasks AS
SELECT
    NULL::character varying(50) AS name,
    NULL::character varying[] AS today_tasks,
    NULL::character varying[] AS twenty_days_tasks;


ALTER TABLE public.film_tasks OWNER TO bender;

--
-- Data for Name: attribute; Type: TABLE DATA; Schema: public; Owner: bender
--

COPY public.attribute (attribute_id, name, attribute_type_id) FROM stdin;
1	Рецензии	3
2	Рейтинг	5
3	Премия Оскар	2
4	Премия Ника	2
5	Премия Золотой Глобус	2
6	Премьера в мире	4
7	Премьера в России	4
8	Старт продажи билетов	4
9	Старт проката	4
10	Описание фильма	3
11	Длительность (мин.)	1
12	Длительность проката (дней)	1
13	Окончание проката	4
\.


--
-- Data for Name: attribute_type; Type: TABLE DATA; Schema: public; Owner: bender
--

COPY public.attribute_type (attribute_type_id, name) FROM stdin;
1	integer
2	boolean
3	text
4	date
5	numeric
\.


--
-- Data for Name: film; Type: TABLE DATA; Schema: public; Owner: bender
--

COPY public.film (film_id, name) FROM stdin;
1	Spoiler-man: No Way
2	Matrix 4
\.


--
-- Data for Name: film_attributes; Type: TABLE DATA; Schema: public; Owner: bender
--

COPY public.film_attributes (film_attributes_id, attribute_id, film_id, value_text, value_integer, value_numeric, value_boolean, value_date) FROM stdin;
1	1	1	Годный фильм, распинаюсь про сюжет, пишу про игру актеров, все круто	\N	\N	\N	\N
2	1	2	Джон Уик уже не тот, сестры Вачовски сбрендили, полная фигня	\N	\N	\N	\N
3	2	1	f	\N	96.40	\N	\N
4	2	2	\N	\N	73.12	\N	\N
5	3	1	\N	\N	\N	\N	\N
7	6	2	\N	\N	\N	\N	2021-12-10
8	7	1	\N	\N	\N	\N	2022-01-04
9	7	2	\N	\N	\N	\N	2021-12-30
10	8	1	\N	\N	\N	\N	2021-12-10
11	8	2	\N	\N	\N	\N	2021-12-07
12	12	1	\N	21	\N	\N	\N
13	12	2	\N	14	\N	\N	\N
6	6	1	\N	\N	\N	\N	2021-12-15
14	9	1	\N	\N	\N	\N	2021-12-15
15	9	2	\N	\N	\N	\N	2021-12-15
16	13	1	\N	\N	\N	\N	2022-01-04
17	13	2	\N	\N	\N	\N	2022-01-04
18	3	2	t	\N	\N	\N	\N
\.


--
-- Name: attribute_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bender
--

SELECT pg_catalog.setval('public.attribute_id_seq', 13, true);


--
-- Name: attribute_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bender
--

SELECT pg_catalog.setval('public.attribute_type_id_seq', 5, true);


--
-- Name: film_attributes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bender
--

SELECT pg_catalog.setval('public.film_attributes_id_seq', 18, true);


--
-- Name: film_id_seq; Type: SEQUENCE SET; Schema: public; Owner: bender
--

SELECT pg_catalog.setval('public.film_id_seq', 2, true);


--
-- Name: attribute attribute_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.attribute
    ADD CONSTRAINT attribute_pkey PRIMARY KEY (attribute_id);


--
-- Name: attribute_type attribute_type_name_key; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.attribute_type
    ADD CONSTRAINT attribute_type_name_key UNIQUE (name);


--
-- Name: attribute_type attribute_type_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.attribute_type
    ADD CONSTRAINT attribute_type_pkey PRIMARY KEY (attribute_type_id);


--
-- Name: attribute attribute_unq; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.attribute
    ADD CONSTRAINT attribute_unq UNIQUE (name);


--
-- Name: film_attributes film_attributes_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.film_attributes
    ADD CONSTRAINT film_attributes_pkey PRIMARY KEY (film_attributes_id);


--
-- Name: film film_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.film
    ADD CONSTRAINT film_pkey PRIMARY KEY (film_id);


--
-- Name: film film_unq; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.film
    ADD CONSTRAINT film_unq UNIQUE (name);


--
-- Name: attribute_index; Type: INDEX; Schema: public; Owner: bender
--

CREATE INDEX attribute_index ON public.attribute USING btree (name COLLATE "C.UTF-8" varchar_ops);


--
-- Name: film_index; Type: INDEX; Schema: public; Owner: bender
--

CREATE INDEX film_index ON public.film USING btree (name COLLATE "C.UTF-8");


--
-- Name: attribute attribute_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.attribute
    ADD CONSTRAINT attribute_type_fkey FOREIGN KEY (attribute_type_id) REFERENCES public.attribute_type(attribute_type_id) NOT VALID;


--
-- Name: film_attributes film_attribute_attribute_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.film_attributes
    ADD CONSTRAINT film_attribute_attribute_fkey FOREIGN KEY (attribute_id) REFERENCES public.attribute(attribute_id);


--
-- Name: film_attributes film_attribute_film_fkey; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.film_attributes
    ADD CONSTRAINT film_attribute_film_fkey FOREIGN KEY (film_id) REFERENCES public.film(film_id);


--
-- PostgreSQL database dump complete
--

