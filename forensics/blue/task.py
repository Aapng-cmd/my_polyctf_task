FLAG = "flag_plug"

def caesar_encrypt(text, shift):
    """
    Encrypts a string using the Caesar cipher with a given shift.

    :param text: The string to encrypt
    :param shift: The shift value (integer)
    :return: The encrypted string
    """
    result = ""

    for char in text:
        if char.isalpha():
            ascii_offset = 65 if char.isupper() else 97
            result += chr((ord(char) - ascii_offset + shift) % 26 + ascii_offset)
        else:
            result += char

    return result

enc = ""
for i in range(len(FLAG)):
    enc += str(caesar_encrypt(str(int.from_bytes(bytes(FLAG[i].encode())) ^ i), i ^ i)) + "\ufeff"

with open("\u200c", "w", encoding="utf-8") as f:
    f.write(enc)
