import os
import pyexiv2
import base64
import random

FLAG = "PolyCTF{j45t_4_fl4g_1_4m_burn7_0u7}"
k = 0

# Set the directory path and the letter to add to the "Author" metadata
directory_path = './frames'

# Iterate through each file in the directory
while k != len(FLAG):
    # Iterate over every file in the directory
    for filename in os.listdir(directory_path):
        # Check if the file is an image
        if random.randint(1, 6) == 2 and k != len(FLAG):
            if filename.lower().endswith(('.png', '.jpg', '.jpeg', '.tif', '.tiff', '.gif', '.bmp')):
                # Open the image file using pyexiv2
                image_path = os.path.join(directory_path, filename)
                metadata = pyexiv2.ImageMetadata(image_path)
                metadata.read()

                # Get the current author metadata
                author_metadata = None
                for tag in metadata.exif_keys:
                    if tag == 'Exif.Image.Artist':
                        author_metadata = metadata[tag]
                        break

                letter_to_add = base64.b85encode(FLAG[k].encode()).decode()
                k += 1
                # Add the letter to the author metadata
                if author_metadata:
                    new_author = author_metadata + letter_to_add
                else:
                    new_author = letter_to_add

                # Set the new author metadata
                metadata['Exif.Image.Artist'] = new_author

                # Write the changes to the image file
                metadata.write()
                print(f"Updated author metadata for {filename} to {new_author}")
        if k == len(FLAG):
            break
