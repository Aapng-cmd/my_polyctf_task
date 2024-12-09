import os
import time
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from bs4 import BeautifulSoup
import requests

time.sleep(60 * 3)
# print("booted")

host = 'web'

# Set up Chrome options
options = Options()
options.binary_location = "/usr/bin/google-chrome" # Update this path if necessary
options.add_argument("--headless")
options.add_argument("--no-sandbox")
options.add_argument("--disable-gpu")
options.add_argument("--display :99")

# Create a new Chrome session
driver = webdriver.Chrome(options=options)

print("initialized")

# Login once
driver.get(f"http://{host}:80/login.php")

# Wait for the login form to load
login_form = WebDriverWait(driver, 10).until(
    EC.presence_of_element_located((By.XPATH, "//form[@action='login.php']"))
)

# Enter login credentials
username_input = driver.find_element(By.NAME, "username")
password_input = driver.find_element(By.NAME, "password")

username_input.send_keys("admin")  # Replace with your username
password_input.send_keys("G5#bQ8@vZ3!mK^sD7&xR*1pT$hL9jF6wY2")  # Replace with your password
# password_input.send_keys("admin")

# Submit the login form
login_form.submit()

print("logged")

## Wait for the login to complete
#WebDriverWait(driver, 10).until(
#    EC.title_contains("Dashboard")  # Replace with the expected title after login
#)

print("Logged in successfully!")

# Visit index.php every 60 seconds
while True:
    driver.get(f"http://{host}:80/admin.php")
    c = {}
    for cookie in driver.get_cookies():
        if cookie['name'] == 'PHPSESSID' or cookie['name'] == 'custom_session_id':
            c[cookie['name']] = (cookie['value'])
    
    # print(c)
    r = requests.post(f"http://{host}:80/admin.php", cookies=c)
    # print(r.text)
    soup = BeautifulSoup(r.text, 'lxml')
    hidden_input = soup.find('input', type='hidden')
    try:
        fir_hid_id = hidden_input.get('value')
        requests.post(f"http://{host}:80/admin.php", cookies=c, data={'delete_report_id': fir_hid_id})
    except AttributeError:
        pass
    time.sleep(5)
    driver.get(f"http://{host}:80/logout.php")

    time.sleep(60)
