Drop DATABASE Jul;
CREATE DATABASE IF NOT EXISTS Jul;
USE Jul;

#---------------CREATE TABLES---------------#

CREATE TABLE genre(
name varchar(255) NOT NULL,
PRIMARY KEY (name)
) engine = InnoDB;

CREATE TABLE participant(
id int auto_increment,
name varchar(255),
PRIMARY KEY (id)
) eNGINE = InnoDB;

CREATE INDEX hejsan ON participant(name);

CREATE TABLE movie(
id int auto_increment,
name varchar(255) NOT NULL,
genre_name varchar(255),
imdb_rating float,
jayornay varchar(255),
picked_by varchar(255),
participants varchar(255),
is_major char(1),
PRIMARY KEY (id),
FOREIGN KEY (genre_name) REFERENCES genre(name),
FOREIGN KEY (picked_by) REFERENCES participant(name)
) Engine = InnoDB;

CREATE TABLE participated(
movieID int,
participantID int,
PRIMARY KEY (movieID, participantID),
FOREIGN KEY (participantID) REFERENCES participant(id),
FOREIGN KEY (movieID) REFERENCES movie(id)
) ENGINE = InnoDB;

# --------INSERTS----------#

INSERT INTO genre(name)
VALUES ("Action"),("Adventure"),("Animation"),("Biography"),("Comedy"),("Crime"),("CUSTOM RULES"),
("Drama"),("Family"),("Fantasy"),("History"),("Horror"),("Musical"),("Mystery"),
("Romance"),("Science-Fiction"),("Sport"),("Superhero"),("Thriller"),("War"),("Western"),("Wildcard");

INSERT INTO participant(name)
VALUES ("Micke"), ("Gabbe"), ("Crippe"), ("Behrad"), ("Linus"), ("Momme"), ("Victor"), ("Sebbe"), ("Doffer"), ("UNK");

INSERT INTO movie(name, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)
VALUES("Beauty and the beast (live-action)", "Romance", 7.1, "Jay", "Gabbe", "Micke, Gabbe, Crippe", 1), 
("Catch me if you can", "Biography", 8.1, "Jay", "Gabbe", "Micke, Gabbe, Crippe, Behrad", 1), ("1917", "War", 8.2, "Jay", "Micke", "Micke, Gabbe", 0), 
("Rocky IV", "Sport", 6.8, "Mexican Standoff", "Momme", "Micke, Gabbe, Crippe, Momme", 1), ("Aliens", "Wildcard", 8.4, "Jay", "Linus", "Micke, Gabbe, Crippe, Linus", 1), 
("Spider-Man: Into the spider-verse", "Family", 8.4, "Jay", "Behrad", "Micke, Gabbe, Crippe, Behrad, Momme", 1), ("The Green Mile", "Crime", 8.6, "Jay", "Micke", "Micke, Gabbe, Crippe, Linus", 1), 
("Sinister", "Horror", 6.8, "Jay", "Linus", "Micke, Gabbe, Crippe, Linus", 1), ("Annihilation", "Science-Fiction", 6.8, "Nay", "Linus", "Micke, Gabbe, Crippe, Linus", 1), 
("Toy Story 3", "Fantasy", 8.3, "Jay", "Micke", "Micke, Linus, Sebbe", 0), ("Redline", "Animation", 7.5, "Mexican Standoff", "Crippe", "Micke, Gabbe, Crippe, Linus", 1), 
("se7en", "mystery", 8.6, "Jay", "Behrad", "Micke, Crippe, Linus, Momme, Behrad, Victor", 0), ("Pulp Fiction", "CUSTOM RULES", 8.5, "Jay", "Momme", "Micke, Momme", 0), 
("The Babadook", "Wildcard", 6.8, "Jay", "Crippe", "Micke, Crippe, Linus", 0), ("The Ballad of Buster Scruggs", "Drama", 7.3, "Jay", "Micke", "Micke, Gabbe, Crippe, Behrad, Viktor, Momme", 1), 
("Joker", "Wildcard", 8.4, "Jay", "Behrad", "Micke, Momme, Behrad, Linus, Crippe", 0), ("American Psycho", "Crime", 7.6, "Jay", "Micke", "Micke, Linus, Behrad", 0), 
("Inglorious basterds", "War", 8.3, "Jay", "UNK", "Micke, Behrad, Crippe, Linus", 0), ("A bug's life", "Adventure", 7.2, "Jay", "Micke", "Micke, Crippe, Linus", 0), 
("Zootopia", "Crime", 8, "Jay", "Micke", "Micke, Crippe, Linus, Behrad, Momme", 0), ("Treasure planet", "Animation", 7.2, "Jay", "Gabbe", "Micke, Crippe, Gabbe, Linus", 1), 
("The Wolf of Wall Street", "Biography", 8.2, "Jay", "Crippe", "Micke, Crippe, Linus, Behrad", 0), ("The revenant", "Western", 8, "Mexican standoff", "Crippe", "Micke, Crippe", 0),
("Alita: Battle Angel", "CUSTOM RULES", 7.3, "Jay", "Micke", "Micke, Crippe, Behrad", 0), ("Baby Driver","Crime", 7.6, "Jay" , "Micke", "Micke, Crippe, Linus", 0), 
("Lilo & Stitch", "Fantasy", 7.3, "Jay", "Momme", "Micke, Crippe, Behrad, Momme", 0);

INSERT INTO participated(movieID, participantID)
VALUES (1,1), (1,2), (1,3), (2,1), (2,2), (2,3), (2,4), (3,1), (3,2), (4,1), (4,2), (4,3), (4,6), (5,1), (5,2), (5,3), (5,5), (6,1), (6,2), (6,3), (6,4), (6,5), (7,1), (7,2), (7,3), (7,5),
(8,1), (8,2), (8,3), (8,5), (9,1), (9,2), (9,3), (9,5), (10,1), (10,5), (10,8), (11,1), (11,2), (11,3), (11,5), (12,1), (12,3), (12,4), (12,5), (12,6), (12,7), (13,1), (13,6), (14,1), (14,3), 
(14,5), (15,1), (15,2), (15,3), (15,4), (15,6), (15,7), (16,1), (16,3), (16,4), (16,5), (16,6), (17,1), (17,4), (17,5), (18,1), (18,3), (18,4), (18,5), (19,1), (19,3), (19,5), (20,1), (20,3), 
(20,4), (20,5), (20,6), (21,1), (21,2), (21,3), (21,5), (22,1), (22,3), (22,4), (22,5), (23,1), (23,3), (24,1), (24,3), (24,4), (25,1), (25,3), (25,5), (26,1), (26,3), (26,4), (26,6);