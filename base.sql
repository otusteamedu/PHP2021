CREATE DATABASE cinema;
USE cinema;

CREATE TABLE schedule (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_hall tinyint NOT NULL,
    title_id int NOT NULL,
    timestamp int(11) NOT NULL,
    price float NOT NULL
);

CREATE TABLE tickets (
    id CHAR(255) NOT NULL PRIMARY KEY,
    timestamp int(11) NOT NULL,
    id_hall tinyint NOT NULL,
    title_id int NOT NULL,
    row tinyint NOT NULL,
    seat tinyint NOT NULL,
    price float NOT NULL
);

CREATE TABLE halls_list (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_hall int NOT NULL PRIMARY KEY,
    title CHAR(255) NOT NULL,
);

CREATE TABLE hall (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_hall tinyint NOT NULL,
    row tinyint NOT NULL,
    seats tinyint NOT NULL
);