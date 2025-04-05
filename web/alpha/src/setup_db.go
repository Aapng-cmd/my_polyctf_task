package main

import (
    "database/sql"
    "log"

    _ "github.com/mattn/go-sqlite3"
)

func main() {
    // Create a new SQLite database file
    db, err := sql.Open("sqlite3", "./users.db")
    if err != nil {
        log.Fatal(err)
    }
    defer db.Close()

    // Create a users table
    sqlStmt := `
    DROP TABLE IF EXISTS users;
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    );
    INSERT INTO users (username, password) VALUES ('admin', 'ErGTCsVNSaSvX9uzCEy93BuGEIDgP9Oi');
    `
    _, err = db.Exec(sqlStmt)
    if err != nil {
        log.Fatalf("%q: %s\n", err, sqlStmt)
        return
    }
    
    sqlStmt = `
    DROP TABLE IF EXISTS books;
    CREATE TABLE IF NOT EXISTS books (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL UNIQUE,
        price INT
    );
    `
    _, err = db.Exec(sqlStmt)
    if err != nil {
        log.Fatalf("%q: %s\n", err, sqlStmt)
        return
    }
    
    sqlStmt = `
    INSERT INTO books (name, price) VALUES ('В поисках утраченного времени', 20);
    INSERT INTO books (name, price) VALUES ('1984', 15);
    INSERT INTO books (name, price) VALUES ('Убить пересмешника', 12);
    INSERT INTO books (name, price) VALUES ('Гордость и предубеждение', 10);
    INSERT INTO books (name, price) VALUES ('Моби Дик', 22);
    INSERT INTO books (name, price) VALUES ('Великий Гэтсби', 14);
    INSERT INTO books (name, price) VALUES ('Одинокий волк', 18);
    INSERT INTO books (name, price) VALUES ('Старик и море', 11);
    INSERT INTO books (name, price) VALUES ('Три товарища', 16);
    INSERT INTO books (name, price) VALUES ('451 градус по Фаренгейту', 13);
    INSERT INTO books (name, price) VALUES ('Маленький принц', 9);
    INSERT INTO books (name, price) VALUES ('Преступление и наказание', 17);
    INSERT INTO books (name, price) VALUES ('Анна Каренина', 20);
    INSERT INTO books (name, price) VALUES ('Братья Карамазовы', 25);
    INSERT INTO books (name, price) VALUES ('Сияние', 14);
    INSERT INTO books (name, price) VALUES ('Дон Кихот', 21);
    INSERT INTO books (name, price) VALUES ('Собачье сердце', 8);
    INSERT INTO books (name, price) VALUES ('Тень ветра', 19);
    INSERT INTO books (name, price) VALUES ('Мастер и Маргарита', 23);
    INSERT INTO books (name, price) VALUES ('Старший сын', 12);
    `
    _, err = db.Exec(sqlStmt)
    if err != nil {
        log.Fatalf("%q: %s\n", err, sqlStmt)
        return
    }
    
    sqlStmt = `
    DROP TABLE IF EXISTS files;
    CREATE TABLE IF NOT EXISTS files (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL UNIQUE,
        file_text TEXT NOT NULL
    );
    INSERT INTO files (name, file_text) VALUES ('You do not need this', 'flag_plug');
    `
    _, err = db.Exec(sqlStmt)
    if err != nil {
        log.Fatalf("%q: %s\n", err, sqlStmt)
        return
    }

    log.Println("Database and users table created successfully.")
}
