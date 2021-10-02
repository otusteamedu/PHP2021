CREATE TABLE public.movies (
	id serial4 NOT NULL,
	name varchar NOT NULL,
	CONSTRAINT movies_pkey PRIMARY KEY (id)
);

CREATE TABLE public.types_attributes (
	id serial4 NOT NULL,
	type varchar NOT NULL,
	CONSTRAINT types_attributes_pkey PRIMARY KEY (id)
);

CREATE TABLE public.attributes (
	id serial4 NOT NULL,
	id_types_attributes int4 NOT NULL,
	name varchar NOT NULL,
	CONSTRAINT attributes_pkey PRIMARY KEY (id),
	CONSTRAINT attributes_fk FOREIGN KEY (id_types_attributes) REFERENCES public.types_attributes(id)
);

CREATE TABLE public.values (
	id serial4 NOT NULL,
	id_movie int4 NOT NULL,
	id_attribute int4 NOT NULL,
	value_text text NULL,
	value_int int4 NULL,
	value_boolean bool NULL,
	value_float float4 NULL,
	value_date timestamp NULL,
	CONSTRAINT values_pkey PRIMARY KEY (id),
	CONSTRAINT values_fk FOREIGN KEY (id_attribute) REFERENCES public.attributes(id),
	CONSTRAINT values_fk_1 FOREIGN KEY (id_movie) REFERENCES public.movies(id)
);

CREATE INDEX values_id_movie_idx ON public.values USING btree (id_movie);

CREATE INDEX values_value_date_idx ON public.values USING btree (value_date);