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
    
    DEALLOCATE PREPARE `stmt`;
    FLUSH PRIVILEGES;
END;