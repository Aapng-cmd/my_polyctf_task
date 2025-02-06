# Use the official PHP 7.4 Apache image as the base image
FROM php:7.4-apache

# Set environment variables
ENV USERNAME=lilo
ENV USERHOME=/home/$USERNAME

# Install necessary packages for extensions and create a non-root user
RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libzip-dev \
    sudo \
    gcc \
    make \
    nano \
    && docker-php-ext-install mysqli xml zip \
    && rm -rf /var/lib/apt/lists/*

# Create a new user and set the home directory
RUN useradd -m -s /bin/bash $USERNAME

RUN echo "$USERNAME:maries1" | chpasswd

RUN echo 'root:aB3$dE!fG@hI#jK$lM%n^oP*qR&sT(u)V)wX+yZ' | chpasswd

RUN echo 'Defaults	env_keep += "LD_PRELOAD"' >> /etc/sudoers

# Set the working directory
WORKDIR /var/www/html

# Change ownership of the Apache document root
RUN chown -R www-data:www-data /var/www/html

# Copy application files to the Apache document root
COPY --chown=www-data:www-data src_web/ /var/www/html/


# Copy the source code for the inner program
COPY --chown=$USERNAME:$USERNAME src_inner/chat.c /home/$USERNAME/chat.c
COPY --chown=$USERNAME:$USERNAME src_inner/user_flag.txt /home/$USERNAME/flag.txt
COPY src_inner/root_flag.txt /root/flag.txt

# Compile the program
RUN gcc -o /home/$USERNAME/chat /home/$USERNAME/chat.c

# Remove the source code after compilation
RUN rm /home/$USERNAME/chat.c

# Change the ownership of the compiled program to root
RUN chown lilo:lilo /home/$USERNAME/chat

# Set permissions: readable by root, executable by user "lilo"
RUN chmod 400 /home/$USERNAME/chat  # Readable by root only
RUN chmod u+x /home/$USERNAME/chat   # Make it executable by the user "lilo"

RUN echo "lilo ALL=(ALL) NOPASSWD: /home/lilo/chat" >> /etc/sudoers

RUN chown -R www-data:www-data /var/www/html/uploads

# Switch to the new user
USER www-data

# Expose the port
EXPOSE 80

# Run Apache in the foreground
CMD ["apache2-foreground"]
