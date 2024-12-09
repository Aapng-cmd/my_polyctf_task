DROP DATABASE IF EXISTS file_database;
DROP USER IF EXISTS user1;
-- Create database
CREATE DATABASE file_database;

-- Use the database
USE file_database;

-- Create users table
CREATE TABLE users (
  id INT AUTO_INCREMENT,
  username VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  PRIMARY KEY (id)
);

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    filepath TEXT NOT NULL
);

-- Create user
CREATE USER 'user1'@'%' IDENTIFIED BY 'Giraffe#LemonTree88!';

-- Grant privileges to the user
GRANT ALL PRIVILEGES ON file_database.* TO 'user1'@'%';

INSERT INTO files(id, username, filepath) VALUES (-1, 'admin', 'uploads/admin/a1B2c3D4e5F6g7H8i9J0kLmNoPqRsTuVwXyZ.png');
INSERT INTO users(username, password) VALUES ('3', 'XEEEL6007L57A1');
