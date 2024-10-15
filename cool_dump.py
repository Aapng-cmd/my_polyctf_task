#!/usr/bin/python

def leetspeak_converter(text):
    leetspeak_map = {
        'a': '4',
        'b': '8',
        'e': '3',
        'g': '6',
        'i': '1',
        'l': '1',
        'o': '0',
        's': '5',
        't': '7',
        '.': '!'
    }

    leetspeak_text = ''
    for o, char in enumerate(text):
        if char.lower() in leetspeak_map:
            leetspeak_text += leetspeak_map[char.lower()]
        else:
            if i % 2:
                if char.islower():
                    leetspeak_text += char.upper()
                else:
                    leetspeak_text += char.lower()
            else:
                leetspeak_text += char

    return leetspeak_text

# Example usage:
text = input()
leetspeak_text = leetspeak_converter(text)
print(leetspeak_text)

