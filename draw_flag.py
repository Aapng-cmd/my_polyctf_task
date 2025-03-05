#!/usr/bin/python3.10

import argparse
from PIL import Image, ImageDraw, ImageFont

def create_image(text, output_format):
    font_size = 40

    # Use a valid TrueType font file
    font_path = "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf"  # Update this path as needed
    font = ImageFont.truetype(font_path, font_size)

    # Calculate image dimensions based on text length
    text_bbox = ImageDraw.Draw(Image.new("RGB", (1, 1))).textbbox((0, 0), text, font=font)
    text_width = text_bbox[2] - text_bbox[0]  # Width of the text
    text_height = text_bbox[3] - text_bbox[1]  # Height of the text

    # Set the image dimensions with padding
    image_width = text_width + 40
    image_height = text_height + 40

    # Create a new image
    image = Image.new("RGB", (image_width, image_height), color=(73, 109, 137))

    # Draw the text on the image
    draw = ImageDraw.Draw(image)

    # Center the text
    x = (image_width - text_width) / 2
    y = (image_height - text_height) / 2

    # Draw the text in yellow
    draw.text((x, y), text, font=font, fill=(255, 255, 0))

    # Save the image with the specified format
    output_filename = f"task.{output_format}"
    image.save(output_filename)

    print(f"{output_filename} has been created successfully.")

def main():
    # Set up argument parsing
    parser = argparse.ArgumentParser(description='Create an image with specified text.')
    parser.add_argument('-t', '--text', type=str, required=True, help='Text to display on the image')
    parser.add_argument('-it', '--image-type', choices=['jpg', 'jpeg', 'png'], required=True, help='Output image format')
    
    args = parser.parse_args()
    
    # Create the image with the specified text and format
    create_image(args.text, args.image_type)

if __name__ == "__main__":
    main()
