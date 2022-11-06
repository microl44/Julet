-- CREATE PROCEDURE GetPickedMovies(participantName varchar(255))
-- BEGIN
-- 	SELECT movie.name FROM movie WHERE movie.picked_by = participantName ORDER BY movie.name;
-- END ;

Create VIEW GetPickedMoviesView As SELECT movie.name as "name" , Participant.name as "Pname" FROM movie inner join Participant on movie.picked_by = Participant.Name ORDER BY movie.name;