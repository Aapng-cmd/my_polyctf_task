#include "element_in_string.h"

bool element_in_string(const char str[], char c)
{
    for (int i = 0; str[i] != '\0'; i++)
    {
        if (str[i] == c)
        {
            return true;
        }
    }
    return false;
}