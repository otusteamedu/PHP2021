
CREATE TABLE halls (
	id SERIAL,
	name VARCHAR(150),
	PRIMARY KEY(id)
);

CREATE TABLE films (
	id SERIAL,
	name VARCHAR(120),
	price NUMERIC(5,2) NOT NULL,
	duration INT NOT NULL,
	PRIMARY KEY(id)
);


CREATE TABLE session (
	id SERIAL,
	hall_id INT NOT NULL,
	films_id INT NOT NULL,
	start_time TIME NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(hall_id) REFERENCES halls(id),
	FOREIGN KEY(films_id) REFERENCES films(id),
);

CREATE TABLE seats (
	id SERIAL,
	halls_id INT NOT NULL,
	row INT  NOT NULL,
	seat INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(halls_id) REFERENCES halls(id),
);

CREATE TABLE users (
	id SERIAL,
	name VARCHAR(220) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE tickets (
	id SERIAL,
	user_id INT NOT NULL,
	seat_id INT NOT NULL,
	session_id INT NOT NULL,
	total_price NUMERIC(5,2) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(seat_id) REFERENCES seats(id),
	FOREIGN KEY(session_id) REFERENCES session(id),
);

CREATE TABLE busy_seats(
                         id SERIAL,
                         seat_id INT NOT NULL,
                         session_id INT NOT NULL,
                         PRIMARY KEY(id),
                         FOREIGN KEY(seat_id) REFERENCES seats(id),
                         FOREIGN KEY(session_id) REFERENCES session(id),
);