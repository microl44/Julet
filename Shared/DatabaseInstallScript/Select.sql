use Jul;

SELECT 
	*
FROM 
	marvel_participated
GROUP BY 
	user_id;

SELECT 
	* 
FROM 
	marvel_participated;
    
SELECT 
	mp.marvel_movie_entry_id as 'id', m.name as 'title', AVG(mp.user_rating)
FROM 
	marvel_participated mp
LEFT JOIN 
	marvel_movie mm ON mm.id = mp.marvel_movie_entry_id
LEFT JOIN 
	movie m ON m.id = mm.movie_id
GROUP BY 
	marvel_movie_entry_id;

SELECT 
	user_id as 'user id', 
    p.name as 'username',
	marvel_movie_entry_id as 'marvel movie id', 
	movie_id as 'movie id', 
	m.name as 'movie name', 
	imdb_rating as 'imdb rating', 
    user_rating as 'user rating'
FROM 
	marvel_participated mp
LEFT JOIN 
	marvel_movie mm ON mm.id = mp.marvel_movie_entry_id
LEFT JOIN 
	movie m ON m.id = mm.movie_id
LEFT JOIN 
	participant p ON p.id = user_id 
ORDER BY 
	marvel_movie_entry_id;
    
SELECT * FROM group_movie_participants;

SELECT * FROM movie;