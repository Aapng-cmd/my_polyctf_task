# xss

## task
Web<br>
Name: Tic-tac-toe<br>
Description: During laboratory work, we were asked to make a game. Will you test it?<br>
Level: medium<br>
Points: 250<br>
Flag;: PolyCTF{h3lp_m3_8_h0ur5_1_r0t}<br>
==========
## solution
Simple registry/login form. Test for sqli. Nothing. Login in with some creds. See a game. Play. Scan endpoints. Nothing. Examine html/js code. Finally smth interesting. We see, that our login figures in liderboard table. See a xss vector. Login with img payload and grab lots of cookies (please use fetch). Try all of them on ```admin.php``` and finally grab flag.
