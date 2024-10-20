# Frames

## Category
Stego

## Description
We found a funny meme, but it seems to be a bit corrupted.

## Level
Medium

## Cost
250

## Files
task.zip

## Hosting
Needed

## Flag
PolyCTF{j45t_4_fl4g_1_4m_burn7_0u7}

==========

## Solution
Firstly, ```unzip task.zip```. We get ```task.mp4``` and ```frames.zip```. When we try to unzip ```frames.zip```, it asks for a password, so we work with ```task.mp4```.

Notice that the sound is repeated, but the video is only once. We extract the audio from ```task.mp4``` and get ```sound.wav```. Then, we create a spectrogram and see a string; this is the password for the archive.

Unzip the archive to get the frames of the video. Examine the frames, and on some of them, you will see ```Artist``` metadata. This is a strange string. Try base encoding, and with base85, we can decrypt a letter.

* Note: There may be a bug, as I randomly shuffled the frames, but everything is okay here. However, ```exp.py``` should be slightly reworked.

To find the metadata, use:
```find frames -exec exiftool -b -Artist {} \;```

Then, do something like this:
```for i in range(0, len(s), 2): print(base64.b85decode(s[i:i+2]).decode(), end="")```
and get the flag.
