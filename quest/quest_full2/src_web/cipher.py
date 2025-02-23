import random
import string
import time

CHARACTERS = string.ascii_letters + string.digits
CHAR_LEN = len(CHARACTERS)
HASH_SIZE = 32
MODULUS = 60211648199136739340249792143800321623121589720382646739193941880491213844569703416040845966125697123
#MODULUS = 60211648199136739340249792143800321

def normal_string(s):
    s_size = len(s)
    if s_size == 1:
        s = s + (chr(ord(s) ^ HASH_SIZE))
    if s_size < HASH_SIZE:
        for i in range(s_size, HASH_SIZE):
            s += CHARACTERS[(ord(s[i - s_size]) + ord(s[i - s_size + 1])) % len(CHARACTERS)]
    
    return s

def create_segm_arr(s):
    seg_len = len(s) // HASH_SIZE
    num_not_norm_seg = (len(s) % HASH_SIZE)
    
    segm = []
    for i in range(0, len(s) - (num_not_norm_seg * (seg_len + 1)), seg_len):
        segm.append(s[i:i+seg_len])

    for i in range(len(s) - (num_not_norm_seg * (seg_len + 1)), len(s), seg_len+1):
        segm.append(s[i:i+seg_len+1])
    
    return segm

def sum_of_string(s):
    return sum(map(ord, s))

def cycle_string(s):
    start = ord(s[0])
    for i in range(1, len(s)):
        ord_val = ord(s[i])
        if i % 5 == 0:
            start += ord_val
        elif i % 5 == 1:
            start //= ord_val
        elif i % 5 == 2:
            start -= ord_val
        elif i % 5 == 3:
            start *= ord_val
        elif i % 5 == 4:
            start = -pow(start, ord_val, MODULUS)
    return start

def hashing(arr):
    arr.append(arr[0])
    HASH = []
    prev_cycle = cycle_string(arr[0])
    for i in range(1, len(arr)):
        current_cycle = cycle_string(arr[i])
        if current_cycle < prev_cycle:
            index = pow(sum_of_string("".join(arr[i:])), abs(sum_of_string(arr[i - 1]) << sum_of_string(arr[i])), CHAR_LEN)
        else:
            index = pow(sum_of_string("".join(arr[:i + 1])), abs(sum_of_string(arr[i - 1]) << sum_of_string(arr[i])), CHAR_LEN)
        HASH.append(CHARACTERS[index % CHAR_LEN])
    prev_cycle = current_cycle
    return ''.join(HASH)

def hash_string(s):
    return hashing(create_segm_arr(normal_string(s)))
