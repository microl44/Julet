use jul;

DROP VIEW IF EXISTS marvel_participants;
CREATE VIEW marvel_participants AS
	SELECT
		marvel_movie.id as 'id', 
        participant.id as 'participant id',
        participant.name as 'participant', 
        marvel_participated.user_rating as 'user rating',
        movie.imdb_rating as 'imdb rating',
        movie.name as 'movie', 
        movie.description,
        movie.cover_path as 'cover path'
	FROM
		marvel_participated
	JOIN
		marvel_movie ON marvel_participated.marvel_movie_entry_id = marvel_movie.id
	JOIN
		movie ON marvel_movie.movie_id = movie.id
	JOIN 
		participant ON participant.id = marvel_participated.user_id
	ORDER BY marvel_movie.id ASC, participant.id ASC;

        
DROP VIEW IF EXISTS solo_movie_participants;
CREATE VIEW solo_movie_participants AS
	SELECT
		solo_movie.id as 'id', 
        participant.id as 'participant id',
        participant.name as 'participant', 
        solo_movie.user_rating as 'user rating',
        movie.imdb_rating as 'imdb rating',
        movie.name as 'movie', 
        movie.id as 'movie id',
        movie.description,
        movie.cover_path as 'cover path'
	FROM
		solo_movie
	JOIN
		movie ON solo_movie.movie_id = movie.id
	JOIN 
		participant ON participant.id = solo_movie.user_id
	ORDER BY solo_movie.id ASC, participant.id DESC;

DROP VIEW IF EXISTS group_movie_participants;
CREATE VIEW group_movie_participants AS
	SELECT
		group_movie.id as 'id', 
        participant.id as 'participant id',
        participant.name as 'participant', 
        group_movie.genre_name as 'genre',
        group_movie.picked_by as 'picked by',
        movie.name as 'movie', 
		movie.imdb_rating as 'imdb rating',
        movie.description,
        group_movie.jayornay as 'Jay or Nay',
        group_movie.is_major as 'is mayor',
        movie.cover_path as 'cover path'
	FROM
		group_movie
	JOIN
		participated ON participated.movieID = group_movie.movie_id
	JOIN
		movie ON group_movie.movie_id = movie.id
	JOIN 
		participant ON participant.id = participated.participantID
	ORDER BY
		group_movie.id ASC, participant.id desc;