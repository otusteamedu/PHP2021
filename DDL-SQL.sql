CREATE TABLE IF NOT EXISTS movies (
	id serial PRIMARY KEY,
    name VARCHAR ( 255 ) UNIQUE NOT NULL,
    duration time NULL
);

CREATE TABLE IF NOT EXISTS halls (
	id serial PRIMARY KEY,
    name VARCHAR ( 30 ) UNIQUE NOT NULL,
    num_rows int NOT NULL,
    chairs_in_row int NOT NULL
);

CREATE TABLE IF NOT EXISTS sessions (
	id serial PRIMARY KEY,
    movie_id BIGINT UNSIGNED,
    hall_id BIGINT UNSIGNED,
    time_start datetime NOT NULL,   
	FOREIGN KEY (movie_id)  REFERENCES movies (id),
	FOREIGN KEY (hall_id)  REFERENCES halls (id)
);

CREATE TABLE IF NOT EXISTS orders (
	id serial PRIMARY KEY,
    status VARCHAR (30) NOT NULL DEFAULT 'NOT_PAID',
    created_at datetime NOT NULL
);

CREATE TABLE IF NOT EXISTS tickets (
	id serial PRIMARY KEY,
    session_id BIGINT UNSIGNED,
    n_row int NOT NULL,
    chair int NOT NULL,
    cost double NOT NULL,
	FOREIGN KEY (session_id)  REFERENCES sessions (id)
);

CREATE TABLE IF NOT EXISTS order_ticket (
	order_id BIGINT UNSIGNED,
    ticket_id BIGINT UNSIGNED,
	PRIMARY KEY (order_id, ticket_id),
	FOREIGN KEY (order_id)  REFERENCES orders (id),
	FOREIGN KEY (ticket_id)  REFERENCES tickets (id)
);