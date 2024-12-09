import os
import sys
import time
import random
import string
import requests
from checklib import *
from bs4 import BeautifulSoup


class ForcADChecker:
    def __init__(self, host):
        self.host = host
        self.session = requests.Session()

    @staticmethod
    def generate_random_string(length):
        return ''.join(random.choice(string.ascii_letters + string.digits) for _ in range(length))

    def login(self, username, password):
        try:
            login_url = f"http://{self.host}/login.php"
            payload = {
                "username": username,
                "password": password
            }
            response = self.session.post(login_url, data=payload)
            response.raise_for_status()
            return response
        except Exception as e:
            print(f"Login error: {e}")
            exit(Status.MUMBLE)

    def logout(self):
        logout_url = f"http://{self.host}/logout.php"
        self.session.get(logout_url)

    def register(self, username, password):
        try:
            register_url = f"http://{self.host}/registry.php"
            payload = {
                "username": username,
                "password": password
            }
            response = self.session.post(register_url, data=payload)
            response.raise_for_status()
            return response
        except Exception as e:
            print(f"Registration error: {e}")
            exit(Status.MUMBLE)

    def create_flag(self, body):
        try:
            index_url = f"http://{self.host}/index.php"
            response = self.session.get(index_url)
            response.raise_for_status()

            title = "flag"
            # body = self.generate_random_string(32)

            title_input = {"title": title, "result": body}
            response = self.session.post(index_url, data=title_input)
            response.raise_for_status()

            self.logout()
            return body
        except Exception as e:
            print(f"Create flag error: {e}")
            exit(Status.MUMBLE)

    def check_for_flag(self, username, password, flag):
        self.login(username, password)
        reports_url = f"http://{self.host}/reports.php"
        response = self.session.get(reports_url)
        try:
            response.raise_for_status()
        except:
            exit(Status.CORRUPT)
        soup = BeautifulSoup(response.text, 'html.parser')
        rows = soup.find_all('tr')
        

        for row in rows:
            cells = row.find_all('td')
            
            if len(cells) > 2 and "flag" in cells[1].text and flag == cells[2].text:
                self.logout()
                return True
        self.logout()
        return False

    def delete(self):
        delete_url = f"http://{self.host}/delete.php"
        self.session.get(delete_url)

    def walk(self):
        endpoints = ["index.php", "reports.php", "messages.php", "admin.php", "reader.php", "delete.php"]
        for end in endpoints:
            try:
                url = f"http://{self.host}/{end}"
                self.session.get(url)
            except Exception as e:
                print(f"Error accessing {end}: {e}")
                exit(103)

    def check(self):
        username = "check_" + self.generate_random_string(5)
        password = self.generate_random_string(10)

        self.register(username, password)
        self.login(username, password)
        self.walk()

    def put(self, flag_id, flag, vuln_number):
        seed = self.generate_random_string(36)
        random.seed(seed)

        username = self.generate_random_string(12)
        random.seed(seed + username)
        password = self.generate_random_string(12)

        self.register(username, password)
        self.login(username, password)
        flag = self.create_flag(flag)
            
        print(username, password, seed, flag, file=sys.stderr)
        print(username)

    def get(self, flag_id, flag, vuln_number):
        random.seed(flag_id)

        username = self.generate_random_string(12)
        random.seed(flag_id + username)
        password = self.generate_random_string(12)
        print(username, password)

        # random.seed(flag_id + username + password)
        # flag = self.generate_random_string(32)
        
        if not self.check_for_flag(username, password, flag):
            exit(Status.CORRUPT)


def main():
    mode = sys.argv[1]
    host = sys.argv[2]
    checker = ForcADChecker(host)

    if mode == "check":
        checker.check()
    elif mode == "put":
        flag_id = sys.argv[3]
        flag = sys.argv[4]
        vuln_number = sys.argv[5]
        checker.put(flag_id, flag, vuln_number)
    elif mode == "get":
        flag_id = sys.argv[3]
        flag = sys.argv[4]
        vuln_number = sys.argv[5]
        checker.get(flag_id, flag, vuln_number)


if __name__ == "__main__":
    main()
    exit(Status.OK)
