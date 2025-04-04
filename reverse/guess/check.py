import random
import string

def generate_flag_pattern(FLAG):
    for el in FLAG:
        print("    flag.push(simple_hash(\"" + generate_string_for_hash(el, random.randint(8, 30)) + "\"));")
        #print("    \"" + generate_string_for_hash(el, random.randint(8, 30)) + "\",")


def simple_hash(input_str):
    # Calculate the sum of ASCII values of the characters in the input
    total_sum = sum(ord(c) for c in input_str)
    
    # Map the sum to a value between 0 and 64 (for 'a'-'z', 'A'-'Z', '0'-'9', '{', '_', '}')
    index = total_sum % 68  # 65 characters in the set

    # Convert the index to a corresponding ASCII character
    if 0 <= index <= 25:
        return chr(ord('a') + index)          # 'a' to 'z'
    elif 26 <= index <= 51:
        return chr(ord('A') + (index - 26))   # 'A' to 'Z'
    elif 52 <= index <= 61:
        return chr(ord('0') + (index - 52))   # '0' to '9'
    elif index == 62:
        return '{'                             # '{'
    elif index == 63:
        return '_'                             # '_'
    elif index == 64:
        return '&'
    elif index == 65:
        return '*'
    elif index == 66:
        return '^'
    else:
        return '}'                             # '}'

def generate_string_for_hash(target_char, length):
    if len(target_char) != 1 or target_char not in (string.ascii_letters + string.digits + '{}_&*^'):
        raise ValueError("Target character must be a single alphanumeric character or one of '{', '_', '}', '&*^'.")

    # Create a character set
    characters = string.ascii_lowercase + string.ascii_uppercase + string.digits + '{}_&*^'

    # Generate random strings until we find one that hashes to the target character
    while True:
        random_string = ''.join(random.choice(characters) for _ in range(length))
        if simple_hash(random_string) == target_char:
            return random_string

def brute():
    for i in range(1, 100):
         x = i * 10 + 5
         for c in "L6cAEIyrNgZacq1":
                 x = (((x ^ ord(c)) | 1) * 1) % 100
         print(i, x)

generate_flag_pattern("DUCKERZ{rU57_15_h4rD_70_uNd3r574nD_8u7_17_15_54F3}")
