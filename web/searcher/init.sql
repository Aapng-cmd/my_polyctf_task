DROP DATABASE IF EXISTS images;
-- Create the database
CREATE DATABASE images;

-- Use the database
USE images;

CREATE TABLE images_data (
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    password VARCHAR(255)
);

DROP USER IF EXISTS 'user1'@'%';
-- Create the user
CREATE USER 'user1'@'%' IDENTIFIED BY 'Giraffe#LemonTree88!';

-- Grant privileges to the user
GRANT SELECT, INSERT, UPDATE, DELETE ON images.* TO 'user1'@'%';
FLUSH PRIVILEGES;

-- LemonTree#Giraffe00!
INSERT INTO images.images_data(name, password) VALUES ('admin', '$2y$10$OoDBSyfPv.qDo4QwEldXU.ZpbNUnKHR4FtjnDChGRCa10ftABiRJO');
