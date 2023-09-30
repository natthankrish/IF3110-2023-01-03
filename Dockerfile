# Use the official PHP image with Apache as the base image
FROM php:apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the index.php file from the src/public directory to the current directory in the container
COPY src/public/index.php .

# Install required PHP extensions: mysqli, pdo, pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable the Apache mod_rewrite module
RUN a2enmod rewrite

# Update package repositories and upgrade installed packages
RUN apt-get -y update && apt-get -y upgrade

# Install ffmpeg for multimedia processing
RUN apt-get install -y ffmpeg

# Expose port 80 to allow incoming HTTP traffic
EXPOSE 80