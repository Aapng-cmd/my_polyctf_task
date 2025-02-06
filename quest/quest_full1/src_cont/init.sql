DROP DATABASE IF EXISTS file_database;


CREATE DATABASE file_database;

USE file_database;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    created_by VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE,
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

DROP USER IF EXISTS user1;

CREATE USER 'user1'@'%' IDENTIFIED BY 'SVZpcIZV9l8vIv5hrrq81e';

GRANT ALL PRIVILEGES ON file_database.* TO 'user1'@'%';

-- Применение изменений
FLUSH PRIVILEGES;
-- lilo:maries1
INSERT INTO users (username, password) VALUES ('lilo', '$2y$10$KDY7GpIRgaGrBVGaEkMuLO7UNGDlU.7mg8jvInvBsS9sIFozPWdiC');
