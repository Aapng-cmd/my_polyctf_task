#!/usr/bin/env python3

import re
from collections import Counter
import mimetypes
import os
import json


def most_frequent_word(file_name):
    """
    Reads a text file and returns the most frequent word.

    Args:
        file_name (str): The name of the text file.

    Returns:
        tuple: A tuple containing the most frequent word and its frequency.
    """
    try:
        mime_type = mimetypes.guess_type(file_name)[0]
        if mime_type is None or not mime_type.startswith('text/'):
            os.remove(file_name)  # Delete the file
            return None
        with open(file_name, 'r') as file:
            text = file.read()
            words = re.findall(r"[\w{}]+", text)
            word_freq = Counter(words)
            most_common = word_freq.most_common(1)
            os.remove(file_name)  # Delete the file
            return most_common[0]
        
    except FileNotFoundError:
        # print(f"File '{file_name}' not found.")
        return None


def main():
    data = []
    for file_name in os.listdir("/var/www/html/uploads"):
        result = most_frequent_word("/var/www/html/uploads/" + file_name)
        if result:
            word, freq = result
            data.append({'file_name': file_name, 'word': word, 'frequency': freq})
    with open("/var/www/data.json", "w") as f:
        json.dump(data, f, indent=4)

if __name__ == "__main__":
    main()
