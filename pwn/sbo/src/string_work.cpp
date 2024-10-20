#include <iostream>
#include "string_work.h"
#include "element_in_string.h"


bool myStrUnique(const char * destination, const char * source)
{
    while (*source != '\0')
         if (element_in_string(destination, *source++))
             return true;

    return false;
}

char * readstring(std::ifstream &file, char *dest, int n)
{
    const char WARNING_LONG_WORD[] = "Warning: Word is too long. We will work with first 255 symbols";
    int i = 0;
    while (file.get(dest[i]) && dest[i] != '\n' && dest[i] != ' ' and i < n) {
        i++;
    }
    char trash;
    if (i == n) {
        std::cout << WARNING_LONG_WORD << std::endl;
        while (file.get(trash) && trash != '\n' && trash != ' ') {}
    }
    dest[i] = '\0';
    return dest;
}