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
    value_text text,
    value_integer integer,
    value_float double precision,
    value_boolean boolean,
    value_timestamp timestamp with time zone
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
    NULL::text AS attribute_value;


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
-- Name: film_tasks _RETURN; Type: RULE; Schema: public; Owner: bender
--

CREATE OR REPLACE VIEW public.film_tasks AS
 SELECT f.name,
    array_agg(
        CASE
            WHEN (((CURRENT_TIMESTAMP - f_attr.value_timestamp) < '24:00:00'::interval) AND ((CURRENT_TIMESTAMP - f_attr.value_timestamp) > '00:00:00'::interval)) THEN attr.name
            ELSE NULL::character varying
        END) AS today_tasks,
    array_agg(
        CASE
            WHEN (((f_attr.value_timestamp - CURRENT_TIMESTAMP) > '19 days 23:59:59'::interval) AND ((f_attr.value_timestamp - CURRENT_TIMESTAMP) < '21 days'::interval)) THEN attr.name
            ELSE NULL::character varying
        END) AS twenty_days_tasks
   FROM (((public.attribute_type attr_t
     JOIN public.attribute attr ON ((attr_t.attribute_type_id = attr.attribute_type_id)))
     JOIN public.film_attributes f_attr ON ((attr.attribute_id = f_attr.attribute_id)))
     JOIN public.film f ON ((f_attr.film_id = f.film_id)))
  WHERE ((attr_t.attribute_type_id = 4) AND ((((CURRENT_TIMESTAMP - f_attr.value_timestamp) < '24:00:00'::interval) AND ((CURRENT_TIMESTAMP - f_attr.value_timestamp) > '00:00:00'::interval)) OR (((f_attr.value_timestamp - CURRENT_TIMESTAMP) > '19 days 23:59:59'::interval) AND ((f_attr.value_timestamp - CURRENT_TIMESTAMP) < '21 days'::interval))))
  GROUP BY f.film_id;


--
-- Name: film_attributes_values _RETURN; Type: RULE; Schema: public; Owner: bender
--

CREATE OR REPLACE VIEW public.film_attributes_values AS
 SELECT f.name,
    attr_t.name AS attribute_type,
    attr.name AS attribute_name,
        CASE
            WHEN ((attr_t.name)::text = 'integer'::text) THEN (f_attr.value_integer)::text
            WHEN ((attr_t.name)::text = 'double precision'::text) THEN (f_attr.value_float)::text
            WHEN ((attr_t.name)::text = 'boolean'::text) THEN
            CASE
                WHEN (f_attr.value_boolean = true) THEN 'Y'::text
                ELSE 'N'::text
            END
            WHEN ((attr_t.name)::text = 'timestamp'::text) THEN (f_attr.value_timestamp)::text
            WHEN ((attr_t.name)::text = 'text'::text) THEN f_attr.value_text
            ELSE NULL::text
        END AS attribute_value
   FROM (((public.attribute_type attr_t
     JOIN public.attribute attr ON ((attr_t.attribute_type_id = attr.attribute_type_id)))
     JOIN public.film_attributes f_attr ON ((attr.attribute_id = f_attr.attribute_id)))
     JOIN public.film f ON ((f_attr.film_id = f.film_id)))
  GROUP BY f.film_id, attr_t.attribute_type_id, attr.attribute_id, f_attr.film_attributes_id;


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

