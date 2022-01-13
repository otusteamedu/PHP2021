CREATE TABLE users (
    id SERIAL PRIMARY KEY ,
    first_name varchar(100) NOT NULL,
    last_name varchar(100) NOT NULL,
    age integer CHECK (age > 10 AND age < 100) NOT NULL,
    email varchar(100) NOT NULL,
    status_student bool NOT NULL DEFAULT '1'
);