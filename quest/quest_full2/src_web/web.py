from cipher import hash_string
from flask import Flask, render_template, redirect, url_for, flash, request, session
import sqlite3, re, os
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)
app.secret_key = 'XStyynQe6hIKzQNDIR8U'

# Database setup
def init_db():
    conn = sqlite3.connect('database.db')
    cursor = conn.cursor()
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL
        )
    ''')
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS animals (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            animal TEXT NOT NULL,
            path TEXT NOT NULL,
            UNIQUE(animal, path)
        )
    ''')
    conn.commit()
    conn.close()

def init_data():
    conn = sqlite3.connect('database.db')
    cursor = conn.cursor()
    # Define the base directory where animal images are stored
    base_directory = '.'  # Adjust this if your directories are located elsewhere
    animal_directories = ['cats', 'dogs', 'pandas']

    # Insert data into the animals table
    for animal in animal_directories:
        animal_path = os.path.join(base_directory, "static/" + animal)
        if os.path.exists(animal_path):
            # Iterate through all .jpg files in the animal's directory
            for file in os.listdir(animal_path):
                if file.endswith('.jpg'):
                    full_path = os.path.join(animal_path, file)
                    try:
                        cursor.execute('INSERT INTO animals (animal, path) VALUES (?, ?)', (animal, full_path))
                    except sqlite3.IntegrityError:
                        print(f"Path '{full_path}' for animal '{animal}' already exists in the database.")
    # Commit the changes and close the connection
    try:
        cursor.execute("INSERT INTO users (username, password) VALUES (?, ?)", ("stitch", hash_string("solarsystem")))
    except sqlite3.IntegrityError: pass
    conn.commit()
    conn.close()

    return "Data inserted successfully."

# Initialize the database
init_db()
init_data()

# Home route
@app.route('/')
def home():
    if 'username' in session:
        return render_template('home.html', name=session['username'])
    return redirect(url_for('login'))

@app.route('/search', methods=['GET'])
def search():
    if 'username' in session:
        forbidden_patterns = r"[+*{}',;<>()\[\]\/:]"
        animal_name = request.args.get('animal')
        
        if animal_name and re.search(forbidden_patterns, animal_name):
            flash('The animal name contains forbidden characters.', 'danger')
            return redirect(url_for('home'))
        animal_name = animal_name.encode().decode('unicode_escape')
        print(animal_name)
        conn = sqlite3.connect('database.db')
        conn.text_factory = str
        cursor = conn.cursor()
        cursor.execute(f"SELECT path FROM animals WHERE animal = '{animal_name}'")
        paths = cursor.fetchall()
        conn.close()
        error = ""
        print(paths, f"SELECT path FROM animals WHERE animal = '{animal_name}'")
        image_paths = [path[0] for path in paths]  # Extract paths from the tuples
        #print(image_paths, animal_name)

        return render_template('home.html', name=session['username'], paths=paths, image_paths=image_paths, animal_name=animal_name, error=error)
    
    return redirect(url_for('login'))
    

# Register route
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        hashed_password = hash_string(password)

        try:
            conn = sqlite3.connect('database.db')
            cursor = conn.cursor()
            cursor.execute('INSERT INTO users (username, password) VALUES (?, ?)', (username, hashed_password))
            conn.commit()
            conn.close()
            flash('Registration successful! You can now log in.', 'success')
            return redirect(url_for('login'))
        except sqlite3.IntegrityError:
            flash('Username already exists. Please choose a different one.', 'danger')

    return render_template('register.html')

# Login route
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')

        conn = sqlite3.connect('database.db')
        cursor = conn.cursor()
        cursor.execute('SELECT * FROM users WHERE username = ?', (username,))
        user = cursor.fetchone()
        conn.close()

        if user and user[2] == hash_string(password):  # user[2] is the password
            session['username'] = username
            return redirect(url_for('home'))
        else:
            flash('Login failed. Check your username and/or password.', 'danger')

    return render_template('login.html')

# Logout route
@app.route('/logout')
def logout():
    session.pop('username', None)
    return redirect(url_for('login'))

if __name__ == '__main__':
    app.run(host="0.0.0.0", debug=False)
