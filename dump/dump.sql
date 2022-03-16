CREATE TABLE requests (
    id SERIAL PRIMARY KEY ,
    first_name varchar(100) NOT NULL,
    email varchar(50) NOT NULL,
	phone varchar(10) NOT NULL,
    date1 varchar(10) NOT NULL,
    date2 varchar(10) NOT NULL,
	status bool NOT NULL DEFAULT '0'
);