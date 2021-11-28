--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 14.1 (Ubuntu 14.1-1.pgdg20.04+1)

-- Started on 2021-11-28 13:43:30 MSK

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
-- TOC entry 204 (class 1259 OID 16628)
-- Name: films_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.films_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.films_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 205 (class 1259 OID 16630)
-- Name: films; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.films (
    id integer DEFAULT nextval('public.films_seq'::regclass) NOT NULL,
    name character varying(255) DEFAULT ''''::character varying NOT NULL
);


ALTER TABLE public.films OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 16613)
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
-- TOC entry 203 (class 1259 OID 16615)
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
-- TOC entry 208 (class 1259 OID 16647)
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
-- TOC entry 209 (class 1259 OID 16649)
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
-- TOC entry 210 (class 1259 OID 16658)
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
-- TOC entry 211 (class 1259 OID 16660)
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
-- TOC entry 206 (class 1259 OID 16637)
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
-- TOC entry 207 (class 1259 OID 16639)
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
-- TOC entry 2872 (class 2606 OID 16636)
-- Name: films films_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.films
    ADD CONSTRAINT films_pkey PRIMARY KEY (id);


--
-- TOC entry 2868 (class 2606 OID 16627)
-- Name: halls halls_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.halls
    ADD CONSTRAINT halls_name_key UNIQUE (name);


--
-- TOC entry 2870 (class 2606 OID 16625)
-- Name: halls halls_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.halls
    ADD CONSTRAINT halls_pkey PRIMARY KEY (id);


--
-- TOC entry 2878 (class 2606 OID 16655)
-- Name: prices prices_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_pkey PRIMARY KEY (id);


--
-- TOC entry 2880 (class 2606 OID 16657)
-- Name: prices prices_row_min_row_max_time_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_row_min_row_max_time_key UNIQUE (row_min, row_max, "time");


--
-- TOC entry 2882 (class 2606 OID 16666)
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- TOC entry 2884 (class 2606 OID 16668)
-- Name: sales sales_session_id_row_seat_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_session_id_row_seat_key UNIQUE (session_id, "row", seat);


--
-- TOC entry 2874 (class 2606 OID 16646)
-- Name: sessions sessions_hall_id_date_time_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_hall_id_date_time_key UNIQUE (hall_id, date, "time");


--
-- TOC entry 2876 (class 2606 OID 16644)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 2887 (class 2606 OID 16679)
-- Name: sales sales_session_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_session_id_fkey FOREIGN KEY (session_id) REFERENCES public.sessions(id);


--
-- TOC entry 2886 (class 2606 OID 16674)
-- Name: sessions sessions_film_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_film_id_fkey FOREIGN KEY (film_id) REFERENCES public.films(id);


--
-- TOC entry 2885 (class 2606 OID 16669)
-- Name: sessions sessions_hall_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_hall_id_fkey FOREIGN KEY (hall_id) REFERENCES public.halls(id);


-- Completed on 2021-11-28 13:43:31 MSK

--
-- PostgreSQL database dump complete
--

