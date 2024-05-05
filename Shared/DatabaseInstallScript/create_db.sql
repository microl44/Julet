DROP DATABASE IF EXISTS Jul;
CREATE DATABASE IF NOT EXISTS Jul;
USE Jul;

#---------------CREATE TABLES---------------#
CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id)
) Engine = InnoDB;
CREATE INDEX username ON users(username);

CREATE TABLE participant(
id int auto_increment,
name varchar(255),
PRIMARY KEY (id)
) Engine = InnoDB;
CREATE INDEX participant_name_index ON participant(name);

CREATE TABLE genre(
name varchar(255) NOT NULL,
PRIMARY KEY (name)
) engine = InnoDB;

CREATE TABLE movie(
id int auto_increment, 
name varchar(255) NOT NULL, 
imdb_rating float NOT NULL,
cover_path varchar(255) NOT NULL,
description TEXT NOT NULL,
PRIMARY KEY (id)
)ENGINE = InnoDB;

CREATE TABLE genre_movie(
genre_name varchar(255) NOT NULL,
movie_id int NOT NULL,
PRIMARY KEY (genre_name, movie_id),
FOREIGN KEY (genre_name) REFERENCES genre(name),
FOREIGN KEY (movie_id) REFERENCES movie(id)
)ENGINE = INNODB;

CREATE TABLE solo_movie(
id int auto_increment,
movie_id int NOT NULL,
user_id int NOT NULL,
user_rating int,
FOREIGN KEY (movie_id) REFERENCES movie(id),
FOREIGN KEY (user_id) REFERENCES users(id),
PRIMARY KEY (id)
)ENGINE = INNODB;

CREATE TABLE group_movie(
id int auto_increment,
movie_id int,
genre_name varchar(255),
picked_by int,
jayornay varchar(255),
is_major char(1), 
FOREIGN KEY (movie_id) REFERENCES movie(id),
FOREIGN KEY (picked_by) REFERENCES participant(id),
PRIMARY KEY (id)
)ENGINE = INNODB;

#CREATE TABLE group_movie_participated(
#movie_id int,
#participant_id int,
#jayornay varchar(255),
#winning_genre varchar(255),
#PRIMARY KEY (movie_id, participant_id),
#FOREIGN KEY (participant_id) REFERENCES participant(id),
#FOREIGN KEY (movie_id) REFERENCES group_movie(movie_id),
#FOREIGN KEY (winning_genre) REFERENCES genre(name)
#)ENGINE = INNODB;

CREATE TABLE marvel_movie(
id int auto_increment,
movie_id int,
FOREIGN KEY (movie_id) REFERENCES movie(id),
PRIMARY KEY (id)
)ENGINE = INNODB;

CREATE TABLE marvel_participated(
user_id int NOT NULL,
marvel_movie_entry_id int NOT NULL,
user_rating int NOT NULL,
FOREIGN KEY (user_id) REFERENCES participant(id),
FOREIGN KEY (marvel_movie_entry_id) REFERENCES marvel_movie(id),
PRIMARY KEY (user_id, marvel_movie_entry_id)
)ENGINE = INNODB;

CREATE TABLE IMDBMovie(
id varchar(2048),
name varchar(2048)
) Engine = InnoDB;

CREATE TABLE participated(
movieID int,
participantID int,
PRIMARY KEY (movieID, participantID),
FOREIGN KEY (participantID) REFERENCES participant(id),
FOREIGN KEY (movieID) REFERENCES movie(id)
) ENGINE = InnoDB;

CREATE TABLE activity_log (
id int AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
action VARCHAR(255) NOT NULL,
`timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
data JSON NOT NULL
) ENGINE = InnoDB;