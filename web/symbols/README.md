# Symbols

## Category
Web

## Description
I can tell fortunes with tarot cards. They can even read files. But as part of education, I will tell you what each card is about.

## Level
Medium

## Cost
200

## Files
task.zip

## Hosting
Needed

## Flag
flag_plug

==========

## Solution
On the web page, we can see an uploading function. We fuzz and see that we can upload txt and zip files. We see that it extracts txt files from the zip archive and does something with them. So we simply do:

`ln -s /etc/passwd p.txt; zip p.zip p.txt`

And the POC is ready. Test it, see if it works, and replace `/etc/passwd` with `/flag.txt`.
