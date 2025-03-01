#!/usr/bin/python3
from flask import Flask, render_template, request, redirect, url_for, render_template_string
import pymysql

app = Flask(__name__)
app.secret_key = 'zpG5gkwFGpRXnhvvJphpxgzQKfmHPlI2rLOxajyfZpakSAikIJNn0xytccUgHho57'

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


@app.route('/search', methods=['GET'])
def search():
    query = request.args.get('q')
    if query:
        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("SELECT id FROM texts WHERE text_find=%s", (query,))
        text_id = cursor.fetchone()
        cursor.close()
        connection.close()
        temp_string = f"Search results for: {query}<br>Text id: {text_id}"
        return render_template_string(temp_string)
    else:
        return render_template_string("<p>No query parameter provided</p>")

if __name__ == '__main__':
    app.run(host="0.0.0.0", debug=True, port=5001)
