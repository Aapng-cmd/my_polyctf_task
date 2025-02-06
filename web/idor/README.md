# IDOR

## Category
Web

## Description
I created an absolutely safe storage for pictures, where everyone can save their images.

## Level
Medium

## Cost
200

## Files
task.zip

## Hosting
Y

## Flag
flag_plug

==========

## Solution
We log in and see the uploading function. Unfortunately, we can upload only jpg, png, jpeg, and gif. We do this and see that we can get only sha256.extension of our file. We try to brute-force it.

* Alert! Better log in with a short name *

We create a rule, which MUST include extensions .jpg .png .jpeg .gif

Finally, we understand that `image_name = login + name_of_image_with_extension`. So we do in PHP `sha256("adminflag.jpg")` and get the flag by the path `uploads/admin/image_name`.
