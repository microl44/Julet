CREATE PROCEDURE GetParticipationRate(participantName varchar(255))
BEGIN
	SELECT ROUND(((SELECT COUNT(*) FROM movie WHERE movie.participants like CONCAT("%", participantName, "%")) / (SELECT COUNT(*) FROM movie)) * 100) AS "Participation rate";
END ;

CREATE PROCEDURE GetLeastCommonGenre()
BEGIN
	SELECT movie.genre_name, count(movie.genre_name) FROM movie GROUP BY movie.genre_name ORDER BY count(movie.genre_name) ASC LIMIT 1;
END ;

CREATE PROCEDURE GetJayRatio()
BEGIN
	SELECT ((SELECT COUNT(*) FROM movie WHERE movie.jayornay = "Jay") / (SELECT COUNT(*) FROM movie) * 100) AS "Jay Ratio";
END ;

CREATE PROCEDURE GetWinRate(participantName varchar(255))
BEGIN
	SELECT ROUND(((SELECT COUNT(*) FROM movie WHERE movie.picked_by = participantName) / (SELECT COUNT(*) FROM movie WHERE movie.participants LIKE CONCAT('%', participantName, '%'))) * 100) AS "Winrate";
END ;

CREATE PROCEDURE GetWeightedWinRate(IN participantName varchar(255))
BEGIN
	-- Calculate the number of movies where the given participant was picked_by
	SELECT COUNT(*) AS num_movies INTO @num_movies
	FROM movie
	WHERE movie.picked_by = participantName;

	-- Calculate the total number of participants in these movies
	SELECT SUM(LENGTH(participants) - LENGTH(REPLACE(participants, ',', '')) + 1) AS total_participants INTO @total_participants
	FROM movie
	WHERE movie.picked_by = participantName;

	-- Calculate the winrate, taking into account the number of participants in each movie
	SELECT ROUND((@num_movies / @total_participants) * 100) AS "Winrate";
END ;






CREATE PROCEDURE GetPickedMovies(participantName varchar(255))
BEGIN
	SELECT movie.name FROM movie WHERE movie.picked_by = participantName ORDER BY movie.name;
END ;

DROP PROCEDURE IF EXISTS `add_User`;

CREATE PROCEDURE `add_User`(`p_Name` VARCHAR(45),`p_Passw` VARCHAR(200))
BEGIN
    DECLARE `_HOST` CHAR(14) DEFAULT '@\'localhost\'';
    SET `p_Name` := CONCAT('\'', REPLACE(TRIM(`p_Name`), CHAR(39), CONCAT(CHAR(92), CHAR(39))), '\''),
    `p_Passw` := CONCAT('\'', REPLACE(`p_Passw`, CHAR(39), CONCAT(CHAR(92), CHAR(39))), '\'');
    SET @`sql` := CONCAT('CREATE USER ', `p_Name`, `_HOST`, ' IDENTIFIED BY ', `p_Passw`);
    PREPARE `stmt` FROM @`sql`;
    EXECUTE `stmt`;
    SET @`sql` := CONCAT('GRANT SELECT ON jul.* TO ', `p_Name`, `_HOST`);
    PREPARE `stmt` FROM @`sql`;
    EXECUTE `stmt`;
    
    SET @`sql` := CONCAT('GRANT EXECUTE ON jul.* TO ', `p_Name`, `_HOST`);
    PREPARE `stmt` FROM @`sql`;
    EXECUTE `stmt`;

    SET @`sql` := CONCAT('GRANT INSERT ON jul.activity_log TO ', `p_Name`, `_HOST`);
    PREPARE `stmt` FROM @`sql`;
    EXECUTE `stmt`;
    
    DEALLOCATE PREPARE `stmt`;
    FLUSH PRIVILEGES;
END;

CREATE PROCEDURE addParticipants(IN movie_ID INT, IN participants_string VARCHAR(255))
BEGIN
	DECLARE participant_name VARCHAR(255);
	DECLARE temp_string VARCHAR(255);
	DECLARE temp_string_2 VARCHAR(255);
	
	SET temp_string = participants_string;
	
	WHILE temp_string != '' DO
		SET temp_string_2 = SUBSTRING_INDEX(temp_string, ',', 1);
		SET temp_string = REPLACE(temp_string, CONCAT(temp_string_2, ','), '');
		
		SELECT name INTO participant_name FROM participant WHERE name = temp_string_2;
		
		IF participant_name IS NULL THEN
			SELECT name INTO participant_name FROM participant WHERE name = 'UNK';
			IF participant_name IS NOT NULL THEN
				INSERT INTO participated (movieID, participantID)
				VALUES (movie_ID, (SELECT id FROM participant WHERE name = 'UNK'));
			END IF;
		ELSE
			INSERT INTO participated (movieID, participantID)
			VALUES (movie_ID, (SELECT id FROM participant WHERE name = temp_string_2));
		END IF;
	END WHILE;
END;

DROP USER IF EXISTS "user"@"localhost";
DROP USER IF EXISTS "admin"@"localhost";

call add_User("user", "");
call add_User("admin", "password");
call add_User("M", "123");
call add_User("B", "123");
call add_User("L", "123");