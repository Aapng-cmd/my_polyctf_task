package main

import (
    "database/sql" // For database operations
    "encoding/base64" // For encoding session IDs
    "net/http" // For HTTP server and client
    "sync" // For synchronization
    "crypto/rand" // For generating random session IDs
    "fmt"
    "html/template"
    "log" // For logging errors
    _ "github.com/mattn/go-sqlite3" // Import SQLite driver
)

var (
    sessionStore = make(map[string]string) // Maps session ID to username
    mu           sync.Mutex                 // Mutex to protect access to sessionStore
)


// Generate a random session ID
func generateSessionID() (string, error) {
    b := make([]byte, 32)
    _, err := rand.Read(b)
    if err != nil {
        return "", err
    }
    return base64.URLEncoding.EncodeToString(b), nil
}

var db *sql.DB

func main() {
    var err error
    db, err = sql.Open("sqlite3", "./users.db")
    if err != nil {
        log.Fatal(err)
    }
    defer db.Close()

    // Serve static files from the "static" directory
    fs := http.FileServer(http.Dir("static"))
    http.Handle("/static/", http.StripPrefix("/static/", fs))

    // Serve index.html by default
    http.HandleFunc("/", serveIndex)

    // Serve login.html at /login
    http.HandleFunc("/login", serveLogin)
    http.HandleFunc("/login/submit", handleLogin)
    
    http.HandleFunc("/register", serveRegister)
    http.HandleFunc("/register/submit", handleRegister)    
    
    http.HandleFunc("/home", serveHomeNull)
    http.HandleFunc("/home/submit", serveHome)
    

    log.Println("Server started at :80")
    http.ListenAndServe(":80", nil)
}

func serveIndex(w http.ResponseWriter, r *http.Request) {
    http.ServeFile(w, r, "static/index.html")
}

func serveLogin(w http.ResponseWriter, r *http.Request) {
    http.ServeFile(w, r, "static/login.html")
}

func serveRegister(w http.ResponseWriter, r *http.Request) {
    http.ServeFile(w, r, "static/register.html")
}


func handleRegister(w http.ResponseWriter, r *http.Request) {
    if r.Method == http.MethodPost {
        username := r.FormValue("username")
        password := r.FormValue("password")
        // Insert the new user into the database
        _, err := db.Exec("INSERT INTO users (username, password) VALUES (?, ?)", username, password)
        if err != nil {
            http.Error(w, "User already exists", http.StatusConflict)
            return
        }

        http.Redirect(w, r, "/login", http.StatusSeeOther)
    } else {
        http.ServeFile(w, r, "static/register.html")
    }
}

func handleLogin(w http.ResponseWriter, r *http.Request) {
    if r.Method == http.MethodPost {
        username := r.FormValue("username")
        password := r.FormValue("password")

        // Check if the user exists in the database
        var storedPassword string
        err := db.QueryRow("SELECT password FROM users WHERE username = ?", username).Scan(&storedPassword)
        if err != nil {
            if err == sql.ErrNoRows {
                w.Header().Set("Content-Type", "text/html; charset=utf-8")
                http.Error(w, "Неверное имя пользователя или пароль", http.StatusUnauthorized)
                return
            }
            w.Header().Set("Content-Type", "text/html; charset=utf-8")
            fmt.Fprintf(w, "Ошибка: %s", err)
            http.Error(w, "Ошибка при проверке пользователя", http.StatusInternalServerError)
            return
        }

        // Check if the password matches
        if storedPassword != password {
            http.Error(w, "Неверное имя пользователя или пароль", http.StatusUnauthorized)
            return
        }

        // Successful login
        // fmt.Fprintf(w, "Добро пожаловать, %s!", username)
        sessionID, err := generateSessionID()
        if err != nil {
            http.Error(w, "Ошибка при создании сессии", http.StatusInternalServerError)
            return
        }
        // Store the session ID and associated username
        mu.Lock()
        sessionStore[sessionID] = username
        mu.Unlock()

        // Set a cookie with the session ID
        http.SetCookie(w, &http.Cookie{
            Name:  "session_id",
            Value: sessionID,
            Path:  "/",
            MaxAge: 3600,
        })
        
        http.Redirect(w, r, "/home", http.StatusSeeOther)
    } else {
        http.Error(w, "Метод не поддерживается", http.StatusMethodNotAllowed)
    }

}

