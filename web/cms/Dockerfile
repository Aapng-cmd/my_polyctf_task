# Use the official Ubuntu image as the base image
FROM ubuntu:latest

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install Apache2 and MySQL
RUN apt-get update && \
    apt-get install -y apache2 mysql-server && \
    rm -rf /var/lib/apt/lists/*

# Configure Apache2 to run as a foreground process
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN service mysql start && sleep 20 && service mysql status && stat /var/run/mysqld/mysqld.sock
RUN mysql -uroot -e "SHOW VARIABLES LIKE 'socket';"

# Create a new MySQL user with all privileges
RUN mysql -uroot -e "CREATE USER 'newuser'@'127.0.0.1' IDENTIFIED BY 'p4$$w0rd!_!';"
RUN mysql -uroot -e "GRANT ALL PRIVILEGES ON *.* TO 'newuser'@'127.0.0.1';"
RUN mysql -uroot -e "FLUSH PRIVILEGES;"

# Run the test.sql script with the newuser
RUN mysql -unewuser -p'p4$$w0rd!_!' < test.sql

# Expose the Apache2 port
EXPOSE 80

# Expose the MySQL port
EXPOSE 3306

# Start Apache2 and MySQL when the container starts
CMD ["apache2-foreground", "service", "mysql", "start"]
