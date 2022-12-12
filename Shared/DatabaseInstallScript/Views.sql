use jul;
	select group_concat(participant.name, " ") AS participants from participant, participated WHERE participated.participantID = participant.id AND ;
    
    select participated.participantID from participated GROUP BY participated.movieID;
        
/*CREATE VIEW movies AS
	SELECT 
		movie.id,
        movie.name,
        movie.imdb_rating,
        movie.genre_name,
        movie.picked_by,
        (SELECT GROUP_CONCAT(' ', participant.name) AS participants
        FROM participant INNER JOIN movie ON movie.id = participated.movieID GROUP BY participants.id) 
        AS Temp WHERE participated.participantID = participant.id) AS "Participants",