import io
import os
import numpy as np
import re
import requests
import cv2
import vobject

from flask import Flask, render_template, request, redirect, url_for, flash, session
from sqlalchemy.exc import IntegrityError
from werkzeug.security import check_password_hash
from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, SubmitField
from wtforms.validators import InputRequired, Length, EqualTo
from database import db_session, init_db
from models import User
from pyzbar.pyzbar import decode

UPLOAD_FOLDER = '/tmp'
ALLOWED_EXTENSIONS = set([ 'png', 'jpg', 'jpeg'])
app = Flask(__name__)
app.config['SECRET_KEY'] = os.getenv("FLASK_SECRET")

class LoginForm(FlaskForm):
    name = StringField('Username', validators=[InputRequired(), Length(min=4, max=20)])
    password = PasswordField('Password', validators=[InputRequired(), Length(min=6)])
    submit = SubmitField('Login')

class RegistrationForm(FlaskForm):
    name = StringField('Username', validators=[InputRequired(), Length(min=4, max=20)])
    password = PasswordField('Password', validators=[InputRequired(), Length(min=6)])
    confirm_password = PasswordField('Confirm Password', validators=[InputRequired(), EqualTo('password')])
    submit = SubmitField('Register')

def allowed_file(filename):
    return '.' in filename and  filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

@app.errorhandler(404)
def page_not_found(e):
    error_title = "Not Found"
    error_msg = "That page doesn't exist"
    return render_template('error.html',
                           error_title=error_title,error_msg=error_msg), 404

@app.teardown_appcontext
def shutdown_session(exception=None):
    db_session.remove()

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/signup/', methods=['GET', 'POST'])
def signup():
    form = RegistrationForm()
    if form.validate_on_submit():
        error = None
        if not form.name.data:
            error = 'Username is required.'
        elif not form.password.data:
            error = 'Password is required.'
        if error is None:
            try:
                data = request.form
                new_user = User(**data)
                db_session.add(new_user)
                db_session.commit()

                return redirect(url_for('signin'))
            except IntegrityError:
                error = f"User is already registered."

                db_session.rollback()

        flash(error, 'danger')
    return render_template('signup.html', form=form)

@app.route('/signin/', methods=['GET', 'POST'])
def signin():
    form = LoginForm()
    if form.validate_on_submit():
        username = form.name.data
        password = form.password.data
        error = None
        if not username:
            error = 'Username is required.'
        elif not password:
            error = 'Password is required.'
        if error is None:
            user = db_session.query(User).filter(User.name == username).first()
            if user and check_password_hash(user.password, password):
                flash("Login successful!", "success")
                session['username'],session['role'] = username,user.role
                if user.role == 1:
                    return redirect(url_for('admin'))
                else:
                    return redirect(url_for('profile', username=session['username']))
            else:
                flash("Invalid username or password", "danger")
    return render_template('signin.html', form=form)


@app.route("/logout")
def logout():
    session.clear()
    return redirect("/")

@app.get('/user/')
@app.get('/user/<username>')
def profile(username=None):

    if session.get('username') == username:
        return render_template('profile.html', person=username)
    else:
        error_title = "Forbidden"
        error_msg = "Вы кто такие..."
        return render_template('error.html',
                               error_title=error_title, error_msg=error_msg), 403


@app.get('/admin/')
def admin():
    if session.get('role') == 1:
        return render_template('admin.html')
    else:
        error_title = "Forbidden"
        error_msg = "Я вас не звал..."
        return render_template('error.html',
                               error_title=error_title, error_msg=error_msg), 403


@app.post('/admin/qr')
def upload_qr():
    qr_content = None
    contact_info = None
    qr_error = None

    if 'qrfile' not in request.files:
        qr_error = "No file part"
        return render_template('admin.html', qr_error=qr_error)

    file = request.files['qrfile']

    if file.filename == '':
        qr_error = "No selected file"
        return render_template('admin.html', qr_error=qr_error)

    if file and allowed_file(file.filename):
        file_stream = io.BytesIO(file.read())
        image = cv2.imdecode(np.frombuffer(file_stream.getvalue(), np.uint8), cv2.IMREAD_COLOR)

        try:
            decoded_objects = decode(image)

            if decoded_objects and len(decoded_objects) > 0:
                qr_content = decoded_objects[0].data.decode('utf-8')
                if 'BEGIN:VCARD' in qr_content and 'END:VCARD' in qr_content and 'VERSION:' in qr_content:
                    try:
                        response = requests.get(qr_content)
                        if response.status_code == 200:
                            contact_info = response.text
                        else:
                            qr_error = "Unable to fetch the webpage."
                    except:
                        contact_info = parse_vcard(qr_content)
                else:
                    qr_error = "QR code does not contain vCard data(BEGIN:VCARD)."
            else:
                qr_error = "No QR code found in the image"
        except Exception as e:
            qr_error = f"Error decoding QR code: {str(e)}"

    return render_template('admin.html', qr_content=qr_content, contact_info=contact_info, qr_error=qr_error)

def parse_vcard(vcard_text):
    vcard_lines = re.split(r'\\n', vcard_text)
    vcard_text = '\n'.join(line for line in vcard_lines if line.split(':')[1] != '')
    vcard = vobject.readOne(vcard_text)

    contact_info = {
        'full_name': vcard.fn.value if hasattr(vcard, 'fn') else None,
        'telephone': vcard.tel.value if hasattr(vcard, 'tel') else None,
        'email': vcard.email.value if hasattr(vcard, 'email') else None,
        'address': '; '.join(vcard.adr.value) if hasattr(vcard, 'adr') and isinstance(vcard.adr.value, list) else None,
        'organization': vcard.org.value[0] if hasattr(vcard, 'org') and vcard.org else None,
        'title': vcard.title.value if hasattr(vcard, 'title') else None,
        'url': vcard.url.value if hasattr(vcard, 'url') else None,
        'note': vcard.note.value if hasattr(vcard, 'note') else None,
    }

    return contact_info

if __name__ == '__main__':
    init_db()
    app.run(host='0.0.0.0', port=5001)

