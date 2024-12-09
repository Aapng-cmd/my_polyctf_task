DROP DATABASE IF EXISTS report_database;
DROP USER IF EXISTS 'user1';
-- Create database
CREATE DATABASE report_database;

-- Use the database
USE report_database;

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

CREATE TABLE reports (
    id INT AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(255),
    result VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create user
CREATE USER 'user1'@'%' IDENTIFIED BY 'password';

-- Grant privileges to the user
GRANT ALL PRIVILEGES ON report_database.* TO 'user1'@'%';

FLUSH PRIVILEGES;

INSERT INTO report_database.users(username, password) VALUES ('admin', 'bubilgulda');
