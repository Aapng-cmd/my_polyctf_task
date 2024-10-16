# idor

## task
Web<br>
Name: Images<br>
Description: I created an absolutely safe storage for pictures, where everyone can save their images.<br>
Level: medium<br>
Points: 200<br>
Flag: PolyCTF{1D0R_15_57111_d4n63r0u5}<br>
==========
## solution
We log in and see the uploading function. Unfortunately, we can upload only jpg, png, jpeg and gif. We do this and see, that we can get only sha256.extension of our file. We try to bruteforce it.<br>
* Alert! Better log in with short name *<br>
We create a rule, which MUST to include extensions .jpg .png .jpeg .gif<br>
Finally we understand, that ```image_name = login + name_of_image_with_extension```. So we do in php sha256("adminflag.jpg") and get flag by the path uploads/admin/image_name.
