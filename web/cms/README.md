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
N

## Hosting
Y

## Flag
PMLCTF{5Q11_1n51D3_c00K135_15_5m7h_n3w}

## Solution
Web app => SQLi. Try login and password. Nothing. Check cookies => got it. And then everything is great: brute-force the password of admin from the hash, log in as admin, and get the flag.
