#!/usr/bin/python3
from flask import Flask, render_template, request, redirect, url_for, session
import pymysql
from cipher import hash_string
import requests, subprocess
import jsonify

app = Flask(__name__)
app.secret_key = 'UYuwMcMMC201hI1vJtFfIVXCsEcEgMIJa8pNBHQ4Kw9Bum74oOpoOkwIB6jsZPSQO'

db_config = {
    'host': 'mysql',
    'user': 'user1',
    'password': 'q1cKsndvk8JipwiDqlsmlq4KNfmJOTVGD5JHMKNMRWgOwVONdQKGwKmoU2JiKzwoT',
    'database': 'full_database'
}

# Connect to the database
def get_db_connection():
    connection = pymysql.connect(**db_config)
    return connection

@app.route('/')
def home():
    return render_template('home.html', name=session.get('username'))

@app.route('/admin', methods=['GET', 'POST'])
def admin():
    if session.get('username', False) == 'admin':
        if request.method == 'POST':
            command = request.form['command']
            if command:
                return render_template('admin.html', message=subprocess.getoutput(command))
            else: return render_template('admin.html')
        else: return render_template('admin.html')
    else:
        return redirect(url_for('home'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = hash_string(request.form['password'])
        print(len(request.form['password']), request.form['password'], password)
        connection = get_db_connection()
        cursor = connection.cursor()

        # Replace with your actual query
        cursor.execute("SELECT * FROM users WHERE username=%s AND password=%s", (username, password))
        user = cursor.fetchone()
        cursor.close()
        connection.close()

        if user:
            session['username'] = username
            return redirect(url_for('home'))
        else:
            return "Invalid credentials! Please try again.", 401

    return render_template('login.html')

@app.route('/logout')
def logout():
    session.pop('username', None)
    return redirect(url_for('home'))

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        password = hash_string(request.form['password'])
        connection = get_db_connection()
        cursor = connection.cursor()

        # Insert new user into the database
        cursor.execute("INSERT INTO users (username, password) VALUES (%s, %s)", (username, password))
        connection.commit()
        cursor.close()
        connection.close()

        return redirect(url_for('login'))

    return render_template('register.html')

@app.route('/search')

def search():
    query = request.args.get('q')
    if query:
        try:
            response = requests.get('http://flask_app:5001/search', params={'q': query})
            results = response.text
            # Render the search.html template with the results
            return render_template('search.html', results=results)
        except requests.exceptions.RequestException as e:
            return jsonify({"error": str(e)}), 500
    else:
        return jsonify({"error": "No query parameter provided"}), 400


if __name__ == '__main__':
    app.run(host="0.0.0.0", debug=True, port=5000)
