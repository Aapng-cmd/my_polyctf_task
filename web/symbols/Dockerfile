# Use the official PHP 7.4 image as a base
FROM php:8.3-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the index.php script into the container
COPY index.php /var/www/html/
COPY style.css /var/www/html/
COPY script.js /var/www/html/

# Copy the script.py script into the container
COPY script.py /var/www/

# Install the necessary dependencies
RUN apt-get update && apt-get install -y python3 unzip

# Set the permissions for the script.py file
RUN chmod +x /var/www/script.py

RUN mkdir -p /var/www/html/uploads
RUN chown -R www-data:www-data /var/www/html/uploads
RUN chmod -R 755 /var/www/html/uploads

RUN touch /var/www/data.json
RUN chown www-data:www-data /var/www/data.json
RUN chmod 755 /var/www/data.json

RUN echo 'PolyCTF{5ym8011c_l1nk5_4r3_4l50_600d}' > /flag.txt

# Expose the port that Apache will use
EXPOSE 80

# Start Apache when the container starts
CMD ["apache2-foreground"]
