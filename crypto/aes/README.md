# AES

## Category
Crypto

## Description
For my project, I made my own version of AES and tested it right before the commission. Can you guess what I encrypted? (PS: the commission was in the evening, I think from 18 to 20, and I hired girls from 25 to 40 years old)

## Level
Hard

## Cost
300-400

## Files
task.zip

## Hosting
N/A

## Flag
PolyCTF{Y3s_1t5_trul4_3x35t5}

==========

## Solution
Okay, this will be hard. Firstly, we try this crypto function, but we can see that decryption is wrong. Look for methods and we can see that `__peremeshenie` is not equivalent for decrypting.

```
def __peremeshenie(self, matrix, enc=True):
    if enc:
        matrix[0][0], matrix[0][3] = matrix[0][3], matrix[0][0]
        matrix[0][1], matrix[0][2] = matrix[0][2], matrix[0][1]
    
        matrix[1][0], matrix[1][1] = matrix[1][1], matrix[1][0]
        matrix[1][0], matrix[1][3] = matrix[1][3], matrix[1][0]
    
        matrix[2][0], matrix[2][1] = matrix[2][1], matrix[2][0]
        matrix[2][1], matrix[2][2] = matrix[2][2], matrix[2][1]
    
        matrix[3] = list(reversed(matrix[3]))
    else:
        matrix[0][0], matrix[0][3] = matrix[0][3], matrix[0][0]
        matrix[0][1], matrix[0][2] = matrix[0][2], matrix[0][1]
        
        matrix[1][0], matrix[1][3] = matrix[1][3], matrix[1][0]
        matrix[1][0], matrix[1][1] = matrix[1][1], matrix[1][0]
    
        matrix[2][1], matrix[2][2] = matrix[2][2], matrix[2][1]
        matrix[2][0], matrix[2][1] = matrix[2][1], matrix[2][0]
        
        matrix[3] = list(reversed(matrix[3]))
    return matrix
```

Okay, now everything is good. Now we have to guess the key. See the time in the description ( * task was for 2024 * ), and brute it. We brute hours and minutes, so we got a key and a flag.
