use Jul;

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
	ORDER BY marvel_movie.id ASC, participant.id desc;

        
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

DROP VIEW IF EXISTS club_details;
CREATE VIEW club_details AS
SELECT 
    mc.id AS club_id,
    mc.club_name,
    mc.club_description,
	u.username AS owner_name,
    u.email AS owner_email,
    mc.club_creation_date
FROM 
    movie_club mc
JOIN 
    users u ON mc.club_owner = u.id;
    
DROP VIEW IF EXISTS club_members_roles;
CREATE VIEW club_members_roles AS
SELECT 
    cm.club_id,
    u.id AS user_id,
    u.username AS user_name,
    u.email AS user_email,
    r.role_name,
    cm.user_joined
FROM 
    club_member cm
JOIN 
    users u ON cm.user_id = u.id
JOIN 
    movie_club_role r ON cm.club_role = r.id;
    
DROP VIEW IF EXISTS future_club_deadlines;
CREATE VIEW future_club_deadlines AS
SELECT 
    mcd.club_id,
    mc.club_name,
    mcd.movie_id,
    m.name AS movie_title,
    mcd.deadline,
    mcd.deadline_comment,
    u.username AS creator_name
FROM 
    movie_club_deadline mcd
JOIN 
    movie_club mc ON mcd.club_id = mc.id
JOIN 
    movie m ON mcd.movie_id = m.id
JOIN 
    users u ON mcd.creator_id = u.id
WHERE 
    mcd.deadline > NOW();
    
DROP VIEW IF EXISTS club_member_movie_ratings;
CREATE VIEW club_member_movie_ratings AS
SELECT 
    cms.club_member_id,
    u.username AS member_name,
    cms.club_id,
    mc.club_name,
    cms.movie_id,
    m.name AS movie_title,
    cms.viewdate,
    cms.rating,
    cms.user_comment
FROM 
    club_member_seen cms
JOIN 
    users u ON cms.club_member_id = u.id
JOIN 
    movie_club mc ON cms.club_id = mc.id
JOIN 
    movie m ON cms.movie_id = m.id;
