DROP DATABASE IF EXISTS tmp1;
CREATE DATABASE tmp1;

USE tmp1;

CREATE TABLE cookies (
  `email` varchar(255) NOT NULL,
  `cookie` varchar(255) NOT NULL,
  PRIMARY KEY (`email`)
);

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255),
  `email` varchar(255) NOT NULL,
  `is_admin` boolean DEFAULT FALSE,
  PRIMARY KEY (`id`)
);

CREATE TABLE prom_ver (
  `word` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
);

CREATE TABLE products (
  `alias` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `count` int NOT NULL,
  `path` varchar(255),
  PRIMARY KEY (`alias`)
);

CREATE TABLE bought (
  `owner` varchar(255),
  `name` varchar(255),
  `count` int
);

DROP USER IF EXISTS 'newuser'@'%';

CREATE USER 'newuser'@'%' IDENTIFIED BY 'p4$$w0rd!_!';
GRANT ALL PRIVILEGES ON tmp1.* TO 'newuser'@'%';
FLUSH PRIVILEGES;

# HolY_c0W_it is!
INSERT INTO user (name, password, email, is_admin) VALUES ('holy_cow', '$2y$10$HVct9N1f4ttkxNRWYSa38eNzflBjQ7Na6DHSH.Ab7yfGv4ZufZxAO', 'holy_cow@all.year', TRUE);
