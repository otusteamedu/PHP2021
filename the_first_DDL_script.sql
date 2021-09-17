--
-- PostgreSQL database dump
--

-- Dumped from database version 13.4 (Debian 13.4-1.pgdg100+1)
-- Dumped by pg_dump version 13.4 (Debian 13.4-1.pgdg100+1)

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: clients; Type: TABLE; Schema: public; Owner: alex
--

CREATE TABLE public.clients (
    id integer NOT NULL,
    first_name character varying(255) DEFAULT NULL::character varying,
    last_name character varying(255) DEFAULT NULL::character varying,
    email character varying(100) DEFAULT NULL::character varying,
    phone character varying(15),
    created_at timestamp with time zone,
    deleted_at timestamp with time zone
);


ALTER TABLE public.clients OWNER TO alex;

--
-- Name: movies; Type: TABLE; Schema: public; Owner: alex
--

CREATE TABLE public.movies (
    id integer NOT NULL,
    title character varying(120),
    description text,
    duration time without time zone
);


ALTER TABLE public.movies OWNER TO alex;

--
-- Name: movies_id_seq; Type: SEQUENCE; Schema: public; Owner: alex
--

CREATE SEQUENCE public.movies_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movies_id_seq OWNER TO alex;

--
-- Name: movies_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alex
--

ALTER SEQUENCE public.movies_id_seq OWNED BY public.movies.id;


--
-- Name: room; Type: TABLE; Schema: public; Owner: alex
--

CREATE TABLE public.room (
    id integer NOT NULL,
    name character varying(120)
);


ALTER TABLE public.room OWNER TO alex;

--
-- Name: room_id_seq; Type: SEQUENCE; Schema: public; Owner: alex
--

CREATE SEQUENCE public.room_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.room_id_seq OWNER TO alex;

--
-- Name: room_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alex
--

ALTER SEQUENCE public.room_id_seq OWNED BY public.room.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: alex
--

CREATE TABLE public.sessions (
    id integer NOT NULL,
    movie_id integer,
    room_id integer,
    start_date timestamp with time zone,
    finish_date timestamp with time zone,
    price integer
);


ALTER TABLE public.sessions OWNER TO alex;

--
-- Name: tickets; Type: TABLE; Schema: public; Owner: alex
--

CREATE TABLE public.tickets (
    id integer NOT NULL,
    client_id integer,
    session_id integer,
    created_at timestamp with time zone DEFAULT now()
);


ALTER TABLE public.tickets OWNER TO alex;

--
-- Name: movies id; Type: DEFAULT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.movies ALTER COLUMN id SET DEFAULT nextval('public.movies_id_seq'::regclass);


--
-- Name: room id; Type: DEFAULT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.room ALTER COLUMN id SET DEFAULT nextval('public.room_id_seq'::regclass);


--
-- Name: clients clients_pkey; Type: CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT clients_pkey PRIMARY KEY (id);


--
-- Name: movies movies_pkey; Type: CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.movies
    ADD CONSTRAINT movies_pkey PRIMARY KEY (id);


--
-- Name: room room_pkey; Type: CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.room
    ADD CONSTRAINT room_pkey PRIMARY KEY (id);


--
-- Name: sessions session_pkey; Type: CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT session_pkey PRIMARY KEY (id);


--
-- Name: tickets tickets_pkey; Type: CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id);


--
-- Name: sessions session_movie_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT session_movie_id_fkey FOREIGN KEY (movie_id) REFERENCES public.movies(id);


--
-- Name: sessions session_room_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT session_room_id_fkey FOREIGN KEY (room_id) REFERENCES public.room(id);


--
-- Name: tickets tickets_client_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_client_id_fkey FOREIGN KEY (client_id) REFERENCES public.clients(id);


--
-- Name: tickets tickets_session_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: alex
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_session_id_fkey FOREIGN KEY (session_id) REFERENCES public.sessions(id);


--
-- PostgreSQL database dump complete
--

