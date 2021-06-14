CREATE DATABASE cinema;
USE cinema;

CREATE TABLE schedule (
    id_hall tinyint NOT NULL PRIMARY KEY,
    title_id int NOT NULL,
    timestamp int(11) NOT NULL
);

CREATE TABLE tickets (
    id CHAR(255) NOT NULL PRIMARY KEY,
    timestamp int(11) NOT NULL,
    hall tinyint NOT NULL,
    title_id int NOT NULL,
    row tinyint NOT NULL,
    seat tinyint NOT NULL,
    price float NOT NULL
);

CREATE TABLE hall1 (
    row tinyint NOT NULL,
    seats tinyint NOT NULL
);

CREATE TABLE titles (
    id int NOT NULL PRIMARY KEY,
    title CHAR(255) NOT NULL,
);