# Quest1

## Category
Web - Quest

## Description
Casino always wins, doesn't it? We have their API file, it is time to win.

## Level
Hard

## Cost
500 - 700

## Files
stat_anon.php

## Hosting
Needed

## Flag
flag_plug

==========

## Solution
Firstly, log in and scan endpoints. See `stat.php` => watch `stat_anon.php`. Notice an SQLi in `update_game`, so we try to write there a string. It returns zero, which means that in the database this field is INT. 

We look for `stat_anon.php` again and see that here we have a custom session manager, so we have to write a simple script to steal the session cookie symbol by symbol. But firstly, we enumerate users. We see _admin_ and _tester_. 

- Firstly, try to steal the admin session. Failed.
- Try for stealing the tester session is completed, and now we have the ability to write reports. 

So here, we try to do XSS, and we have an admin cookie! Yeah! Or not? Somehow we are not able to insert the admin cookie to ourselves and stay logged in. 

Remember scanning endpoints? We got `reader.php`, and it says that we are not admin. Understandable. If it is a reader, then we can write XSS for reading the file as admin and send the result to us. Fuzz the parameter and find parameter _f_. 

We also notice that we cannot do `/flag.txt`, `../`, and `./` are deleted, so we try something like `.....///` and we get to the upper directory. Then we just fuzz a location of `flag.txt`, which is `/var/log`. And we solved the task!
