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
-- Name: attribute_value_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.attribute_value_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_value_id OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: attribute_values; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attribute_values (
    id integer DEFAULT nextval('public.attribute_value_id'::regclass) NOT NULL,
    attribute_id integer NOT NULL,
    val_date date,
    val_text character varying,
    film_id integer NOT NULL,
    val_boolean boolean
);


ALTER TABLE public.attribute_values OWNER TO postgres;

--
-- Name: films_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.films_id
    START WITH 1
    INCREMENT BY 1
    MINVALUE 0
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.films_id OWNER TO postgres;

--
-- Name: films; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.films (
    id smallint DEFAULT nextval('public.films_id'::regclass) NOT NULL,
    name character(256) NOT NULL
);


ALTER TABLE public.films OWNER TO postgres;

--
-- Name: actual_tasks; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.actual_tasks AS
 SELECT attribute_values.id,
        CASE
            WHEN (attribute_values.val_date = (CURRENT_DATE)::timestamp without time zone) THEN attribute_values.val_text
            ELSE ''::character varying
        END AS today_tasks,
        CASE
            WHEN (attribute_values.val_date = ((CURRENT_DATE)::timestamp without time zone + '20 days'::interval)) THEN attribute_values.val_text
            ELSE ''::character varying
        END AS twenty_day_tasks
   FROM (public.attribute_values
     JOIN public.films ON ((attribute_values.film_id = films.id)));


ALTER TABLE public.actual_tasks OWNER TO postgres;

--
-- Name: attribute_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.attribute_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_id OWNER TO postgres;

--
-- Name: attribute_type_id; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.attribute_type_id
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attribute_type_id OWNER TO postgres;

--
-- Name: attribute_types; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attribute_types (
    id integer DEFAULT nextval('public.attribute_type_id'::regclass) NOT NULL,
    name character varying(256) NOT NULL
);


ALTER TABLE public.attribute_types OWNER TO postgres;

--
-- Name: attributes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.attributes (
    id integer DEFAULT nextval('public.attribute_id'::regclass) NOT NULL,
    name character varying(256) NOT NULL,
    attribute_type_id integer NOT NULL
);


ALTER TABLE public.attributes OWNER TO postgres;

--
-- Name: attributes_inf; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.attributes_inf AS
 SELECT films.name AS film_name,
    attribute_types.name AS attr_type,
    attributes.name AS attr_name,
    (attribute_values.val_text)::text AS attr_value
   FROM (((public.attribute_values
     JOIN public.attributes ON ((attribute_values.attribute_id = attributes.id)))
     JOIN public.attribute_types ON ((attributes.attribute_type_id = attribute_types.id)))
     JOIN public.films ON ((attribute_values.film_id = films.id)));


ALTER TABLE public.attributes_inf OWNER TO postgres;

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
-- Name: attribute_values attribute_values_attribute_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_attribute_id_fkey FOREIGN KEY (attribute_id) REFERENCES public.attributes(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: attribute_values attribute_values_film_d_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attribute_values
    ADD CONSTRAINT attribute_values_film_d_fkey FOREIGN KEY (film_id) REFERENCES public.films(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: attributes attributes_attribute_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.attributes
    ADD CONSTRAINT attributes_attribute_type_id_fkey FOREIGN KEY (attribute_type_id) REFERENCES public.attribute_types(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

