import random
import string
import time

CHARACTERS = string.ascii_letters + string.digits
CHAR_LEN = len(CHARACTERS)
HASH_SIZE = 4 * 8

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


def hashing(arr):
    HASH = []
    for i in range(1, len(arr)):
        index = (sum_of_string(arr[i - 1]) + sum_of_string(arr[i])) % CHAR_LEN
        HASH.append(CHARACTERS[index])
    return ''.join(HASH)

def hash_string(s):
    return hashing(create_segm_arr(normal_string(s)))

def generate_random_string(length):
    return ''.join(random.choice(string.ascii_letters + string.digits) for _ in range(length))

def generate_specific_string(itteration):
    CHARACTERS = string.ascii_letters + string.digits
    base = len(CHARACTERS)
    if itteration == 0:
        return CHARACTERS[0]  # Handle the case for 0
    result = []
    while itteration > 0:
        remainder = itteration % base
        result.append(CHARACTERS[remainder])  # Get the character for the remainder
        itteration //= base

    result.reverse()  # Reverse the result to get the correct order
    return ''.join(result)

