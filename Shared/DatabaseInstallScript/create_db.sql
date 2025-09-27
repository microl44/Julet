DROP DATABASE IF EXISTS Jul;
CREATE DATABASE jul
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
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

CREATE TABLE participated(
movieID int,
participantID int,
PRIMARY KEY (movieID, participantID),
FOREIGN KEY (participantID) REFERENCES participant(id),
FOREIGN KEY (movieID) REFERENCES movie(id)
) ENGINE = InnoDB;

CREATE TABLE IMDBMovie(
id varchar(2048),
name varchar(2048)
) Engine = InnoDB;

CREATE TABLE movie_club(
id INT auto_increment,
club_owner INT NOT NULL,
club_name VARCHAR(255) NOT NULL,
club_description longtext,
club_creation_date datetime default current_timestamp,
PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE movie_club_role(
id int auto_increment NOT NULL,
role_name varchar(255) NOT NULL,
PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE club_member(
club_id INT NOT NULL,
user_id INT NOT NULL,
club_role INT DEFAULT 4,
user_joined datetime default current_timestamp,
FOREIGN KEY (club_id) REFERENCES movie_club(id),
FOREIGN KEY (user_id) REFERENCES users (id),
PRIMARY KEY (club_id, user_id)
) ENGINE = InnoDB;

CREATE TABLE movie_club_deadline(
club_id INT NOT NULL,
movie_id INT NOT NULL,
creator_id INT NOT NULL,
deadline datetime NOT NULL,
deadline_comment varchar(2048) NOT NULL,
notification_time INT default 24,
change_role_req INT default 0,
FOREIGN KEY (club_id) REFERENCES movie_club(id),
FOREIGN KEY (movie_id) REFERENCES movie(id),
FOREIGN KEY (change_role_req) REFERENCES movie_club_role(id),
FOREIGN KEY (creator_id) REFERENCES club_member(user_id),
PRIMARY KEY (club_id, movie_id, creator_id, deadline)
) ENGINE = InnoDB;

CREATE TABLE club_member_seen(
club_member_id INT NOT NULL,
club_id INT NOT NULL,
movie_id INT NOT NULL,
viewdate datetime default current_timestamp,
rating int(2) NOT NULL,
user_comment longtext,
FOREIGN KEY (club_member_id) REFERENCES club_member(user_id),
FOREIGN KEY (club_id) REFERENCES club_member(club_id),
FOREIGN KEY (movie_id) REFERENCES movie(id),
PRIMARY KEY (club_member_id, club_id, movie_id)
) ENGINE = InnoDB;

CREATE TABLE rule(
id INT AUTO_INCREMENT,
rule_name varchar(255) NOT NULL,
rule_description longtext NOT NULL,
PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE activity_log (
id int AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
action VARCHAR(255) NOT NULL,
`timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
data JSON NOT NULL
) ENGINE = InnoDB;

ALTER DATABASE jul CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE movie CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;