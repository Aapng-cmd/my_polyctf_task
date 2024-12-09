DROP DATABASE IF EXISTS game_database;
DROP USER IF EXISTS user1;
-- Create database
CREATE DATABASE game_database;

-- Use the database
USE game_database;

-- Create users table
CREATE TABLE users (
  id INT AUTO_INCREMENT,
  username VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  PRIMARY KEY (id)
);

-- Create sessions table
CREATE TABLE sessions (
  user_id INT,
  session_id VARCHAR(255),
  PRIMARY KEY (session_id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create games table
CREATE TABLE games (
  user_id INT,
  last_game INT,
  best_game INT,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(2255) NOT NULL,
    reason TEXT NOT NULL
);

-- Create user
CREATE USER 'user1'@'%' IDENTIFIED BY 'Giraffe#LemonTree88!';

-- Grant privileges to the user
GRANT ALL PRIVILEGES ON game_database.* TO 'user1'@'%';

-- G5#bQ8@vZ3!mK^sD7&xR*1pT$hL9jF6wY2
INSERT INTO game_database.users(username, password) VALUES ('admin', '$2y$10$Zl.x7qXW5lnaJVUdWuJ.lO2pCCIs4kMp80Ydoi35SZ63Gf/ZwApme');

-- a7T$k9z!Qm@2xL^h4Wj&8uV*eR#6pYqZ1
INSERT INTO game_database.users(username, password) VALUES ('tester', '$2y$10$iqMicRl4mi7/DikBluRtMO5RnlRnpG5O98ntT8Toi1z7rvDhVGFk6');

INSERT INTO game_database.sessions(user_id, session_id) VALUES (2, '138ad3683c7e3972593b3c3cc4e148f3df8a36ee19acfb1a7758c7c7a6a48e27');

-- Create a trigger to prevent updates to the password for admin and tester
DELIMITER //

CREATE TRIGGER prevent_password_update
BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
    IF OLD.username IN ('admin', 'tester') THEN
    	SET NEW.username = OLD.username; -- Prevent username change
        SET NEW.password = OLD.password; -- Prevent password change
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE TRIGGER prevent_password_update
BEFORE UPDATE ON sessions
FOR EACH ROW
BEGIN
    IF OLD.user_id IN (2) THEN
    	SET NEW.session_id = OLD.session_id; -- Prevent username change
    END IF;
END //

DELIMITER ;
