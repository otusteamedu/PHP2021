-- Таблица фильмов
CREATE TABLE public.movies
(
    id     int4        NOT NULL,
    "name" varchar(50) NOT NULL,
    CONSTRAINT movies_pk PRIMARY KEY (id)
);

-- Таблица атрибутов
CREATE TABLE public.movie_attrs
(
    id      int4        NOT NULL,
    "name"  varchar(50) NOT NULL,
    type_id int4        NOT NULL,
    CONSTRAINT movies_attr_pk PRIMARY KEY (id),
    CONSTRAINT movie_attrs_fk FOREIGN KEY (type_id) REFERENCES movie_attr_types (id) ON UPDATE CASCADE ON DELETE RESTRICT
);

-- Таблица типов атрибутов
CREATE TABLE public.movie_attr_types
(
    id       int4        NOT NULL,
    "name"   varchar(25) NOT NULL,
    property varchar(25) NULL,
    CONSTRAINT movie_attr_types_pk PRIMARY KEY (id)
);

-- Таблица значений атрибутов
CREATE TABLE public.movie_attr_values
(
    movie_id int4           NOT NULL,
    attr_id  int4           NOT NULL,
    value_1  int4           NULL,
    value_2  numeric(12, 2) NULL,
    value_3  bool           NULL,
    value_4  text           NULL,
    value_5  date           NULL,
    value_6  date           NULL,
    CONSTRAINT movie_attr_values_pk PRIMARY KEY (movie_id, attr_id),
    CONSTRAINT movie_attr_values_fk FOREIGN KEY (movie_id) REFERENCES movies (id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT movie_attr_values_fk_1 FOREIGN KEY (attr_id) REFERENCES movie_attrs (id) ON UPDATE CASCADE ON DELETE CASCADE
);
