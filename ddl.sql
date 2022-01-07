CREATE TABLE public.films (
  id int4 NOT NULL,
  "name" varchar NOT NULL,
  description text NOT NULL,
  duration int4 NOT NULL,
  CONSTRAINT films_pk PRIMARY KEY (id)
);
CREATE UNIQUE INDEX films_id_idx ON public.films USING btree (id);

CREATE TABLE public.attribute_type (
   id int4 NOT NULL,
   "name" varchar NOT NULL,
   CONSTRAINT atributes_type_pk PRIMARY KEY (id)
);

CREATE TABLE public."attribute" (
    id int4 NOT NULL,
    "name" varchar NOT NULL,
    attribute_type int4 NOT NULL,
    CONSTRAINT atributes_pk PRIMARY KEY (id),
    CONSTRAINT atribute_fk FOREIGN KEY (attribute_type) REFERENCES public.attribute_type(id)
);

CREATE TABLE public.attribute_value (
    id int4 NOT NULL,
    "int" int4 NULL,
    "float" float4 NULL,
    "text" text NULL,
    datetime timestamp NULL,
    "bool" bool NULL,
    film int4 NOT NULL,
    atribute int4 NOT NULL,
    CONSTRAINT atribute_value_pk PRIMARY KEY (id),
    CONSTRAINT atribute_value_fk FOREIGN KEY (film) REFERENCES public.films(id),
    CONSTRAINT atribute_value_fk_1 FOREIGN KEY (atribute) REFERENCES public."attribute"(id)
);

CREATE TABLE halls (
                       id INTEGER,
                       name TEXT,
                       description TEXT,
                       seats INTEGER,
                       "rows" INTEGER,
                       places INTEGER,
                       CONSTRAINT id PRIMARY KEY (id)
);

CREATE TABLE "session" (
                           id INTEGER,
                           date NUMERIC,
                           time NUMERIC,
                           hall INTEGER,
                           film INTEGER, cost INTEGER,
                           CONSTRAINT s_id PRIMARY KEY (id),
                           CONSTRAINT "session" FOREIGN KEY (hall) REFERENCES halls(id),
                           CONSTRAINT film FOREIGN KEY (film) REFERENCES films(id)
);

CREATE TABLE tickets (
                         id INTEGER,
                         "session" INTEGER,
                         dateTime NUMERIC,
                         cost INTEGER,
                         "row" INTEGER,
                         place INTEGER,
                         CONSTRAINT t_id PRIMARY KEY (id),
                         CONSTRAINT FK_tickets_session FOREIGN KEY ("session") REFERENCES "session"(id)
);