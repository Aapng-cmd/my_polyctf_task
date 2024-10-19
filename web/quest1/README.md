# quest1

## task
Web - Quest<br>
Description: Casino always win, does not it? We have their api file, it is time to win.<br>
Level: hard<br>
Points: 500 - 700<br>
Flag: PolyCTF{c001_Qu357_15_17?45D0QwM654!54#}<br>
Sorces for users: stat_anon.php<br>
==========
## solution
Firstly log in and scan endpoints. See stat.php => watch ```stat_anon.php```. Notice a sqli in ```update_game```, so we try to write there a string. It returns zero, which means that in database this field is INT. We look for ```stat_anon.php``` again and see, that here we have custom session manager, so we have to write a simple script to steal session cookie symbol by symbol, but firstly we enumerate users. We see _admin_ and _tester_. Firstly, try to steal admin session. Failed. Try for stealing tester session is completed, and now we have ability to write reports. So here, we try to do xss, and we have an admin cookie! Yeah! Or not? Somehow we are not able to insert admin cookie to us and stay logined. Remember scanning endpoints? We got ```reader.php``` and it says, that we are not admin. Understandable. If it is reader, then we can write xss for reading file as admin, and send to us a result. Fuzz the parameter and find parameter _f_. We also notice, that we cannot do ```/flag.txt```, ```../``` and ```./``` are deleted, so we try smth like this ```.....///``` and we get to upper directory. Then we just fuzz a location of flag.txt *which is /var/log*. And we solved the task!
