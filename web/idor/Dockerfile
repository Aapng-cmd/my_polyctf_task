FROM php:7.4-apache
COPY src/ /var/www/html/
COPY init.sql /var/www

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
# RUN apt-get update && apt-get install mysql-server
# RUN apt-get update && apt-get install mysql-client

# Install dependencies

RUN apt-get update && apt-get install -y libzip-dev zip
RUN chown -R www-data:www-data /var/www/html

# Expose the port

EXPOSE 80
