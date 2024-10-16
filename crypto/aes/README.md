# aes

## task
Crypto<br>
Name: AES?
Description: For my project, I made my own version of AES and tested it right before the commission. Can you guess what I encrypted? (PS: the commission was in the evening, I think from 18 to 20, and I hired girls from 25 to 40 years old)<br>
Level: hard<br>
Points: 300-400<br>
Flag: PolyCTF{Y3s_1t5_trul4_3x35t5}<br>
==========
## solution
Okay, this will be hard. Firstly we try this crypto function, but can see, that decryption is wrong. Look for methods and we can see that ```__peremeshenie``` and we ccan see that it is not equivalent for decrypting.<br>
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
Okay, now everything is good. Now we have to guess key. See the time in description ( * task was for 2024 * ), and brute it. We brute hours and minutes, so we got a key and a flag.
