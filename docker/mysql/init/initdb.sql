CREATE DATABASE bookstore;

USE bookstore;

CREATE TABLE books (
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    author varchar(255) NOT NULL,
    number_of_pages int NOT NULL,
    year int NOT NULL,
    price decimal(10,2) NOT NULL
);

CREATE INDEX books_title_idx ON books (title);
CREATE INDEX books_author_idx ON books (author);
