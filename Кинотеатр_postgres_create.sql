--CREATE DATABASE kino;

CREATE TABLE "Halls" (
	"IdHall" serial NOT NULL,
	"Name" varchar(255) NOT NULL,
	CONSTRAINT "Halls_pk" PRIMARY KEY ("IdHall")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Shows" (
	"IdShow" serial NOT NULL,
	"Name" varchar(255) NOT NULL,
	CONSTRAINT "Shows_pk" PRIMARY KEY ("IdShow")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Events" (
	"IdEvent" serial NOT NULL,
	"IdHall" bigint NOT NULL,
	"IdShow" bigint NOT NULL,
	"BeginTime" TIMESTAMP NOT NULL,
	CONSTRAINT "Events_pk" PRIMARY KEY ("IdEvent")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Clients" (
	"IdClient" serial NOT NULL,
	"Name" varchar(255) NOT NULL,
	"Email" varchar(255) NOT NULL,
	CONSTRAINT "Clients_pk" PRIMARY KEY ("IdClient")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "TicketRealization" (
	"IdTicketRealization" serial NOT NULL,
	"TimeRealization" TIMESTAMP NOT NULL,
	"IdClient" bigint NOT NULL,
	"IdEvent" bigint NOT NULL,
	"IdPlace" bigint NOT NULL,
	"Price" money NOT NULL,
	CONSTRAINT "TicketRealization_pk" PRIMARY KEY ("IdTicketRealization")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Places" (
	"IdPlace" serial NOT NULL,
	"Row" varchar(10) NOT NULL,
	"Seat" varchar(10) NOT NULL,
	"IdHall" bigint NOT NULL,
	CONSTRAINT "Places_pk" PRIMARY KEY ("IdPlace")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "TicketPrice" (
	"IdTicket" serial NOT NULL,
	"IdPlace" bigint NOT NULL,
	"IdEvent" bigint NOT NULL,
	"Price" money NOT NULL,
	CONSTRAINT "TicketPrice_pk" PRIMARY KEY ("IdTicket")
) WITH (
  OIDS=FALSE
);





ALTER TABLE "Events" ADD CONSTRAINT "Events_fk0" FOREIGN KEY ("IdHall") REFERENCES "Halls"("IdHall");
ALTER TABLE "Events" ADD CONSTRAINT "Events_fk1" FOREIGN KEY ("IdShow") REFERENCES "Shows"("IdShow");


ALTER TABLE "TicketRealization" ADD CONSTRAINT "TicketRealization_fk0" FOREIGN KEY ("IdClient") REFERENCES "Clients"("IdClient");
ALTER TABLE "TicketRealization" ADD CONSTRAINT "TicketRealization_fk1" FOREIGN KEY ("IdEvent") REFERENCES "Events"("IdEvent");
ALTER TABLE "TicketRealization" ADD CONSTRAINT "TicketRealization_fk2" FOREIGN KEY ("IdPlace") REFERENCES "Places"("IdPlace");

ALTER TABLE "Places" ADD CONSTRAINT "Places_fk0" FOREIGN KEY ("IdHall") REFERENCES "Halls"("IdHall");

ALTER TABLE "TicketPrice" ADD CONSTRAINT "TicketPrice_fk0" FOREIGN KEY ("IdPlace") REFERENCES "Places"("IdPlace");
ALTER TABLE "TicketPrice" ADD CONSTRAINT "TicketPrice_fk1" FOREIGN KEY ("IdEvent") REFERENCES "Events"("IdEvent");








