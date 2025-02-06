import socket

# Vigenère encryption function
def vigenere_encrypt(plaintext, key):
    key_length = len(key)
    ciphertext = ""
    key_index = 0  # To track the position in the key

    for char in plaintext:
        if char.isalpha():
            # Determine the shift based on the key character
            shift = ord(key[key_index % key_length].upper()) - ord('A')
            if char.isupper():
                encrypted_char = chr((ord(char) - ord('A') + shift) % 26 + ord('A'))
            else:
                encrypted_char = chr((ord(char) - ord('a') + shift) % 26 + ord('a'))
            ciphertext += encrypted_char
            key_index += 1  # Only increment key index for alphabetic characters
        else:
            ciphertext += char  # Non-alphabetic characters are unchanged

    return ciphertext

# Server setup
server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
server_socket.bind(('0.0.0.0', 12345))  # Bind to all interfaces on port 12345
server_socket.listen(5)

print("Server is listening on port 12345...")

while True:
    client_socket, addr = server_socket.accept()
    print(f"Connection from {addr}")

    # Receive the filename from the client
    filename = client_socket.recv(1024).decode()
    print(f"Requested file: {filename}")

    try:
        # Read the content of the specified file
        with open(filename, 'r') as file:
            plaintext = file.read()
    except Exception as e:
        print(f"Error reading file: {e}")
        client_socket.send(b"Error reading file. {e}")
        client_socket.close()
        continue

    # Encrypt the content
    key = "G7@k!z#1$wQ^e*3&xR8%tA(9)jL+f"
    encrypted_message = vigenere_encrypt(plaintext, key)
    client_socket.send(encrypted_message.encode())

    # client_socket.close()
