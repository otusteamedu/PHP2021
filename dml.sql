--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

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
-- Data for Name: attribute_types; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.attribute_types (id, name) FROM stdin;
1	текстовое значение
3	логическое значение
2	дата
\.


--
-- Data for Name: attributes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.attributes (id, name, attribute_type_id) FROM stdin;
1	рецензия	1
3	премия	3
2	важная дата	2
4	служебная дата	2
\.


--
-- Data for Name: films; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.films (id, name) FROM stdin;
1	ff                                                                                                                                                                                                                                                              
\.


--
-- Data for Name: attribute_values; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.attribute_values (id, attribute_id, val_date, val_text, film_id, val_boolean) FROM stdin;
1	1	\N	Леонардо Ди Каприо	1	\N
2	4	2021-11-30	Актуальная через неделю дата	1	\N
3	2	2021-11-23	Актуальная через 4 дня дата	1	\N
\.


--
-- Name: attribute_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.attribute_id', 4, true);


--
-- Name: attribute_type_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.attribute_type_id', 3, true);


--
-- Name: attribute_value_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.attribute_value_id', 3, true);


--
-- Name: films_id; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.films_id', 0, true);


--
-- PostgreSQL database dump complete
--

