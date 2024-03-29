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
) Engine = InnoDB;

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

CREATE TABLE IMDBMovie(
id varchar(2048),
name varchar(2048)
) Engine = InnoDB;

CREATE TABLE marvel(
id int auto_increment,
name varchar(255) NOT NULL,
imdb_rating float,
average_rating float,
PRIMARY KEY (id)
) Engine = InnoDB;

CREATE TABLE movieDescription(
    movieID int,
    cover_path varchar(255),
    description TEXT,
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

CREATE TABLE marvel_participated(
marvelID int,
marvelparticipantID int,
marvel_grade int NOT NULL,
PRIMARY KEY(marvelID, marvelparticipantID),
FOREIGN KEY(marvelID) REFERENCES marvel(id),
FOREIGN KEY(marvelparticipantID) REFERENCES participant(id)
) Engine = InnoDB;

CREATE TABLE users (
  user_id int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (user_id)
) Engine = InnoDB;

# name + user is unique
CREATE TABLE solo_movie(
id int auto_increment,
name varchar(255) NOT NULL,
user_id int NOT NULL,
imdb_rating float,
grade int,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES users(user_id)
) Engine = InnoDB;

CREATE TABLE activity_log (
id int AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
action VARCHAR(255) NOT NULL,
`timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
data JSON NOT NULL
) ENGINE = InnoDB;

# --------INSERTS----------#

INSERT INTO genre(name)
VALUES ("Action"),("Adventure"),("Animation"),("Biography"),("Comedy"),("Crime"),("CUSTOM RULES"),
("Drama"),("Family"),("Fantasy"),("History"),("Horror"),("Musical"),("Mystery"),
("Romance"),("Science-Fiction"),("Sport"),("Superhero"),("Thriller"),("War"),("Western"),("Wildcard");

INSERT INTO participant(name)
VALUES ("Micke"), ("Gabbe"), ("Crippe"), ("Behrad"), ("Linus"), ("Momme"), ("Victor"), ("Sebbe"), ("Doffer"), ("UNK"), ("Sondre"), ("Adam");

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
("The Pianist", "Biography", 8.5, "Jay", "Micke", "Micke, Crippe, Behrad, Momme", 0), ("Edward Scissorhands", "Fantasy", 7.9, "Jay", "Micke", "Micke, Crippe, Momme, Viktor", 0),
("John Wick", "Wildcard", 7.4, "Jay", "Micke", "Micke, Crippe, Linus", 0), ("The Batman", "Superhero", 7.8, "Jay", "Behrad", "Micke, Gabbe, Crippe, Behrad", 1),
("Bee Movie", "Drama", 6.1, "Jay", "Micke", "Micke, Behrad, Momme", 0), ("The Hunchback of Notre Dame", "Animation", 7.0, "Jay", "Micke", "Micke, Crippe, Behrad, Linus, Momme", 0),
("127 Hours", "Biography", 7.5, "Jay", "Micke", "Micke, Crippe, Momme, Doffer", 0), ("Cars 2", "Mystery", 6.2, "Nay", "Micke", "Micke, Crippe, Adam", 0),
("Everything Everywhere All at Once", "CUSTOM RULES", 7.8, "Jay", "Micke", "Micke, Crippe", 0), ("District 9", "CUSTOM RULES", 7.9, "Jay", "Micke", "Micke, Crippe", 0),
("Indiana Jones: Raiders of the Lost Ark", "Action", 8.4, "Jay", "Doffer", "Micke, Crippe, Doffer", 0), ("Life of Brian", "CUSTOM RULES", 8.0, "Jay", "Crippe", "Micke, Gabbe, Crippe", 1),
("Gremlins", "CUSTOM RULES", 7.3, "Nay", "Gabbe", "Micke, Gabbe, Crippe", 0), ("Cruella", "Crime", 7.3, "Jay", "Doffer", "Micke, Crippe, Doffer", 0);

INSERT INTO marvel(name, imdb_rating)
VALUES("Captain America", 6.9), ("Captain Marvel", 6.8), ("Iron Man", 7.9), ("Iron Man 2", 6.9), ("The Incredible Hulk", 6.6),
("Thor", 7.0), ("The Avengers", 8.0), ("Thor - The Dark World", 6.8), ("Iron Man 3", 7.1), ("Captain America - The Winter Soldier", 7.8), 
("Guardians of the Galaxy", 8.0), ("Guardians of the Galaxy 2", 7.6), ("Avengers - Age of Ultron", 7.3), ("Ant Man", 7.3), ("Captain America - Civil War", 7.8), 
("Spider Man - Homecoming", 7.4), ("Black Panther", 7.3), ("Black Widow", 6.7), ("Doctor Strange", 7.5), ("Thor - Ragnarök", 7.9),
("Ant Man and the Wasp", 7.0), ("Avengers: Infinity War", 8.4), ("Avengers: End Game", 8.4), ("Spider Man - Far From Home", 7.4), ("Spider Man - No Way Home", 8.2), 
("Shang-Chi and The Legend of the Ten Rings", 7.4), ("Eternals", 6.3), ("Dr Strange in the Multiverse of Madness", 6.9), ("Thor - Love and Thunder", 6.2), ("Black Panther: Wakanda Forever", 6.7),
("Ant-Man and the Wasp: Quantumania", 6.1), ("Guardians of the Galaxy Vol. 3", 8.0), ("Morbius", 5.2), ("Spider-Man", 7.4), ("Spider-Man 2", 7.5), ("Spider-Man 3", 6.3), ("The Amazing Spider-Man", 6.9) ;   

INSERT INTO movieDescription(movieID, cover_path, description)
VALUES (1, "C:/xampp/htdocs/Julet/Shared/Images/cover.png", "A selfish Prince is cursed to become a monster for the rest of his life, unless he learns to fall in love with a beautiful young woman he keeps prisoner."), 
(2, "C:/xampp/htdocs/Julet/Shared/Images/cover1.png", "Barely 21 yet, Frank is a skilled forger who has passed as a doctor, lawyer and pilot. FBI agent Carl becomes obsessed with tracking down the con man, who only revels in the pursuit."), 
(3, "C:/xampp/htdocs/Julet/Shared/Images/cover2.png", "April 6th, 1917. As an infantry battalion assembles to wage war deep in enemy territory, two soldiers are assigned to race against time and deliver a message that will stop 1,600 men from walking straight into a deadly trap."), 
(4, "C:/xampp/htdocs/Julet/Shared/Images/cover3.png", "Rocky Balboa proudly holds the world heavyweight boxing championship, but a new challenger has stepped forward: Drago, a six-foot-four, 261-pound fighter who has the backing of the Soviet Union."), 
(5, "C:/xampp/htdocs/Julet/Shared/Images/cover4.png", "Fifty-seven years after surviving an apocalyptic attack aboard her space vessel by merciless space creatures, Officer Ripley awakens from hyper-sleep and tries to warn anyone who will listen about the predators."), 
(6, "C:/xampp/htdocs/Julet/Shared/Images/cover5.png", "Teen Miles Morales becomes the Spider-Man of his universe, and must join with five spider-powered individuals from other dimensions to stop a threat for all realities."), 
(7, "C:/xampp/htdocs/Julet/Shared/Images/cover6.png", "The lives of guards on Death Row are affected by one of their charges: a black man accused of child murder and rape, yet who has a mysterious gift."), 
(8, "C:/xampp/htdocs/Julet/Shared/Images/cover7.png", "A controversial true crime writer finds a box of super 8 home movies in his new home, revealing that the murder case he is currently researching could be the work of an unknown serial killer whose legacy dates back to the 1960s."), 
(9, "C:/xampp/htdocs/Julet/Shared/Images/cover8.png", "A biologist signs up for a dangerous, secret expedition into a mysterious zone where the laws of nature don't apply."), 
(10, "C:/xampp/htdocs/Julet/Shared/Images/cover9.png", "The toys are mistakenly delivered to a day-care center instead of the attic right before Andy leaves for college, and it's up to Woody to convince the other toys that they weren't abandoned and to return home."), 
(11, "C:/xampp/htdocs/Julet/Shared/Images/cover10.png", "A story about the most popular racing event in the galaxy, the Redline, and the various racers who compete in it."), 
(12, "C:/xampp/htdocs/Julet/Shared/Images/cover11.png", "Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives."), 
(13, "C:/xampp/htdocs/Julet/Shared/Images/cover12.png", "The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption."), 
(14, "C:/xampp/htdocs/Julet/Shared/Images/cover13.png", "A single mother and her child fall into a deep well of paranoia when an eerie children's book titled 'Mister Babadook' manifests in their home."), 
(15, "C:/xampp/htdocs/Julet/Shared/Images/cover14.png", "Six tales of life and violence in the Old West, following a singing gunslinger, a bank robber, a traveling impresario, an elderly prospector, a wagon train, and a perverse pair of bounty hunters."), 
(16, "C:/xampp/htdocs/Julet/Shared/Images/cover15.png", "A mentally troubled stand-up comedian embarks on a downward spiral that leads to the creation of an iconic villain."), 
(17, "C:/xampp/htdocs/Julet/Shared/Images/cover16.png", "A wealthy New York City investment banking executive, Patrick Bateman, hides his alternate psychopathic ego from his co-workers and friends as he delves deeper into his violent, hedonistic fantasies."), 
(18, "C:/xampp/htdocs/Julet/Shared/Images/cover17.png", "In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre owner's vengeful plans for the same."), 
(19, "C:/xampp/htdocs/Julet/Shared/Images/cover18.png", "A misfit ant, looking for 'warriors' to save his colony from greedy grasshoppers, recruits a group of bugs that turn out to be an inept circus troupe."), 
(20, "C:/xampp/htdocs/Julet/Shared/Images/cover19.png", "In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy."), 
(21, "C:/xampp/htdocs/Julet/Shared/Images/cover20.png", "In this science fiction rendering of the classic novel 'Treasure Island', Jim Hawkins (Joseph Gordon-Levitt) is a rebellious teen seen by the world as an aimless slacker. After he receives a map from a dying pirate, he embarks on an odyssey across the universe to find the legendary Treasure Planet."), 
(22, "C:/xampp/htdocs/Julet/Shared/Images/cover21.png", "Based on the true story of Jordan Belfort, from his rise to a wealthy stock-broker living the high life to his fall involving crime, corruption and the federal government."), 
(23, "C:/xampp/htdocs/Julet/Shared/Images/cover22.png", "A frontiersman on a fur trading expedition in the 1820s fights for survival after being mauled by a bear and left for dead by members of his own hunting team."), 
(24, "C:/xampp/htdocs/Julet/Shared/Images/cover23.png", "A deactivated cyborg's revived, but can't remember anything of her past and goes on a quest to find out who she is."), 
(25, "C:/xampp/htdocs/Julet/Shared/Images/cover24.png", "After being coerced into working for a crime boss, a young getaway driver finds himself taking part in a heist doomed to fail."), 
(26, "C:/xampp/htdocs/Julet/Shared/Images/cover25.png", "A young and parentless girl adopts a 'dog' from the local pound, completely unaware that it's supposedly a dangerous scientific experiment that's taken refuge on Earth and is now hiding from its creator and those who see it as a menace."), 
(27, "C:/xampp/htdocs/Julet/Shared/Images/cover26.png", "A skilled London police officer, after irritating superiors with his embarrassing effectiveness, is transferred to a village where the easygoing officers object to his fervor for regulations, as a string of grisly murders strikes the town."), 
(28, "C:/xampp/htdocs/Julet/Shared/Images/cover27.png", "Scottish warrior William Wallace leads his countrymen in a rebellion to free his homeland from the tyranny of King Edward I of England."), 
(29, "C:/xampp/htdocs/Julet/Shared/Images/cover28.png", "A group of misfits enter a Las Vegas dodgeball tournament in order to save their cherished local gym from the onslaught of a corporate health fitness chain."),
(30, "C:/xampp/htdocs/Julet/Shared/Images/cover29.png", "A Polish Jewish musician struggles to survive the destruction of the Warsaw ghetto of World War II."),
(31, "C:/xampp/htdocs/Julet/Shared/Images/cover30.png", "The solitary life of an artificial man - who was incompletely constructed and has scissors for hands - is upended when he is taken in by a suburban family."),
(32, "C:/xampp/htdocs/Julet/Shared/Images/cover31.png", "An ex-hit-man comes out of retirement to track down the gangsters that killed his dog and took his car."),
(33, "C:/xampp/htdocs/Julet/Shared/Images/cover32.png", "When a sadistic serial killer begins murdering key political figures in Gotham, Batman is forced to investigate the city's hidden corruption and question his family's involvement."),
(34, "C:/xampp/htdocs/Julet/Shared/Images/cover33.png", "Barry B. Benson, a bee just graduated from college, is disillusioned at his lone career choice: making honey. On a special trip outside the hive, Barry's life is saved by Vanessa, a florist."),
(35, "C:/xampp/htdocs/Julet/Shared/Images/cover34.png", "A deformed bell-ringer must assert his independence from a vicious government minister in order to help his friend, a gypsy dancer."),
(36, "C:/xampp/htdocs/Julet/Shared/Images/cover35.png", "A mountain climber becomes trapped under a boulder while canyoneering alone near Moab, Utah and resorts to desperate measures in order to survive."),
(37, "C:/xampp/htdocs/Julet/Shared/Images/cover36.png", "Star race car Lightning McQueen and his pal Mater head overseas to compete in the World Grand Prix race. But the road to the championship becomes rocky as Mater gets caught up in an intriguing adventure of his own: international espionage."),
(38, "C:/xampp/htdocs/Julet/Shared/Images/cover37.png","A middle-aged Chinese immigrant is swept up into an insane adventure in which she alone can save existence by exploring other universes and connecting with the lives she could have led."),
(39, "C:/xampp/htdocs/Julet/Shared/Images/cover38.png", "Violence ensues after an extraterrestrial race forced to live in slum-like conditions on Earth finds a kindred spirit in a government agent exposed to their biotechnology."),
(40, "C:/xampp/htdocs/Julet/Shared/Images/cover39.png", "In 1936, archaeologist and adventurer Indiana Jones is hired by the U.S. government to find the Ark of the Covenant before the Nazis can obtain its awesome powers."),
(41, "C:/xampp/htdocs/Julet/Shared/Images/cover40.png", "Born on the original Christmas in the stable next door to Jesus Christ, Brian of Nazareth spends his life being mistaken for a messiah."),
(42, "C:/xampp/htdocs/Julet/Shared/Images/cover41.png", "A young man inadvertently breaks three important rules concerning his new pet and unleashes a horde of malevolently mischievous monsters on a small town."),
(43, "C:/xampp/htdocs/Julet/Shared/Images/cover41.png", "A live-action prequel feature film following a young Cruella de Vil.");

INSERT INTO participated(movieID, participantID)
VALUES (1,1), (1,2), (1,3), (2,1), (2,2), (2,3), (2,4), (3,1), (3,2), (4,1), (4,2), (4,3), (4,6), (5,1), (5,2), (5,3), (5,5), (6,1), (6,2), (6,3), (6,4), (6,5), (7,1), (7,2), (7,3), (7,5),
(8,1), (8,2), (8,3), (8,5), (9,1), (9,2), (9,3), (9,5), (10,1), (10,5), (10,8), (11,1), (11,2), (11,3), (11,5), (12,1), (12,3), (12,4), (12,5), (12,6), (12,7), (13,1), (13,6), (14,1), (14,3), 
(14,5), (15,1), (15,2), (15,3), (15,4), (15,6), (15,7), (16,1), (16,3), (16,4), (16,5), (16,6), (17,1), (17,4), (17,5), (18,1), (18,3), (18,4), (18,5), (19,1), (19,3), (19,5), (20,1), (20,3), 
(20,4), (20,5), (20,6), (21,1), (21,2), (21,3), (21,5), (22,1), (22,3), (22,4), (22,5), (23,1), (23,3), (24,1), (24,3), (24,4), (25,1), (25,3), (25,5), (26,1), (26,3), (26,4), (26,6),
(27, 1), (27, 2), (27, 3), (27, 4), (27, 5), (27, 6), (28, 1), (28, 3), (28, 4), (28, 5), (29, 1), (29, 3), (29, 4), (29, 5), (30, 1), (30, 3), (30, 4), (30, 6), (31, 1), (31, 3), (31, 6), 
(31, 7), (32, 1), (32, 3), (32, 5), (33, 1), (33, 2), (33, 3), (33, 4), (34, 1), (34, 4), (34, 6), (35, 1), (35, 3), (35, 4), (35, 5), (35, 6), (36, 1), (36, 3), (36, 6), (36, 9), (37, 1),
(37, 3), (37, 12), (38, 1), (38, 3), (39, 1), (39, 3), (40, 1), (40, 2), (40, 9), (41, 1), (41, 2), (41, 3), (42, 1), (42, 2), (42, 3), (43, 1), (43, 3), (43, 9);

INSERT INTO marvel_participated(marvelID, marvelparticipantID, marvel_grade)
VALUES(1,2,6), (1,1,4), (1,3,7), (1,6,7), (2,2,8), (2,1,6), (2,3,8), (3,2,7), (3,1,3), (3,3,7), 
(3,6,6), (4,2,5), (4,1,1), (4,3,6), (4,6,7), (5,2,5), (5,1,3), (5,3,4), (6,2,6), (6,1,4), 
(6,3,5), (6,4,7), (7,2,8), (7,1,7), (7,3,8), (7,6,7), (8,2,5), (8,1,4), (8,3,5), (8,7,5),
(9,2,6), (9,1,4), (9,3,7), (10,2,4), (10,1,1), (10,3,4), (10,6,3), (11,2,7), (11,1,4), (11,3,7), 
(11,6,5), (12,2,8), (12,1,7), (12,3,6), (12,6,8), (13,2,5), (13,1,9), (13,3,5), (13,6,4), (14,2,5), 
(14,1,1), (14,3,4), (15,2,5), (15,1,6), (15,3,5), (15,6,4), (16,2,7), (16,1,9), (16,3,9), (16,6,8),
(18,2,2), (18,1,1), (18,3,3), (19,2,8), (19,1,7), (19,3,8), (19,6,7), (20,2,7), (20,1,10), (20,3,9), (20,4,8), 
(21,2,1), (21,1,1), (21,3,1), (21,4,1), (21,6,3), (22,2,10), (22,1,10), (22,3,7), (22,4,9), (22,6,9), (23,2,10),
(23,1,9), (23,3,7), (23,4,9), (23,6,7), (24,2,8), (24,1,7), (24,3,8), (24,4,9), (24,6,6), (24,7,7),
(25,2,9), (25,1,10), (25,3,9), (25,4,8), (25,6,9), (26,2,5), (26,1,2), (26,3,3), (26,4,4), (26,6,4), 
(27,2,3), (27,1,1), (27,3,2), (27,4,5), (27,6,5), (28,2,7), (28,1,9), (28,3,9), (28,4,7), (28,5,9), 
(28,6,9), (29,2,7), (29,1,6), (29,3,4), (29,4,4), (29,5,5),  (29,6,6), (30, 1, 4), (30, 2, 7), (30, 3, 3), (30, 4, 7), (30, 5, 6),
(31, 1, 1), (31, 2, 1), (31, 3, 1), (31, 5, 2), (31, 9, 3), (31, 11, 1), (32, 1, 8), (32, 2, 7), (32, 3, 8), (33, 1, 5), (33, 2, 1), (33, 3, 1), (33, 6, 2),
(34, 1, 9), (34, 2, 6), (34, 3, 7), (35, 1, 10), (35, 2, 8), (35, 3, 7), (35, 11, 10), (36, 1, 6), (36, 2, 4), (36, 3, 5), (36, 4, 7),
(37, 1, 3), (37, 2, 1), (37, 3, 1);

INSERT INTO users(username, email, password)
VALUES ('user', 'a20micro@student.his.se', 'password'), ('admin', 'miro96@gmail.com', ''),
('micke', 'a20micro@student.his.se', 'password'), ('gabbe', 'gabbemail@gmail.com', 'password'),
('crippe', 'crippemail@gmail.com', 'password'), ('behrad', 'behradmail@gmail.com', 'password'),
('linus', 'linusmail@gmail.com', 'password'), ('momme', 'mommemail@gmail.com', 'password'), ('doffe', 'doffemail@gmail.com', 'password');

INSERT INTO solo_movie(name, user_id, imdb_rating, grade)
VALUES ('Les Misérables', 3, 7.5, 8), ('Les Misérables', 5, 7.5, 0), ('The Prestige', 3, 8.5, 10), ('The Prestige', 5, 8.5, 0), ('Encanto', 3, 7.2, 9),
('Spider-Man: Into the Spider-Verse', 3, 8.4, 9), ('Spider-Man: Across the Spider-Verse', 3, 8.9, 9), ('The Iron Giant', 3, 8.1, 7), ('Moana', 3, 7.6, 6),
('Frozen', 3, 7.4, 9), ('Inside Out', 3, 8.1, 9), ('The Little Mermaid', 3, 7.2,  8), ("The Little Mermaid", 4, 7.2, 6),
("Prince of Egypt", 3, 7.2, 7), ("Prince of Egypt", 4, 7.2, 10), ("How To Train Your Dragon", 3, 8.1, 8), ("How To Train Your Dragon", 4, 8.1, "8"), 
("Elemental", 3, 7, 9), ("Elemental", 4, 7, 7), ("Elemental", 9, 7, 8);

INSERT INTO activity_log(username, action, timestamp, data)
VALUES("user", "pageview", '2019-12-19 17:07:06', '{"page_ulr":"install.php","ip_address":"127.0.0.1 (TEMP DATA)"}');

CREATE VIEW marvel_movies AS
	SELECT m.marvelID as 'id', varMar.name as 'name',  varMar.imdb_rating ,ROUND(AVG(marvel_grade),2) AS 'rating', GROUP_CONCAT(p.name SEPARATOR ' ') AS 'participants'
	FROM marvel_participated m
    JOIN marvel varMar ON m.marvelID = varMar.id
    JOIN participant p ON p.id = m.marvelparticipantID
GROUP BY m.marvelID;

CREATE VIEW movie_participants AS
	SELECT m.id as 'id', m.name as 'name', m.genre_name as 'genre', m.imdb_rating as 'rating', m.jayornay as 'grade', m.picked_by as 'picker',
	GROUP_CONCAT(p.name SEPARATOR ' ') AS 'participants', m.is_major, moviedescription.description, moviedescription.cover_path
	FROM movie m
	JOIN participated part
    ON part.movieID = m.id
	JOIN participant p 
    ON p.id = part.participantID
  JOIN movieDescription 
    ON moviedescription.movieID = m.id
GROUP BY m.id;

CREATE VIEW solo_movies AS
	SELECT m.id as 'id', m.name as 'name', m.imdb_rating as 'grade', m.grade as 'rating', u.username as 'username'
    FROM solo_movie m
    JOIN users u 
    ON m.user_id = u.user_id;
    
SELECT * FROM movie_participants where name = 'Gremlins';