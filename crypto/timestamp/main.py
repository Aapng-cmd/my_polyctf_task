#!/usr/bin/env python3

import random
import hashlib


def check_flag(tr, password):
    for i in range(10):
        __ = password[i]
        ___ = tr[i]
        for _ in range(10000):
            __ = hashlib.sha256(__.encode()).hexdigest()
            ___ = hashlib.sha256(___.encode()).hexdigest()
        
            if __ != ___:
                # print(password[i], tr[i], __, ___)
                return 0
    
    return 1

def generate_random_string(length):
    return ''.join(str(random.choice([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10])) for _ in range(length))


FLAG = "flag_plug"
def bitw(st, shift):
    ans = ""
    shift = int(shift) % 8
    for el in st:
        el = format(ord(el), '08b')
        l = el[-shift:] + el[:-shift]
        # print(el, l, l[shift:] + l[:shift])
        
        ans += chr(int(l, 2))
        
    return ans


password = generate_random_string(10)
# print(password)
T_FLAG = ""
k = 0
for i in range(0, len(FLAG), len(FLAG) // 10):
    T_FLAG += bitw(FLAG[i:i+3], password[k])
    k += 1

# print(T_FLAG)

print("Попробуй угадать пароль. Даю сто попыток.")
for i in range(100):
    tr = input(f"{i} / 100\n")[:10]
    b = check_flag(tr, password)
    if b:
        print("А ты хорош! Держи флаг: ", T_FLAG, "(только шифтануть его не забудь)")
        break
    else:
        print("Мимо")
