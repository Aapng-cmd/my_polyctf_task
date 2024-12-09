FROM php:7.4-apache
COPY src/ /var/www/html
WORKDIR /var/www/html

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

# Install required packages for zip and xml extensions
RUN apt-get update && apt-get install -y libxml2-dev \
    && docker-php-ext-install xml

# Expose the port
EXPOSE 80
