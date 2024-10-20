#include <iostream>
#include <fstream>
#include "string_work.h"


#define MAX_WORD_LENGTH 256

int main()
{
    const char ERROR_OPENING_FILE[] = "Error opening file";
    const char ERROR_NN_FILE[] = "Error noname file";
    char fn[MAX_WORD_LENGTH] = {0};

    std::cout << "Enter name of file: " << std::endl;
    std::cin >> fn;
    if (*fn == '\0')
    {
        std::cerr << ERROR_NN_FILE << std::endl;
        return -1;
    }
    // D:\JetBrains\CLionProjects\Lab1\individual\cstrings\test.txt
    std::ifstream file;
    file.open(fn);

    if (!file.is_open()) {
        std::cerr << ERROR_OPENING_FILE << std::endl;
        return -1;
    }

    char word1[MAX_WORD_LENGTH] = {0};
    char word2[MAX_WORD_LENGTH] = {0};
    while (true) {
        readstring(file, word1, MAX_WORD_LENGTH - 1);
        readstring(file, word2, MAX_WORD_LENGTH - 1);
        if (word1[0] == '\0' || word2[0] == '\0') {
            break;
        }
        std::cout << word1 << " " << word2 << std::endl;
        std::cout << "Is there any repeated symbols? " <<  (myStrUnique(word1, word2) ? "Yes" : "No") << std::endl;

        word1[0] = '\0';
        word2[0] = '\0';
    }

    file.close();

    return 0;
}