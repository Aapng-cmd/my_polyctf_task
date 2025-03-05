# Use the official Ubuntu image as the base image
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libzip-dev \
    sudo \
    gcc \
    make \
    nano \
    && docker-php-ext-install mysqli xml zip \
    && rm -rf /var/lib/apt/lists/*


COPY --chown=www-data:www-data src_web/ /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
