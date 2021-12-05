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


