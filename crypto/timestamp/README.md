# Timestamp

## Category
Crypto

## Description
Even if it is a cryptography task, you need to bruteforce the password. But we are young, so we can wait...

## Level
Easy

## Cost
150

## Files
task.zip

## Hosting
N/A

## Flag
flag_plug

==========

## Solution
Okay, it is half PPC, half crypto task, but the core of the task is crypto. When connected, we can see that we have 100 attempts for a 10-digit password. If you know, you know, but if not, we can try to do some passwords. Now a little bit of theory: there exists an attack that relies on time. This is because of the mechanism of checking if something is equal. So we do a simple script to check which digit takes longer to verify. And we get the flag.
