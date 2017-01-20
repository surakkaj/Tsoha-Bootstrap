CREATE TABLE Player(
    id SERIAL PRIMARY KEY,
    handle varchar(50) NOT NULL,
    pass  char(128) NOT NULL,
    email varchar(50)
);
CREATE TABLE Track(
    id SERIAL PRIMARY KEY,
    trackname varchar(50) NOT NULL,
    location  varchar(128) NOT NULL,
    lenght INTEGER
);
CREATE TABLE Run(
    id SERIAL PRIMARY KEY,
    track INTEGER REFERENCES Track(id),
    playerid INTEGER REFERENCES Player(id),
    playdate  DATE,
    progress INTEGER
);
CREATE TABLE Score(
    id SERIAL PRIMARY KEY,
    run INTEGER REFERENCES run(id),
    playerid INTEGER REFERENCES Player(id),
    throws INTEGER
	holeid INTEGER REFERENCES Hole(id)
);
CREATE TABLE Hole(
    id SERIAL PRIMARY KEY,
    track INTEGER REFERENCES track(id),
    par INTEGER,
    lenght INTEGER
);


