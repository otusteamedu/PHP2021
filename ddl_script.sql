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

CREATE SEQUENCE public.attribute_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_id_seq OWNER TO postgres;

SET default_tablespace = '';
SET default_table_access_method = heap;

CREATE TABLE public.attribute (
    attribute_id integer DEFAULT nextval('public.attribute_id_seq'::regclass) NOT NULL,
    name character varying(30) NOT NULL,
    attribute_type_id integer NOT NULL
);

ALTER TABLE public.attribute OWNER TO postgres;

CREATE SEQUENCE public.attribute_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_type_id_seq OWNER TO postgres;

CREATE TABLE public.attribute_type (
    attribute_type_id integer DEFAULT nextval('public.attribute_type_id_seq'::regclass) NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE public.attribute_type OWNER TO postgres;

CREATE SEQUENCE public.film_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.film_id_seq OWNER TO postgres;

CREATE TABLE public.film (
    film_id integer DEFAULT nextval('public.film_id_seq'::regclass) NOT NULL,
    name character varying(50) NOT NULL
);

ALTER TABLE public.film OWNER TO postgres;

CREATE SEQUENCE public.film_attributes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.film_attributes_id_seq OWNER TO postgres;

CREATE TABLE public.film_attributes (
    film_attributes_id integer DEFAULT nextval('public.film_attributes_id_seq'::regclass) NOT NULL,
    attribute_id integer NOT NULL,
    film_id integer NOT NULL,
    value_text character varying,
    value_integer integer,
    value_float double precision,
    value_boolean boolean,
    value_timestamp timestamp with time zone
);

ALTER TABLE public.film_attributes OWNER TO postgres;

CREATE VIEW public.film_attributes_values AS
SELECT
    NULL::character varying(50) AS name,
    NULL::character varying(50) AS attribute_type,
    NULL::character varying(30) AS attribute_name,
    NULL::text AS attribute_value;


ALTER TABLE public.film_attributes_values OWNER TO postgres;

CREATE VIEW public.film_tasks AS
SELECT
    NULL::character varying(50) AS name,
    NULL::character varying[] AS today_tasks,
    NULL::character varying[] AS twenty_days_tasks;


ALTER TABLE public.film_tasks OWNER TO postgres;

COPY public.attribute (attribute_id, name, attribute_type_id) FROM stdin;
1   ��������    3
3   ������ �����    2
4   ������ ���� 2
5	������ ������� ������	2
10	�������� ������	3
11	������������ (���.)	1
12	������������ ������� (����)	1
2	�������	7
6	�������� � ����	6
7	�������� � ������	6
8	����� ������� �������	6
9	����� �������	6
13	��������� �������	6
\.

COPY public.attribute_type (attribute_type_id, name) FROM stdin;
1	integer
2	boolean
3	text
4	date
5	numeric
6	timestamp
7	float
\.

COPY public.film (film_id, name) FROM stdin;
1	������� ������� �������
2	72 �����
\.

COPY public.film_attributes (film_attributes_id, attribute_id, film_id, value_text, value_integer, value_float, value_boolean, value_timestamp) FROM stdin;
12	12	1	\N	21	\N	\N	\N
13	12	2	\N	14	\N	\N	\N
18	3	2	t	\N	\N	\N	\N
6	6	1	\N	\N	\N	\N	2022-06-30 00:00:00+03
7	6	2	\N	\N	\N	\N	2022-06-30 00:00:00+03
8	7	1	\N	\N	\N	\N	2022-06-30 00:00:00+03
9	7	2	\N	\N	\N	\N	2022-06-30 00:00:00+03
10	8	1	\N	\N	\N	\N	2022-06-30 00:00:00+03
11	8	2	\N	\N	\N	\N	2022-06-30 00:00:00+03
14	9	1	\N	\N	\N	\N	2022-06-30 00:00:00+03
15	9	2	\N	\N	\N	\N	2022-06-30 00:00:00+03
16	13	1	\N	\N	\N	\N	2022-07-21 00:00:00+03
17	13	2	\N	\N	\N	\N	2022-07-21 00:00:00+03
1	1	1	������ ���������� ������ ������ ���������� ������	\N	\N	\N	\N
2	1	2	������� ������� ����� � ���������� ��������������� �����	\N	\N	\N	\N
5	3	1	f	\N	\N	\N	\N
\.

SELECT pg_catalog.setval('public.attribute_id_seq', 13, true);
SELECT pg_catalog.setval('public.attribute_type_id_seq', 6, true);
SELECT pg_catalog.setval('public.film_attributes_id_seq', 18, true);
SELECT pg_catalog.setval('public.film_id_seq', 2, true);

ALTER TABLE ONLY public.attribute
    ADD CONSTRAINT attribute_pkey PRIMARY KEY (attribute_id);

ALTER TABLE ONLY public.attribute_type
    ADD CONSTRAINT attribute_type_name_key UNIQUE (name);

ALTER TABLE ONLY public.attribute_type
    ADD CONSTRAINT attribute_type_pkey PRIMARY KEY (attribute_type_id);

ALTER TABLE ONLY public.attribute
    ADD CONSTRAINT attribute_unq UNIQUE (name);

ALTER TABLE ONLY public.film_attributes
    ADD CONSTRAINT film_attributes_pkey PRIMARY KEY (film_attributes_id);

ALTER TABLE ONLY public.film
    ADD CONSTRAINT film_pkey PRIMARY KEY (film_id);

ALTER TABLE ONLY public.film
    ADD CONSTRAINT film_unq UNIQUE (name);

ALTER TABLE ONLY public.attribute
    ADD CONSTRAINT attribute_type_fkey FOREIGN KEY (attribute_type_id) REFERENCES public.attribute_type(attribute_type_id) NOT VALID;

ALTER TABLE ONLY public.film_attributes
    ADD CONSTRAINT film_attribute_attribute_fkey FOREIGN KEY (attribute_id) REFERENCES public.attribute(attribute_id);

ALTER TABLE ONLY public.film_attributes
    ADD CONSTRAINT film_attribute_film_fkey FOREIGN KEY (film_id) REFERENCES public.film(film_id);