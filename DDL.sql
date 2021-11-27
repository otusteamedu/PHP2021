create table films
(
	id int auto_increment,
	name text not null,
	duration time not null,
	created_at timestamp default CURRENT_TIMESTAMP null,
	primary key (id)
)
engine=InnoDB;

create table halls
(
	id int auto_increment,
	name varchar(255) not null,
	created_at timestamp default CURRENT_TIMESTAMP not null,
	primary key (id)
)
engine=InnoDB;

create table hall_seats
(
	id int auto_increment,
	hall_id int not null,
	row int not null,
	number int not null,
	primary key (id),
	constraint fk_hall_seats_hall
		foreign key (hall_id) references halls (id)
)
engine=InnoDB;

create table orders
(
	id int auto_increment,
	user_id int not null,
	created_at timestamp not null,
	primary key (id)
)
engine=InnoDB;

create table sessions
(
	id int auto_increment,
	hall_id int not null,
	start_at timestamp not null,
	end_at timestamp not null,
	film_id int not null,
	created_at timestamp default CURRENT_TIMESTAMP not null,
	primary key (id),
	constraint fk_sessions_film
		foreign key (film_id) references films (id),
	constraint fk_sessions_hall
		foreign key (hall_id) references halls (id)
)
engine=InnoDB;

create table tickets
(
	id int auto_increment,
	session_id int not null,
	seat_id int not null,
	cost decimal(18,2) not null,
	status enum('ACTIVE', 'RESERVE', 'CONFIRM', '') default 'ACTIVE' not null,
	primary key (id),
	constraint fk_hall_seat_costs_seat
		foreign key (seat_id) references hall_seats (id),
	constraint fk_hall_seat_costs_session
		foreign key (session_id) references sessions (id)
)
engine=InnoDB;

create table order_tickets
(
	order_id int not null,
	ticket_id int not null,
	primary key (order_id, ticket_id),
	constraint fk_order_tickets_order
		foreign key (order_id) references orders (id),
	constraint fk_order_tickets_ticket
		foreign key (ticket_id) references tickets (id)
)
engine=InnoDB;

