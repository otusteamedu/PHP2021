CREATE TABLE halls (
                       id INTEGER,
                       name TEXT(256),
                       description TEXT,
                       seats INTEGER,
                       CONSTRAINT id PRIMARY KEY (id)
);

CREATE TABLE films (
                       id INTEGER,
                       name TEXT(256),
                       description TEXT,
                       duration INTEGER,
                       CONSTRAINT id PRIMARY KEY (id)
);

CREATE TABLE "session" (
                           id INTEGER,
                           date NUMERIC,
                           time NUMERIC,
                           hall INTEGER,
                           film INTEGER, cost INTEGER,
                           CONSTRAINT id PRIMARY KEY (id),
                           CONSTRAINT "session" FOREIGN KEY (hall) REFERENCES halls(id),
                           CONSTRAINT film FOREIGN KEY (film) REFERENCES films(id)
);

CREATE TABLE tickets (
                         id INTEGER,
                         "session" INTEGER,
                         dateTime NUMERIC,
                         CONSTRAINT id PRIMARY KEY (id),
                         CONSTRAINT FK_tickets_session FOREIGN KEY ("session") REFERENCES "session"(id)
);