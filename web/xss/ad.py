import os
import time
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

time.sleep(60 * 3)
# print("booted")

# Set up Chrome options
options = Options()
options.binary_location = "/usr/bin/google-chrome" # Update this path if necessary
options.add_argument("--headless")
options.add_argument("--no-sandbox")
options.add_argument("--disable-gpu")
options.add_argument("--display :99")

# Create a new Chrome session
driver = webdriver.Chrome(options=options)

# Login once
driver.get("http://web:80/login.php")

# Wait for the login form to load
login_form = WebDriverWait(driver, 10).until(
    EC.presence_of_element_located((By.XPATH, "//form[@action='login.php']"))
)

# Enter login credentials
username_input = driver.find_element(By.NAME, "username")
password_input = driver.find_element(By.NAME, "password")

print(username_input)

username_input.send_keys("admin")  # Replace with your username
password_input.send_keys("LemonTree#Giraffe00!")  # Replace with your password

# Submit the login form
login_form.submit()

## Wait for the login to complete
#WebDriverWait(driver, 10).until(
#    EC.title_contains("Dashboard")  # Replace with the expected title after login
#)

print("Logged in successfully!")

# Visit index.php every 60 seconds
while True:
    driver.get("http://web:80/index.php")
    # print("get_req")
    # html_content = driver.page_source
    # print(html_content)
    time.sleep(60)
