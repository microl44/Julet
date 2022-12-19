DROP DATABASE IF EXISTS Jul;
CREATE DATABASE IF NOT EXISTS Jul;
USE Jul;

#---------------CREATE TABLES---------------#

CREATE TABLE genre(
name varchar(255) NOT NULL,
NextGenre BOOLEAN NOT NULL DEFAULT 0,
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

CREATE TABLE movieDescription(
	movieID int,
    cover_path varchar(255),
    description BLOB(65535),
    PRIMARY KEY (movieID),
    FOREIGN KEY (movieID) REFERENCES movie(id)
) Engine = InnoDB;

CREATE TABLE participated(
movieID int,
participantID int,
PRIMARY KEY (movieID, participantID),
FOREIGN KEY (participantID) REFERENCES participant(id),
FOREIGN KEY (movieID) REFERENCES movie(id)
) ENGINE = InnoDB;

CREATE TABLE users (
  user_id int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (user_id)
);

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
("Lilo & Stitch", "Fantasy", 7.3, "Jay", "Momme", "Micke, Crippe, Behrad, Momme", 0), ("Hot Fuzz", "Mystery", 7.8, "Jay", "Crippe", "Micke, Gabbe, Crippe, Behrad, Linus, Momme", 1),
("Braveheart", "Biography", 8.4, "Nay", "Crippe", "Micke, Crippe, Behrad", 0), ("Dodgeball: A True Underdog Story", "Sport", 6.7, "Jay", "Micke", "Micke, Crippe, Behrad, Linus", 0),
("The Pianist", "Biography", 8.5, "Jay", "Micke", "Micke, Crippe, Behrad, Momme", 0);

INSERT INTO movieDescription(movieID, description)
VALUES (1, "A selfish Prince is cursed to become a monster for the rest of his life, unless he learns to fall in love with a beautiful young woman he keeps prisoner."), 
(2, "Barely 21 yet, Frank is a skilled forger who has passed as a doctor, lawyer and pilot. FBI agent Carl becomes obsessed with tracking down the con man, who only revels in the pursuit."), 
(3, "April 6th, 1917. As an infantry battalion assembles to wage war deep in enemy territory, two soldiers are assigned to race against time and deliver a message that will stop 1,600 men from walking straight into a deadly trap."), 
(4, "Rocky Balboa proudly holds the world heavyweight boxing championship, but a new challenger has stepped forward: Drago, a six-foot-four, 261-pound fighter who has the backing of the Soviet Union."), 
(5, "Fifty-seven years after surviving an apocalyptic attack aboard her space vessel by merciless space creatures, Officer Ripley awakens from hyper-sleep and tries to warn anyone who will listen about the predators."), 
(6, "Teen Miles Morales becomes the Spider-Man of his universe, and must join with five spider-powered individuals from other dimensions to stop a threat for all realities."), 
(7, "The lives of guards on Death Row are affected by one of their charges: a black man accused of child murder and rape, yet who has a mysterious gift."), 
(8, "A controversial true crime writer finds a box of super 8 home movies in his new home, revealing that the murder case he is currently researching could be the work of an unknown serial killer whose legacy dates back to the 1960s."), 
(9, "A biologist signs up for a dangerous, secret expedition into a mysterious zone where the laws of nature don't apply."), 
(10, "The toys are mistakenly delivered to a day-care center instead of the attic right before Andy leaves for college, and it's up to Woody to convince the other toys that they weren't abandoned and to return home."), 
(11, "A story about the most popular racing event in the galaxy, the Redline, and the various racers who compete in it."), 
(12, "Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives."), 
(13, "The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption."), 
(14, "A single mother and her child fall into a deep well of paranoia when an eerie children's book titled 'Mister Babadook' manifests in their home."), 
(15, "Six tales of life and violence in the Old West, following a singing gunslinger, a bank robber, a traveling impresario, an elderly prospector, a wagon train, and a perverse pair of bounty hunters."), 
(16, "A mentally troubled stand-up comedian embarks on a downward spiral that leads to the creation of an iconic villain."), 
(17, "A wealthy New York City investment banking executive, Patrick Bateman, hides his alternate psychopathic ego from his co-workers and friends as he delves deeper into his violent, hedonistic fantasies."), 
(18, "In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre owner's vengeful plans for the same."), 
(19, "A misfit ant, looking for 'warriors' to save his colony from greedy grasshoppers, recruits a group of bugs that turn out to be an inept circus troupe."), 
(20, "In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy."), 
(21, "In this science fiction rendering of the classic novel 'Treasure Island', Jim Hawkins (Joseph Gordon-Levitt) is a rebellious teen seen by the world as an aimless slacker. After he receives a map from a dying pirate, he embarks on an odyssey across the universe to find the legendary Treasure Planet."), 
(22, "Based on the true story of Jordan Belfort, from his rise to a wealthy stock-broker living the high life to his fall involving crime, corruption and the federal government."), 
(23, "A frontiersman on a fur trading expedition in the 1820s fights for survival after being mauled by a bear and left for dead by members of his own hunting team."), 
(24, "A deactivated cyborg's revived, but can't remember anything of her past and goes on a quest to find out who she is."), 
(25, "After being coerced into working for a crime boss, a young getaway driver finds himself taking part in a heist doomed to fail."), 
(26, "A young and parentless girl adopts a 'dog' from the local pound, completely unaware that it's supposedly a dangerous scientific experiment that's taken refuge on Earth and is now hiding from its creator and those who see it as a menace."), 
(27, "A skilled London police officer, after irritating superiors with his embarrassing effectiveness, is transferred to a village where the easygoing officers object to his fervor for regulations, as a string of grisly murders strikes the town."), 
(28, "Scottish warrior William Wallace leads his countrymen in a rebellion to free his homeland from the tyranny of King Edward I of England."), 
(29, "A group of misfits enter a Las Vegas dodgeball tournament in order to save their cherished local gym from the onslaught of a corporate health fitness chain."),
(30, "A Polish Jewish musician struggles to survive the destruction of the Warsaw ghetto of World War II."); 

INSERT INTO participated(movieID, participantID)
VALUES (1,1), (1,2), (1,3), (2,1), (2,2), (2,3), (2,4), (3,1), (3,2), (4,1), (4,2), (4,3), (4,6), (5,1), (5,2), (5,3), (5,5), (6,1), (6,2), (6,3), (6,4), (6,5), (7,1), (7,2), (7,3), (7,5),
(8,1), (8,2), (8,3), (8,5), (9,1), (9,2), (9,3), (9,5), (10,1), (10,5), (10,8), (11,1), (11,2), (11,3), (11,5), (12,1), (12,3), (12,4), (12,5), (12,6), (12,7), (13,1), (13,6), (14,1), (14,3), 
(14,5), (15,1), (15,2), (15,3), (15,4), (15,6), (15,7), (16,1), (16,3), (16,4), (16,5), (16,6), (17,1), (17,4), (17,5), (18,1), (18,3), (18,4), (18,5), (19,1), (19,3), (19,5), (20,1), (20,3), 
(20,4), (20,5), (20,6), (21,1), (21,2), (21,3), (21,5), (22,1), (22,3), (22,4), (22,5), (23,1), (23,3), (24,1), (24,3), (24,4), (25,1), (25,3), (25,5), (26,1), (26,3), (26,4), (26,6),
(27, 1), (27, 2), (27, 3), (27, 4), (27, 5), (27, 6), (28, 1), (28, 3), (28, 4), (28, 5), (29, 1), (29, 3), (29, 4), (29, 5), (30, 1), (30, 3), (30, 4), (30, 6);

INSERT INTO users(username, email, password)
VALUES ('testUser', 'a20micro@student.his.se', 'password');

CREATE VIEW movie_participants AS
	SELECT m.id as 'id', m.name as 'name', m.genre_name as genre, m.imdb_rating as rating, m.jayornay as 'Jay or Nay', m.picked_by as 'picked by',
	GROUP_CONCAT(p.name) AS participants, m.is_major
	FROM movie m
	JOIN participated part ON part.movieID = m.id
	JOIN participant p ON p.id = part.participantID
GROUP BY m.id;

SELECT * FRom movie_participants;