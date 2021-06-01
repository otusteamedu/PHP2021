CREATE DATABASE cinema;
USE cinema;

CREATE TABLE schedule (
    hall tinyint NOT NULL PRIMARY KEY,
    title CHAR(255) NOT NULL,
    timestamp int(11) NOT NULL
);

CREATE TABLE tickets (
    idx CHAR(255) NOT NULL PRIMARY KEY,
    timestamp int(11) NOT NULL,
    hall tinyint NOT NULL,
    title CHAR(255) NOT NULL,
    row tinyint NOT NULL,
    seats tinyint NOT NULL
);

CREATE TABLE capacity (
    hall tinyint NOT NULL PRIMARY KEY,
    title CHAR(255) NOT NULL,
    row tinyint NOT NULL,
    seats tinyint NOT NULL
);