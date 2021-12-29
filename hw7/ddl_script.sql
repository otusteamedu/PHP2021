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
-- Name: order_status; Type: TYPE; Schema: public; Owner: bender
--

CREATE TYPE public.order_status AS ENUM (
    'PAID',
    'CANCELED',
    'RESERVED'
);


ALTER TYPE public.order_status OWNER TO bender;

--
-- Name: cinema_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.cinema_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cinema_id_seq OWNER TO bender;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cinema; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.cinema (
    cinema_id integer DEFAULT nextval('public.cinema_id_seq'::regclass) NOT NULL,
    name character varying(30) NOT NULL,
    address character varying(50)
);


ALTER TABLE public.cinema OWNER TO bender;

--
-- Name: cinema_hall_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.cinema_hall_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cinema_hall_id_seq OWNER TO bender;

--
-- Name: cinema_hall; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.cinema_hall (
    cinema_hall_id integer DEFAULT nextval('public.cinema_hall_id_seq'::regclass) NOT NULL,
    number integer,
    cinema_id integer
);


ALTER TABLE public.cinema_hall OWNER TO bender;

--
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.client_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO bender;

--
-- Name: client; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.client (
    client_id integer DEFAULT nextval('public.client_id_seq'::regclass) NOT NULL,
    email character varying(30)
);


ALTER TABLE public.client OWNER TO bender;

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
    name character varying(30) NOT NULL,
    duration integer,
    age_limit integer
);


ALTER TABLE public.film OWNER TO bender;

--
-- Name: order_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.order_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_id_seq OWNER TO bender;

--
-- Name: order; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public."order" (
    order_id integer DEFAULT nextval('public.order_id_seq'::regclass) NOT NULL,
    client_id integer NOT NULL,
    status public.order_status
);


ALTER TABLE public."order" OWNER TO bender;

--
-- Name: order_ticket_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.order_ticket_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_ticket_seq OWNER TO bender;

--
-- Name: order_to_ticket; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.order_to_ticket (
    id integer DEFAULT nextval('public.order_ticket_seq'::regclass) NOT NULL,
    order_id integer NOT NULL,
    ticket_id integer NOT NULL
);


ALTER TABLE public.order_to_ticket OWNER TO bender;

--
-- Name: seat_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.seat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seat_id_seq OWNER TO bender;

--
-- Name: seat; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.seat (
    seat_id integer DEFAULT nextval('public.seat_id_seq'::regclass) NOT NULL,
    "row" integer NOT NULL,
    "column" integer NOT NULL,
    cinema_hall_id integer NOT NULL
);


ALTER TABLE public.seat OWNER TO bender;

--
-- Name: session_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.session_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.session_id_seq OWNER TO bender;

--
-- Name: session; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.session (
    session_id integer DEFAULT nextval('public.session_id_seq'::regclass) NOT NULL,
    cinema_hall_id integer NOT NULL,
    film_id integer NOT NULL,
    session_datetime timestamp with time zone NOT NULL
);


ALTER TABLE public.session OWNER TO bender;

--
-- Name: ticket_id_seq; Type: SEQUENCE; Schema: public; Owner: bender
--

CREATE SEQUENCE public.ticket_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ticket_id_seq OWNER TO bender;

--
-- Name: ticket; Type: TABLE; Schema: public; Owner: bender
--

CREATE TABLE public.ticket (
    ticket_id integer DEFAULT nextval('public.ticket_id_seq'::regclass) NOT NULL,
    session_id integer NOT NULL,
    seat_id integer NOT NULL,
    price numeric(10,2) NOT NULL,
    purchase_timestamp timestamp with time zone
);


ALTER TABLE public.ticket OWNER TO bender;

--
-- Name: cinema_hall cinema_hall_pk; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.cinema_hall
    ADD CONSTRAINT cinema_hall_pk PRIMARY KEY (cinema_hall_id);


--
-- Name: cinema cinema_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.cinema
    ADD CONSTRAINT cinema_pkey PRIMARY KEY (cinema_id);


--
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (client_id);


--
-- Name: film film_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.film
    ADD CONSTRAINT film_pkey PRIMARY KEY (film_id);


--
-- Name: order order_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public."order"
    ADD CONSTRAINT order_pkey PRIMARY KEY (order_id);


--
-- Name: order_to_ticket order_to_ticket_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.order_to_ticket
    ADD CONSTRAINT order_to_ticket_pkey PRIMARY KEY (id);


--
-- Name: seat seat_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.seat
    ADD CONSTRAINT seat_pkey PRIMARY KEY (seat_id);


--
-- Name: session session_id_pk; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_id_pk PRIMARY KEY (session_id);


--
-- Name: ticket ticket_pkey; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_pkey PRIMARY KEY (ticket_id);


--
-- Name: ticket ticket_seat_uni; Type: CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_seat_uni UNIQUE (seat_id);


--
-- Name: cinema_hall cinema_hall_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.cinema_hall
    ADD CONSTRAINT cinema_hall_fk FOREIGN KEY (cinema_id) REFERENCES public.cinema(cinema_id) NOT VALID;


--
-- Name: order order_client_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public."order"
    ADD CONSTRAINT order_client_fk FOREIGN KEY (client_id) REFERENCES public.client(client_id) NOT VALID;


--
-- Name: order_to_ticket order_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.order_to_ticket
    ADD CONSTRAINT order_fk FOREIGN KEY (order_id) REFERENCES public."order"(order_id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- Name: seat seat_hall_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.seat
    ADD CONSTRAINT seat_hall_fk FOREIGN KEY (cinema_hall_id) REFERENCES public.cinema_hall(cinema_hall_id);


--
-- Name: session session_film_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_film_fk FOREIGN KEY (film_id) REFERENCES public.film(film_id) NOT VALID;


--
-- Name: session session_hall_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.session
    ADD CONSTRAINT session_hall_fk FOREIGN KEY (cinema_hall_id) REFERENCES public.cinema_hall(cinema_hall_id);


--
-- Name: order_to_ticket ticket_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.order_to_ticket
    ADD CONSTRAINT ticket_fk FOREIGN KEY (ticket_id) REFERENCES public.ticket(ticket_id) NOT VALID;


--
-- Name: ticket ticket_seat_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_seat_fk FOREIGN KEY (seat_id) REFERENCES public.seat(seat_id) NOT VALID;


--
-- Name: ticket ticket_session_fk; Type: FK CONSTRAINT; Schema: public; Owner: bender
--

ALTER TABLE ONLY public.ticket
    ADD CONSTRAINT ticket_session_fk FOREIGN KEY (session_id) REFERENCES public.session(session_id) NOT VALID;


--
-- PostgreSQL database dump complete
--

