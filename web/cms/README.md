# CMS

## Category
Web

## Description
This is my first website development project. I checked everything, and for greater security, I implemented everything myself!

## Level
Medium

## Cost
200

## Files
task.zip

## Hosting
Needed

## Flag
PolyCTF{y34h_s0m371m3_c00k13_15_n0t_s3c}

==========

## Solution
Web app => SQLi. Try login and password. Nothing. Check cookies => got it. And then everything is great: brute-force the password of admin from the hash, log in as admin, and get the flag.
