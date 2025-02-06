#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <netdb.h> // Include for gethostbyname

#define BUFFER_SIZE 4096
#define KEY_LEGACY "G7@k!z#1$wQ^e*3&xR8%tA(9)jL+f"
#define KEY "dshoSAD%^QEhsdjadi124"

void vigenere_decrypt(char *ciphertext, char *key, char *plaintext) {
    int key_length = strlen(key);
    for (int i = 0, j = 0; ciphertext[i] != '\0'; i++) {
        if (ciphertext[i] >= 'A' && ciphertext[i] <= 'Z') {
            plaintext[i] = (ciphertext[i] - key[j % key_length] + 26) % 26 + 'A';
            j++;
        } else {
            plaintext[i] = ciphertext[i]; // Non-alphabetic characters are unchanged
        }
    }
    plaintext[strlen(ciphertext)] = '\0'; // Null-terminate the plaintext
}

int main(int argc, char *argv[]) {
    if (argc != 2) {
        fprintf(stderr, "Usage: %s <filename>\n", argv[0]);
        return 1;
    }

    int sock;
    struct sockaddr_in server;
    char buffer[BUFFER_SIZE];
    char decrypted[BUFFER_SIZE];

    // Create socket
    sock = socket(AF_INET, SOCK_STREAM, 0);
    if (sock == -1) {
        perror("Could not create socket");
        return 1;
    }

    // Server details
    server.sin_family = AF_INET;
    server.sin_port = htons(12345); // Change to your server port

    // Resolve hostname to IP address
    struct hostent *host = gethostbyname("chatbot");
    if (host == NULL) {
        herror("gethostbyname failed");
        return 1;
    }
    memcpy(&server.sin_addr.s_addr, host->h_addr, host->h_length);

    // Connect to server
    if (connect(sock, (struct sockaddr *)&server, sizeof(server)) < 0) {
        perror("Connection failed");
        return 1;
    }

    // Send the filename to the server
    send(sock, argv[1], strlen(argv[1]), 0);

    // Receive encrypted content
    int bytes_received = recv(sock, buffer, BUFFER_SIZE - 1, 0);
    if (bytes_received < 0) {
        perror("Receive failed");
        return 1;
    }
    buffer[bytes_received] = '\0'; // Null-terminate the received data

    // Decrypt the content
    vigenere_decrypt(buffer, KEY_LEGACY, decrypted);
    vigenere_decrypt(buffer, KEY, decrypted);
    printf("%s\n", decrypted);

    // Clean up
    close(sock);
    return 0;
}