type Book struct {
    Price int
}

type HomePageData struct {
    Username string
}

func serveHomeNull(w http.ResponseWriter, r *http.Request) {
    cookie, err := r.Cookie("session_id")
    if err != nil {
        http.Redirect(w, r, "/login", http.StatusSeeOther)
        return
    }

    mu.Lock()
    username, loginOk := sessionStore[cookie.Value]
    mu.Unlock()
    
    if !loginOk || username != "admin" {
        var user HomePageData;
        user.Username = username;
        tmpl, err := template.ParseFiles("static/user_home.html")
        err = tmpl.Execute(w, user)
        if err != nil {
            w.Header().Set("Content-Type", "text/html; charset=utf-8")
            http.Error(w, "Ошибка при загрузке шаблона", http.StatusInternalServerError)
            return
        }
        
        return
    }
    
    tmpl, err := template.ParseFiles("static/home.html")
    if err != nil {
        w.Header().Set("Content-Type", "text/html; charset=utf-8")
        http.Error(w, "Ошибка при загрузке шаблона", http.StatusInternalServerError)
        return
    }
    
    w.Header().Set("Content-Type", "text/html; charset=utf-8")
    err = tmpl.Execute(w, []Book{})
    if err != nil {
        w.Header().Set("Content-Type", "text/html; charset=utf-8")
        http.Error(w, "Ошибка при выводе шаблона", http.StatusInternalServerError)
        return
    }
}

func serveHome(w http.ResponseWriter, r *http.Request) {
    // Check for user authentication at the end
    cookie, err := r.Cookie("session_id")
    if err != nil {
        http.Redirect(w, r, "/login", http.StatusSeeOther)
        return
    }

    mu.Lock()
    _, loginOk := sessionStore[cookie.Value]
    mu.Unlock()

    var books []Book
    params := r.URL.Query()
    var firstParam string

    for key := range params {
        firstParam = key
        break
    }

    query := fmt.Sprintf("SELECT price FROM books WHERE %s = ?", firstParam)

    if r.Method == http.MethodGet {
        rows, err := db.Query(query, params.Get(firstParam))
        if err != nil {
            w.Header().Set("Content-Type", "text/html; charset=utf-8")
            http.Error(w, "Ошибка при обращении к бд", http.StatusInternalServerError)
            return
        }
        defer rows.Close()

        for rows.Next() {
            var book Book
            if err := rows.Scan(&book.Price); err != nil {
                w.Header().Set("Content-Type", "text/html; charset=utf-8")
                http.Error(w, "Ошибка при обработке результатов", http.StatusInternalServerError)
                return
            }
            book.Price *= 100;
            books = append(books, book)
        }

        if err := rows.Err(); err != nil {
            w.Header().Set("Content-Type", "text/html; charset=utf-8")
            http.Error(w, "Ошибка при обработке результатов", http.StatusInternalServerError)
            return
        }
    }

    tmpl, err := template.ParseFiles("static/home.html")
    if err != nil {
        w.Header().Set("Content-Type", "text/html; charset=utf-8")
        http.Error(w, "Ошибка при загрузке шаблона", http.StatusInternalServerError)
        return
    }

    if !loginOk {
        http.Redirect(w, r, "/login", http.StatusSeeOther)
    }

    w.Header().Set("Content-Type", "text/html; charset=utf-8")
    err = tmpl.Execute(w, books)
    if err != nil {
        w.Header().Set("Content-Type", "text/html; charset=utf-8")
        http.Error(w, "Ошибка при выводе шаблона", http.StatusInternalServerError)
        return
    }
    
}
