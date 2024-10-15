from PIL import Image, ImageDraw, ImageFont

# Create a new image with white background
img = Image.new('RGB', (800, 100), color = (255, 255, 255))

# Set the font and font size
fnt = ImageFont.truetype('/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf', 30)

# Create ImageDraw object
d = ImageDraw.Draw(img)

# Draw the text
d.text((10,10), "stay_with_me_and_that_is_all_we_got_her3", font=fnt, fill=(0, 0, 0))

# Save the image
img.save('output.png')
