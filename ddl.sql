-- This script was generated by a beta version of the ERD tool in pgAdmin 4.
-- Please log an issue at https://redmine.postgresql.org/projects/pgadmin4/issues/new if you find any bugs, including reproduction steps.
BEGIN;


CREATE TABLE IF NOT EXISTS public.film
(
    id serial NOT NULL,
    name character varying(60) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public."filmAttributeType"
(
    id smallserial NOT NULL,
    name character varying(60) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public."filmAttribute"
(
    id smallserial NOT NULL,
    name character varying(60) NOT NULL,
    film_attribute_type_id smallint NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public."filmAttributeValue"
(
    id serial NOT NULL,
    film_attribute_id smallint NOT NULL,
    film_id integer NOT NULL,
    value_text text,
    value_numeric numeric(8, 4),
    value_boolean boolean,
    value_timestamp timestamp without time zone,
    PRIMARY KEY (id)
);

ALTER TABLE public."filmAttribute"
    ADD FOREIGN KEY (film_attribute_type_id)
    REFERENCES public."filmAttributeType" (id)
    NOT VALID;


ALTER TABLE public."filmAttributeValue"
    ADD FOREIGN KEY (film_id)
    REFERENCES public.film (id)
    NOT VALID;


ALTER TABLE public."filmAttributeValue"
    ADD FOREIGN KEY (film_attribute_id)
    REFERENCES public."filmAttribute" (id)
    NOT VALID;

CREATE UNIQUE INDEX film_n_u ON public."film" (name);
CREATE INDEX fa_fati_i ON public."filmAttribute" (film_attribute_type_id);
CREATE UNIQUE INDEX fa_n_u ON public."filmAttributeType" (name);
CREATE INDEX fav_fai_i ON public."filmAttributeValue" (film_attribute_id);
CREATE INDEX fav_fi_i ON public."filmAttributeValue" (film_id);

END;
