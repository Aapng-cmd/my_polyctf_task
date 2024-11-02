import os
import socket
import ipaddress
from flask import Flask, request

app = Flask(__name__)

@app.route('/flag')
def flag():
    if request.remote_addr in socket.gethostbyname('aqrium_main'):
        return "Congratulations! Flag is: " + os.getenv("FLAG")
    else:
        return "Not so easy..."

@app.route('/')
def index():
    return "Go to '/flag' to get flag"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5002)