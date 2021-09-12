CREATE TABLE halls (
    id serial PRIMARY KEY,
    name varchar UNIQUE NOT NULL
);

CREATE TABLE movies (
    id serial PRIMARY KEY,
    name varchar NOT NULL
);

CREATE TABLE seat_groups (
    id serial PRIMARY KEY,
    name varchar NOT NULL,
    price_multiplier float NOT NULL DEFAULT 1
);

CREATE TABLE seats (
    id serial PRIMARY KEY,
    hall_id integer NOT NULL,
    seat_group_id integer NOT NULL,
    row integer NOT NULL,
    seat integer NOT NULL,
    FOREIGN KEY (hall_id) REFERENCES halls (id),
    FOREIGN KEY (seat_group_id) REFERENCES seat_groups (id)
);

CREATE TABLE clients (
    id serial PRIMARY KEY,
    name varchar,
    email varchar,
    phone_number varchar,
    discount integer NOT NULL DEFAULT 0
);

CREATE TABLE sessions (
    id serial PRIMARY KEY,
    time_start timestamp NOT NULL,
    time_end timestamp NOT NULL,
    hall_id integer NOT NULL,
    movie_id integer NOT NULL,
    price numeric(6,2) NOT NULL,
    FOREIGN KEY (hall_id) REFERENCES halls (id),
    FOREIGN KEY (movie_id) REFERENCES movies (id)
);

CREATE TABLE tickets (
    id serial PRIMARY KEY,
    seat_id integer NOT NULL,
    session_id integer NOT NULL,
    client_id integer NOT NULL,
    sell_price numeric(6,2) NOT NULL,
    FOREIGN KEY (seat_id) REFERENCES seats (id),
    FOREIGN KEY (session_id) REFERENCES sessions (id),
    FOREIGN KEY (client_id) REFERENCES clients (id)
);
