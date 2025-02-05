# Use the official PHP image
FROM php:8.1-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the application files to the container
COPY . .

# Install any dependencies (if needed)
RUN docker-php-ext-install pdo pdo_mysql

# Expose the port that Apache is listening on
EXPOSE 80