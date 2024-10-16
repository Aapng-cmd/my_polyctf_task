# cms

## task
Web<br>
Name: We continue to continue (reference to multiple tasks for sql on board)<br>
Description: This is my first website development project, I checked everything and for greater security I implemented everything myself!<br>
Level: medium<br>
Points: 200<br>
Flag: PolyCTF{y34h_s0m371m3_c00k13_15_n0t_s3c}<br>
==========
## solution
Web app => sqli. Try login, password. Nothing. Do cookies => got it. And then everything is great: brute password of admin from hash, login with admin, get flag.
