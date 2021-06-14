CREATE TABLE IF NOT EXISTS films (
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	duration INTEGER NOT NULL,
	release_date DATE NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS attribute_types (
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	code VARCHAR(255) NOT NULL,
	description VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS attributes (
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	code VARCHAR(255) NOT NULL,
	attribute_type_id INTEGER NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT attribute_attribute_type_id_fk FOREIGN KEY (attribute_type_id) REFERENCES attribute_types(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS attribute_values (
	id SERIAL NOT NULL,
	attribute_id INTEGER NOT NULL,
	film_id INTEGER NOT NULL,
	value_text TEXT,
	value_date DATE,
	value_money MONEY,
	value_int INTEGER,
	value_bool BOOLEAN,
	value_float FLOAT8,
	value_time TIMESTAMP WITHOUT TIME ZONE,
	PRIMARY KEY (id),
	CONSTRAINT attribute_value_attribute_id_fk FOREIGN KEY (attribute_id) REFERENCES attributes(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT attribute_value_film_id_fk FOREIGN KEY (film_id) REFERENCES films(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE UNIQUE INDEX IF NOT EXISTS films_indx ON films(name, release_date);
CREATE UNIQUE INDEX IF NOT EXISTS attributes_indx ON attributes(code);
CREATE UNIQUE INDEX IF NOT EXISTS attribute_types_indx ON attribute_types(code);