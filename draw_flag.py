#!/usr/bin/python

from PIL import Image, ImageDraw, ImageFont

# Set the text and font
text = "PolyCTF{1D0R_15_57111_d4n63r0u5}"
font_size = 40

# Use a valid TrueType font file
font_path = "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf"  # Update this path as needed
font = ImageFont.truetype(font_path, font_size)

# Set the image dimensions
image_width = 800
image_height = 600
image = Image.new("RGB", (image_width, image_height), color=(73, 109, 137))

# Draw the text on the image
draw = ImageDraw.Draw(image)

# Calculate text size
text_bbox = draw.textbbox((0, 0), text, font=font)  # Use textbbox() to get bounding box
text_width = text_bbox[2] - text_bbox[0]  # Width is the difference between right and left
text_height = text_bbox[3] - text_bbox[1]  # Height is the difference between bottom and top

# Center the text
x = (image_width - text_width) / 2
y = (image_height - text_height) / 2
draw.text((x, y), text, font=font, fill=(255, 255, 0))

# Save the image
image.save("task.jpg")
