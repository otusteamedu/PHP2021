CREATE TABLE IF NOT EXISTS films (
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	duration INTEGER NOT NULL,
	release_date DATE NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS halls (
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	description VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS sectors (
	id SERIAL NOT NULL,
	name VARCHAR(255) NOT NULL,
	description VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS sessions (
	id SERIAL NOT NULL,
	hall_id INTEGER NOT NULL,
	film_id INTEGER NOT NULL,
	date DATE NOT NULL,
	time TIME WITHOUT TIME ZONE NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT session_hall_id_fk FOREIGN KEY (hall_id) REFERENCES halls(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT session_film_id_fk FOREIGN KEY (film_id) REFERENCES films(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS halls_sectors (
	id SERIAL NOT NULL,
	hall_id INTEGER NOT NULL,
	sector_id INTEGER NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT hall_sector_hall_id_fk FOREIGN KEY (hall_id) REFERENCES halls(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT hall_sector_sector_id_fk FOREIGN KEY (sector_id) REFERENCES sectors(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS halls_sectors_places (
	id SERIAL NOT NULL,
	hall_sector_id INTEGER NOT NULL,
	place_row INTEGER NOT NULL,
	place_column INTEGER NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT hall_sector_place_hall_sector_id_fk FOREIGN KEY (hall_sector_id) REFERENCES halls_sectors(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS tickets (
	session_id INTEGER NOT NULL,
	hall_sector_place_id INTEGER NOT NULL,
	date DATE NOT NULL,
	time TIME WITHOUT TIME ZONE NOT NULL,
	client VARCHAR(255) NOT NULL,
	price MONEY NOT NULL,
	PRIMARY KEY (session_id, hall_sector_place_id),
	CONSTRAINT ticket_session_id_fk FOREIGN KEY (session_id) REFERENCES sessions(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT ticket_hall_sector_place_id_fk FOREIGN KEY (hall_sector_place_id) REFERENCES halls_sectors_places(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE UNIQUE INDEX IF NOT EXISTS films_indx ON films(name, release_date);
CREATE UNIQUE INDEX IF NOT EXISTS sessions_indx ON sessions(hall_id, film_id, date, time);
CREATE UNIQUE INDEX IF NOT EXISTS halls_sectors_indx ON halls_sectors(hall_id, sector_id);
CREATE UNIQUE INDEX IF NOT EXISTS halls_sectors_places_indx ON halls_sectors_places(hall_sector_id, place_row, place_column);