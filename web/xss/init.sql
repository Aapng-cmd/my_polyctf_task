DROP DATABASE IF EXISTS games;
-- Create the database
CREATE DATABASE games;

-- Use the database
USE games;

CREATE TABLE game_data (
    player_id VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255),
    games_played INT DEFAULT 0
);

CREATE TABLE game_ids (
    game_id VARCHAR(255) PRIMARY KEY,
    player_id VARCHAR(255),
    score FLOAT,
    level INT,
    completion_time INT UNSIGNED,
    FOREIGN KEY (player_id) REFERENCES game_data(player_id)
);

DROP USER IF EXISTS 'game_user'@'%';
-- Create the user
CREATE USER 'game_user'@'%' IDENTIFIED BY 'Giraffe#LemonTree88!';

-- Grant privileges to the user
GRANT SELECT, INSERT, UPDATE, DELETE ON games.* TO 'game_user'@'%';
FLUSH PRIVILEGES;

-- LemonTree#Giraffe00!
INSERT INTO games.game_data(player_id, password, games_played) VALUES ('admin', '$2y$10$OoDBSyfPv.qDo4QwEldXU.ZpbNUnKHR4FtjnDChGRCa10ftABiRJO', 0);
