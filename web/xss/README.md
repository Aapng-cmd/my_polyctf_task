# XSS

## Category
Web

## Description
During laboratory work, we were asked to make a game. Will you test it?

## Level
Medium

## Cost
250

## Files
task.zip

## Hosting
Needed

## Flag
PolyCTF{h3lp_m3_8_h0ur5_1_r0t}

==========

## Solution
Simple registry/login form. Test for SQLi. Nothing. Login in with some creds. See a game. Play. Scan endpoints. Nothing. Examine HTML/JS code. Finally, something interesting. We see that our login figures in the leaderboard table. See an XSS vector. Login with an image payload and grab lots of cookies (please use fetch). Try all of them on "admin.php" and finally grab the flag.
