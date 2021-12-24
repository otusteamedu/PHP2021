--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 14.1 (Ubuntu 14.1-1.pgdg20.04+1)

-- Started on 2021-12-24 18:35:39 MSK

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
-- TOC entry 216 (class 1259 OID 32865)
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
-- TOC entry 217 (class 1259 OID 32867)
-- Name: attribute_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attribute_types (
    id integer DEFAULT nextval('public.attribute_types_seq'::regclass) NOT NULL,
    attribute_type_name character varying NOT NULL
);


ALTER TABLE public.attribute_types OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 32843)
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
-- TOC entry 213 (class 1259 OID 32845)
-- Name: attribute_values; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attribute_values (
    id integer DEFAULT nextval('public.attribute_values_seq'::regclass) NOT NULL,
    film_id integer NOT NULL,
    attribute_id integer NOT NULL,
    date date,
    "boolean" smallint,
    text text,
    "float" numeric(10,2),
    "integer" bigint
);


ALTER TABLE public.attribute_values OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 32854)
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
-- TOC entry 215 (class 1259 OID 32856)
-- Name: attributes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attributes (
    id integer DEFAULT nextval('public.attributes_seq'::regclass) NOT NULL,
    attribute_type_id integer NOT NULL,
    attribute_name character varying NOT NULL
);


ALTER TABLE public.attributes OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 32768)
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
-- TOC entry 203 (class 1259 OID 32770)
-- Name: films; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.films (
    id integer DEFAULT nextval('public.films_seq'::regclass) NOT NULL,
    name character varying(255) DEFAULT ''''::character varying NOT NULL
);


ALTER TABLE public.films OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 32933)
-- Name: films_attributes; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.films_attributes AS
 SELECT f.name AS film_name,
    at.attribute_type_name AS attribute_type,
    a.attribute_name,
        CASE
            WHEN ((at.attribute_type_name)::text = 'boolean'::text) THEN (av.id)::text
            WHEN ((at.attribute_type_name)::text = 'date'::text) THEN (av.date)::text
            WHEN ((at.attribute_type_name)::text = 'integer'::text) THEN (av."integer")::text
            ELSE av.text
        END AS attribute_value
   FROM (((public.films f
     LEFT JOIN public.attribute_values av ON ((av.film_id = f.id)))
     LEFT JOIN public.attributes a ON ((a.id = av.attribute_id)))
     LEFT JOIN public.attribute_types at ON ((at.id = a.attribute_type_id)));


ALTER TABLE public.films_attributes OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 32938)
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
          WHERE ((av2.date >= CURRENT_DATE) AND (av2.film_id = f.id))), ', '::text) AS tasks_20day
   FROM public.films f;


ALTER TABLE public.films_tasks OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 32775)
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
-- TOC entry 205 (class 1259 OID 32777)
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
-- TOC entry 206 (class 1259 OID 32786)
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
-- TOC entry 207 (class 1259 OID 32788)
-- Name: prices; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prices (
    id integer DEFAULT nextval('public.prices_seq'::regclass) NOT NULL,
    row_min smallint NOT NULL,
    row_max smallint NOT NULL,
    "time" time(0) without time zone NOT NULL,
    price numeric(10,2) DEFAULT NULL::numeric NOT NULL,
    hall_id integer
);


ALTER TABLE public.prices OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 32793)
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
-- TOC entry 209 (class 1259 OID 32795)
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
-- TOC entry 210 (class 1259 OID 32800)
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
-- TOC entry 211 (class 1259 OID 32802)
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
-- TOC entry 2923 (class 2606 OID 32875)
-- Name: attribute_types attribute_types_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_types
    ADD CONSTRAINT attribute_types_pkey PRIMARY KEY (id);


--
-- TOC entry 2919 (class 2606 OID 32853)
-- Name: attribute_values attribute_values_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_pkey PRIMARY KEY (id);


--
-- TOC entry 2921 (class 2606 OID 32864)
-- Name: attributes attributes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attributes
    ADD CONSTRAINT attributes_pkey PRIMARY KEY (id);


--
-- TOC entry 2900 (class 2606 OID 32807)
-- Name: films films_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.films
    ADD CONSTRAINT films_pkey PRIMARY KEY (id);


--
-- TOC entry 2902 (class 2606 OID 32809)
-- Name: halls halls_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.halls
    ADD CONSTRAINT halls_name_key UNIQUE (name);


--
-- TOC entry 2904 (class 2606 OID 32811)
-- Name: halls halls_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.halls
    ADD CONSTRAINT halls_pkey PRIMARY KEY (id);


--
-- TOC entry 2907 (class 2606 OID 32813)
-- Name: prices prices_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_pkey PRIMARY KEY (id);


--
-- TOC entry 2909 (class 2606 OID 32815)
-- Name: prices prices_row_min_row_max_time_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_row_min_row_max_time_key UNIQUE (row_min, row_max, "time");


--
-- TOC entry 2911 (class 2606 OID 32817)
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- TOC entry 2913 (class 2606 OID 32819)
-- Name: sales sales_session_id_row_seat_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_session_id_row_seat_key UNIQUE (session_id, "row", seat);


--
-- TOC entry 2915 (class 2606 OID 32821)
-- Name: sessions sessions_hall_id_date_time_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_hall_id_date_time_key UNIQUE (hall_id, date, "time");


--
-- TOC entry 2917 (class 2606 OID 32823)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 2905 (class 1259 OID 33085)
-- Name: fki_prices_hall_id_fkey; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_prices_hall_id_fkey ON public.prices USING btree (hall_id);


--
-- TOC entry 2929 (class 2606 OID 32886)
-- Name: attribute_values attribute_values_attribute_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES public.attributes(id);


--
-- TOC entry 2928 (class 2606 OID 32881)
-- Name: attribute_values attribute_values_film_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_film_id_fkey FOREIGN KEY (film_id) REFERENCES public.films(id);


--
-- TOC entry 2930 (class 2606 OID 32891)
-- Name: attributes attributes_attribute_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attributes
    ADD CONSTRAINT attributes_attribute_type_id_fkey FOREIGN KEY (attribute_type_id) REFERENCES public.attribute_types(id);


--
-- TOC entry 2924 (class 2606 OID 33080)
-- Name: prices prices_hall_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prices
    ADD CONSTRAINT prices_hall_id_fkey FOREIGN KEY (hall_id) REFERENCES public.halls(id) NOT VALID;


--
-- TOC entry 2925 (class 2606 OID 32824)
-- Name: sales sales_session_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_session_id_fkey FOREIGN KEY (session_id) REFERENCES public.sessions(id);


--
-- TOC entry 2926 (class 2606 OID 32829)
-- Name: sessions sessions_film_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_film_id_fkey FOREIGN KEY (film_id) REFERENCES public.films(id);


--
-- TOC entry 2927 (class 2606 OID 32834)
-- Name: sessions sessions_hall_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_hall_id_fkey FOREIGN KEY (hall_id) REFERENCES public.halls(id);


-- Completed on 2021-12-24 18:35:39 MSK

--
-- PostgreSQL database dump complete
--

