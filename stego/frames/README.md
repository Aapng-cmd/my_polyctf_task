# frames


## task
Stego:<br>
Name: Clip<br>
Description: Look, what a funny meme I dound. But i think it is a bit corrupted...<br>
Points: 250<br>
Flag: PolyCTF{j45t_4_fl4g_1_4m_burn7_0u7}<br>
==========
## solution
Firstly<br>
```unzip task.zip```
We get task.mp4 and frames.zip. When we try to unzip frames.zip it asks for password. So, we work with task.mp4.<br>
Notice, that sound is repeated, but video is only once. So, we extract music from task.m4 and get sound.wav.<br>
Get the spectogram and see the string. This is a password for archive.
<br><br>
Unzip an archive and get frames of video. Examine frames and on some of them see "Artist" metadata. It is a strange string. Try base, and on base85 we can decrypt a letter.<br>
* here can be a bug, I randomly shuffled the frames, but here everything is okay, but exp.py should be a bit reworked.
```find frames -exec exiftool -b -Artist {} \;``` for finding these metadata.<br>
Do smth like this ```for i in range(0, len(s), 2): print(base64.b85decode(s[i:i+2]).decode(), end="")``` and get a flag.
