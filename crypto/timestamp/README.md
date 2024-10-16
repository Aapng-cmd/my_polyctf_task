# timestamp

## task
Crypto<br>
Name: Hardcore bruteforce<br>
Description: Even if it is a cryptography task, you need to bruteforce password. But we are young, so we can wait...<br>
Level: easy<br>
Points: 150<br>
Flag: PolyCTF{71m3_47ck_15_dn63r0u5}<br>
==========
## solution
Okey, it is half ppc, half crypto task, but the core of task is crypto. When connected, we can see, taht we have 100 attempts for 10 digit password. If you know, you know, but if not we can try to do some passwords. Now a lil bit of theory: exists an attack, which relies on time. This is because of the mechanism of checking, if smth is equal. So we do a simple script of checking what digit is longer checked. And we get a flag.
