CREATE TABLE orders (
    id SERIAL PRIMARY KEY ,
    card_number varchar(16) NOT NULL,
    card_holder varchar(100) NOT NULL,
	card_expiration varchar(10) NOT NULL,
    cvv integer NOT NULL,
    order_number varchar(100) NOT NULL,
    sum_order float NOT NULL
);