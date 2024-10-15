# blue

==========
## task
Forensics
Name: Blue frost
Description: I think, that music delivered to me slowly. Report the problem
Level: easy
Points: 150
Author: https://t.me/vchabk0
Flag: PolyCTF{blu3t00t4_15_4ls0_an_op2i0n}
==========
## solution
In pcapng we can see music, but we know, that this is forensic, so we check for files.
We search for ```obex```, and see a large file. In that file we can see numbers, which look like ASCII codes. So, we extract them to a file and see very strange string behaviour.
* task was changed, so it was less difficult
When we see strange string, we have options
1. new crypto cipher
2. baseN string
3. XOR string

First option is wrong, because it is forensics (easy)
Second option can be checked and we get nothing
So we have third option. XOR.
* in changed task every code was xored with 5
1. Xor everythong with 1. Firts letter is "P".
2. Xor with 2. Second letter is "o".
3. Xor with 3. Second letter is "l".
4. Xor with 4. Second letter is "y".
5. Xor with 5. Second letter is "C".
6. Xor with 6. Second letter is "T".

Remeber, that prefix of flag is PolyCTF.
Understandable. Do XOR for every letter and get flag.
