--CREATE DATABASE kino;

CREATE TABLE hall (
	idHall serial NOT NULL,
	name varchar(255) NOT NULL,
	CONSTRAINT hall_pk PRIMARY KEY (idHall)
) WITH (
  OIDS=FALSE
);



CREATE TABLE show (
	idShow serial NOT NULL,
	name varchar(255) NOT NULL,
	CONSTRAINT show_pk PRIMARY KEY (idShow)
) WITH (
  OIDS=FALSE
);



CREATE TABLE event (
	idEvent serial NOT NULL,
	idHall bigint NOT NULL,
	idShow bigint NOT NULL,
	beginTime TIMESTAMP NOT NULL,
	CONSTRAINT event_pk PRIMARY KEY (idEvent)
) WITH (
  OIDS=FALSE
);



CREATE TABLE client (
	idClient serial NOT NULL,
	name varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	CONSTRAINT client_pk PRIMARY KEY (idClient)
) WITH (
  OIDS=FALSE
);



CREATE TABLE ticketRealization (
	idTicketRealization serial NOT NULL,
	timeRealization TIMESTAMP NOT NULL,
	idClient bigint NOT NULL,
	idEvent bigint NOT NULL,
	idPlace bigint NOT NULL,
	iPrice money NOT NULL,
	CONSTRAINT ticketRealization_pk PRIMARY KEY (idTicketRealization)
) WITH (
  OIDS=FALSE
);



CREATE TABLE place (
	idPlace serial NOT NULL,
	row varchar(10) NOT NULL,
	seat varchar(10) NOT NULL,
	idHall bigint NOT NULL,
	CONSTRAINT place_pk PRIMARY KEY (idPlace)
) WITH (
  OIDS=FALSE
);



CREATE TABLE ticketPrice (
	idTicket serial NOT NULL,
	idPlace bigint NOT NULL,
	idEvent bigint NOT NULL,
	price money NOT NULL,
	CONSTRAINT ticketPrice_pk PRIMARY KEY (idTicket)
) WITH (
  OIDS=FALSE
);





ALTER TABLE event ADD CONSTRAINT event_fk0 FOREIGN KEY (idHall) REFERENCES Hall(idHall);
ALTER TABLE event ADD CONSTRAINT event_fk1 FOREIGN KEY (idShow) REFERENCES Show(idShow);


ALTER TABLE ticketRealization ADD CONSTRAINT ticketRealization_fk0 FOREIGN KEY (idClient) REFERENCES client(idClient);
ALTER TABLE ticketRealization ADD CONSTRAINT ticketRealization_fk1 FOREIGN KEY (idEvent) REFERENCES event(idEvent);
ALTER TABLE ticketRealization ADD CONSTRAINT ticketRealization_fk2 FOREIGN KEY (idPlace) REFERENCES place(idPlace);

ALTER TABLE place ADD CONSTRAINT Places_fk0 FOREIGN KEY (idHall) REFERENCES hall(idHall);

ALTER TABLE ticketPrice ADD CONSTRAINT ticketPrice_fk0 FOREIGN KEY (idPlace) REFERENCES place(idPlace);
ALTER TABLE ticketPrice ADD CONSTRAINT ticketPrice_fk1 FOREIGN KEY (idEvent) REFERENCES event(idEvent);








