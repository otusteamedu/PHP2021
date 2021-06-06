CREATE TABLE IF NOT EXISTS films (
   id SERIAL NOT NULL,
   name VARCHAR(255) NOT NULL,
   duration INTEGER NOT NULL,
   release_date DATE NOT NULL,
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
   PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS halls (
   id SERIAL NOT NULL,
   name VARCHAR(255) NOT NULL,
   description VARCHAR(255),
   PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS halls_sectors_places (
   id SERIAL NOT NULL,
   hall_sector_id INTEGER NOT NULL,
   place_row INTEGER NOT NULL,
   place_column INTEGER NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS tickets (
   session_id INTEGER NOT NULL,
   hall_sector_place_id INTEGER NOT NULL,
   date DATE NOT NULL,
   time TIME WITHOUT TIME ZONE NOT NULL,
   client VARCHAR(255) NOT NULL,
   PRIMARY KEY (session_id, hall_sector_place_id)
);

CREATE TABLE IF NOT EXISTS halls_sectors (
   id SERIAL NOT NULL,
   hall_id INTEGER NOT NULL,
   sector_id INTEGER NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS prices (
   session_id INTEGER NOT NULL,
   hall_sector_id INTEGER NOT NULL,
   price MONEY NOT NULL,
   PRIMARY KEY (session_id, hall_sector_id)
);

ALTER TABLE sessions ADD FOREIGN KEY (hall_id) REFERENCES halls(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE sessions ADD FOREIGN KEY (film_id) REFERENCES films(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE halls_sectors_places ADD FOREIGN KEY (hall_sector_id) REFERENCES halls_sectors(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE tickets ADD FOREIGN KEY (session_id) REFERENCES sessions(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE tickets ADD FOREIGN KEY (hall_sector_place_id) REFERENCES halls_sectors_places(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE halls_sectors ADD FOREIGN KEY (hall_id) REFERENCES halls(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE halls_sectors ADD FOREIGN KEY (sector_id) REFERENCES sectors(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE prices ADD FOREIGN KEY (session_id) REFERENCES sessions(id) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE prices ADD FOREIGN KEY (hall_sector_id) REFERENCES halls_sectors(id) ON DELETE RESTRICT ON UPDATE CASCADE;

CREATE UNIQUE INDEX films_indx ON films(name, release_date);
CREATE UNIQUE INDEX sessions_indx ON sessions(hall_id, film_id, date, time);
CREATE UNIQUE INDEX halls_sectors_indx ON halls_sectors(hall_id, sector_id);
CREATE UNIQUE INDEX halls_sectors_places_indx ON halls_sectors_places(hall_sector_id, place_row, place_column);

INSERT INTO films (name, duration, release_date) VALUES
('film1', 120, '2021-05-29'),
('film2', 120, '2021-05-29'),
('film3', 120, '2021-05-29'),
('film4', 120, '2021-05-29'),
('film5', 120, '2021-05-29'),
('film6', 120, '2021-05-29');

INSERT INTO halls (name, description) VALUES
('hall1', 'description1'),
('hall2', 'description2'),
('hall3', 'description3'),
('hall4', '');

INSERT INTO sessions (hall_id, film_id, date, time) VALUES
(1, 1, '2021-05-30', '10:00:00'),
(1, 2, '2021-05-30', '12:30:00'),
(1, 3, '2021-05-30', '15:00:00'),
(2, 4, '2021-05-30', '10:00:00'),
(2, 5, '2021-05-30', '12:30:00'),
(2, 6, '2021-05-30', '15:00:00'),
(3, 1, '2021-05-30', '10:00:00'),
(3, 3, '2021-05-30', '12:30:00'),
(3, 5, '2021-05-30', '15:00:00'),
(4, 2, '2021-05-30', '10:00:00'),
(4, 4, '2021-05-30', '12:30:00'),
(4, 6, '2021-05-30', '15:00:00');

INSERT INTO sectors (name, description) VALUES
('Economy', 'description1'),
('Comfort', ''),
('VIP', 'description2');

INSERT INTO halls_sectors (hall_id, sector_id) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3);

INSERT INTO prices (session_id, hall_sector_id, price) VALUES
(1, 1, 100),
(1, 2, 150),
(1, 3, 200),
(2, 1, 150),
(2, 2, 200),
(2, 3, 250),
(3, 1, 200),
(3, 2, 250),
(3, 3, 300),
(4, 4, 100),
(4, 5, 150),
(4, 6, 200),
(5, 4, 150),
(5, 5, 200),
(5, 6, 250),
(6, 4, 200),
(6, 5, 250),
(6, 6, 300),
(7, 7, 100),
(7, 8, 150),
(7, 9, 200),
(8, 7, 150),
(8, 8, 200),
(8, 9, 250),
(9, 7, 200),
(9, 8, 250),
(9, 9, 300),
(10, 10, 100),
(10, 11, 150),
(10, 12, 200),
(11, 10, 150),
(11, 11, 200),
(11, 12, 250),
(12, 10, 250),
(12, 11, 300),
(12, 12, 350);

INSERT INTO halls_sectors_places (hall_sector_id, place_row, place_column) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(2, 3, 1),
(2, 3, 2),
(2, 3, 3),
(3, 2, 1),
(3, 2, 2),
(3, 2, 3),
(4, 1, 1),
(4, 1, 2),
(4, 1, 3),
(5, 1, 1),
(5, 1, 2),
(5, 1, 3),
(6, 1, 1),
(6, 1, 2),
(6, 1, 3),
(7, 1, 1),
(7, 1, 2),
(7, 1, 3),
(8, 1, 1),
(8, 1, 2),
(8, 1, 3),
(9, 1, 1),
(9, 1, 2),
(9, 1, 3),
(10, 1, 1),
(10, 1, 2),
(10, 1, 3),
(11, 1, 1),
(11, 1, 2),
(11, 1, 3),
(12, 1, 1),
(12, 1, 2),
(12, 1, 3);

INSERT INTO tickets (session_id, hall_sector_place_id, date, time, client) VALUES
(1, 2, '2021-05-30', '09:00:00', 'client1'),
(1, 5, '2021-05-30', '09:30:00', 'client2'),
(1, 8, '2021-05-30', '10:00:00', 'client3'),
(2, 2, '2021-05-30', '11:30:00', 'client4'),
(2, 5, '2021-05-30', '12:00:00', 'client5'),
(2, 8, '2021-05-30', '12:30:00', 'client6'),
(3, 2, '2021-05-30', '14:00:00', 'client7'),
(3, 5, '2021-05-30', '14:30:00', 'client8'),
(3, 8, '2021-05-30', '15:00:00', 'client9'),
(4, 11, '2021-05-30', '09:00:00', 'client10'),
(4, 14, '2021-05-30', '09:30:00', 'client11'),
(4, 17, '2021-05-30', '10:00:00', 'client12'),
(5, 11, '2021-05-30', '11:30:00', 'client13'),
(5, 14, '2021-05-30', '12:00:00', 'client14'),
(5, 17, '2021-05-30', '12:30:00', 'client15'),
(6, 11, '2021-05-30', '14:00:00', 'client16'),
(6, 14, '2021-05-30', '14:30:00', 'client17'),
(6, 17, '2021-05-30', '15:00:00', 'client18'),
(7, 20, '2021-05-30', '09:00:00', 'client19'),
(7, 23, '2021-05-30', '09:30:00', 'client20'),
(7, 26, '2021-05-30', '10:00:00', 'client21'),
(8, 20, '2021-05-30', '11:30:00', 'client22'),
(8, 23, '2021-05-30', '12:00:00', 'client23'),
(8, 26, '2021-05-30', '12:30:00', 'client24'),
(9, 20, '2021-05-30', '14:00:00', 'client25'),
(9, 23, '2021-05-30', '14:30:00', 'client26'),
(9, 26, '2021-05-30', '15:00:00', 'client27'),
(10, 29, '2021-05-30', '09:00:00', 'client28'),
(10, 32, '2021-05-30', '09:30:00', 'client29'),
(10, 35, '2021-05-30', '10:00:00', 'client30'),
(11, 29, '2021-05-30', '11:30:00', 'client31'),
(11, 32, '2021-05-30', '12:00:00', 'client32'),
(11, 35, '2021-05-30', '12:30:00', 'client33'),
(12, 29, '2021-05-30', '14:00:00', 'client34'),
(12, 32, '2021-05-30', '14:30:00', 'client35'),
(12, 35, '2021-05-30', '15:00:00', 'client36');