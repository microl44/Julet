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

CREATE PROCEDURE GetPickedMovies(participantName varchar(255))
BEGIN
	SELECT movie.name FROM movie WHERE movie.picked_by = participantName ORDER BY movie.name;
END ;