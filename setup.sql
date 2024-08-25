CREATE TABLE genre (
    id VARCHAR(255) PRIMARY KEY
);

CREATE TABLE game (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    rating int check( rating between 0 and 10)
);

CREATE TABLE game_genre_rankings (
    game_id INTEGER NOT NULL,
    genre_id varchar(255) NOT NULL,
    PRIMARY KEY (game_id, genre_id),
    FOREIGN KEY (game_id) REFERENCES game(id),
    FOREIGN KEY (genre_id) REFERENCES genre(id)
);

ALTER TABLE genre OWNER TO game_rankings;
ALTER TABLE game OWNER TO game_rankings;
ALTER TABLE game_genre_rankings OWNER TO game_rankings;