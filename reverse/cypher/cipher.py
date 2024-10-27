FLAG = "PolyCTF{dR4W4F146H3R31fY0Uc4n415057R0N6C1Ph3r}"

def caesar_encode(text, shift):
    encoded_text = ""
    
    for char in text:
        # Check if the character is an uppercase letter
        if char.isupper():
            encoded_text += chr((ord(char) - 65 + shift) % 26 + 65)
        # Check if the character is a lowercase letter
        elif char.islower():
            encoded_text += chr((ord(char) - 97 + shift) % 26 + 97)
        # Check if the character is a digit
        elif char.isdigit():
            # Shift within the range of digits (0-9)
            encoded_text += chr((ord(char) - 48 + shift) % 10 + 48)
        else:
            # Non-alphabetic and non-digit characters remain unchanged
            encoded_text += char
            
    return encoded_text


def encode(string):
    s = string.encode().hex().upper()
    # print(s)
    key = 0
    actions = ['-', "*", "+"]

    ans = ""

    for i, el in enumerate(s):
        key = eval(str(key) + actions[i % len(actions)] + str(ord(el)))
        # print(key)
        ans += caesar_encode(s[i], key)
        
    return ans, key

# works not good
def decode(encoded, key):
    actions = ['+', "//", "-"]
    encoded = encoded[::-1]
    string = ""
    
    for i, el in enumerate(encoded):
        string += caesar_encode(el, -key)
        key = eval(str(key) + actions[(i + len(string) - 1) % len(actions)] + str(ord(string[i])))
        
    return bytes.fromhex(string[::-1]).decode('utf-8')

ans, key = encode(FLAG)
print(ans, key)
# string = decode(ans, key)
# print(string)

def attack(encoded):
    ans = "PolyCTF{"
    alph = "qwertyuiopasdfghjklzxcvbnm{}1234567890QWERTYUIOPASDFGHJKLZXCVBNM"
    encoded = encoded
    actions = ['+', "//", "-"]
    key = 0
    answers = []
    false_positive = {alph[i]: [] for i in range(len(alph))}
    while True:
        for i, el in enumerate(alph):
            if ans + el in false_positive[el]:
                continue
            _, __ = encode(ans + el)
            # print(_, el, ans)
            if _ == encoded[0:2 + len(ans) * 2]:
                ans += el
                # print(ans)
                break
            if i == len(alph) - 1:
                false_positive[ans[-1]].append(ans)
                ans = ans[:-1]
                # print(false_positive)
                # print(ans)
            # print(i / len(alph))
            
        if len(ans) == len(encoded) // 2:
            answers.append(ans)
            false_positive[ans[-1]].append(ans)
            print(answers)
            if ans[-1] == "}":
                break
            ans = ans[:-1]
            
    return answers

print(attack(ans))
