from flask import Flask, request, render_template, jsonify
from werkzeug.utils import secure_filename
import os, re
import numpy as np
import matplotlib.pyplot as plt
from scipy.io import wavfile
import cv2
import pytesseract
import easyocr

reader = easyocr.Reader(['en'])

FLAG = "flag_plug"

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = 'uploads/'  # Папка для загрузок
app.config['SPECTROGRAM_FOLDER'] = 'static/spectrograms/'  # Папка для спектрограмм
app.config['MAX_CONTENT_LENGTH'] = 16 * 1024 * 1024  # Ограничение на 16 МБ
ALLOWED_EXTENSIONS = {'wav'}  # Разрешенные расширения

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

def create_spectrogram(file_path):
    sample_rate, data = wavfile.read(file_path)
    
    # Создаем спектрограмму без дополнительных элементов
    plt.figure(figsize=(10, 4))
    plt.specgram(data, Fs=sample_rate, NFFT=1024, noverlap=512, cmap='plasma')

    # Убираем заголовки и оси
    plt.axis('off')  # Отключаем оси
    plt.subplots_adjust(left=0, right=1, top=1, bottom=0)  # Убираем отступы

    # Генерируем имя файла для спектрограммы
    spectrogram_filename = os.path.basename(file_path).replace('.wav', '_spectrogram.png')
    spectrogram_path = os.path.join(app.config['SPECTROGRAM_FOLDER'], spectrogram_filename)

    # Сохраняем спектрограмму
    plt.savefig(spectrogram_path, bbox_inches='tight', pad_inches=0)  # Убираем отступы при сохранении
    plt.close()  # Закрываем фигуру
    return spectrogram_path  # Возвращаем полный путь к файлу

def recognize_text(image_path):
    # Load the image with OpenCV
    img = cv2.imread(image_path)

    # Convert the image to grayscale
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # Apply Gaussian blur to remove noise
    _, binary = cv2.threshold(gray, 202, 255, cv2.THRESH_BINARY)
    # cv2.imwrite("/tmp/a.png", binary)
    # Apply adaptive thresholding to create a binary image
    # text = pytesseract.image_to_string(binary, lang='eng', config=r'--oem 3 --psm 6')

    # Recognize text using pytesseract
    # text = pytesseract.image_to_string(thresh, lang='eng', config='--psm 6')
    
    results = reader.readtext(binary)
    for (bbox, text, prob) in results:
        print(f"Detected text: {text} with confidence: {prob:.2f}")
    
    return text

@app.route('/')
def upload_file():
    return render_template('upload.html')

@app.route('/upload', methods=['POST'])
def upload():
    if 'file' not in request.files:
        return jsonify({"error": "Нет файла для загрузки"}), 400
    file = request.files['file']
    if file.filename == '':
        return jsonify({"error": "Файл не выбран"}), 400
    if file and allowed_file(file.filename):
        filename = secure_filename(file.filename)
        file_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(file_path)

        # Создание спектрограммы
        spectrogram_path = create_spectrogram(file_path)
        return jsonify({"spectrogram": f"/static/spectrograms/{os.path.basename(spectrogram_path)}"}), 200
    
    return jsonify({"error": "Недопустимый тип файла"}), 400

@app.route('/recognize_text', methods=['POST'])
def recognize():
    data = request.json
    spectrogram_path = os.path.join(app.config['SPECTROGRAM_FOLDER'], data['spectrogram'])
    text = recognize_text(spectrogram_path)

	
    return jsonify({"generated_text": text}), 200

if __name__ == '__main__':
    if not os.path.exists(app.config['UPLOAD_FOLDER']):
        os.makedirs(app.config['UPLOAD_FOLDER'])  # Соз даем папку для загрузок
    if not os.path.exists(app.config['SPECTROGRAM_FOLDER']):
        os.makedirs(app.config['SPECTROGRAM_FOLDER'])  # Создаем папку для спектрограмм
    app.run(debug=False)  # Запускаем приложение Flask в режиме отладки отключен
