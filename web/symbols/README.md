# symbols

## task
Web<br>
Name: kinda symbolic<br>
Description: I can tell fortunes with tarot cards. They can even read files. But as part of education, I will tell you what each card is about.<br>
Level: medium<br>
Points: 200<br>
Flag: PolyCTF{5ym8011c_l1nk5_4r3_4l50_600d}<br>
==========
## solution
On web page we can see uploading function. We fuzz and see that we can upload txt and zip files. We see taht it extracts txt files from zip archive and do womething from them. So we simply do
```
ln -s /etc/passwd p.txt
zip p.zip -s p.txt
```
And POC is ready. Test it, see if it works, and replace ```/etc/passwd``` with ```/flag.txt```
