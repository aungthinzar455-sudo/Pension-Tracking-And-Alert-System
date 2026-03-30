# Use the professional PHP + Apache image
FROM php:8.2-apache

# IMPORTANT: Install the mysqli extension so PHP can connect to MySQL/TiDB
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy your project files into the server
COPY . /var/www/html/

# Set correct permissions so the website can load images and scripts
RUN chown -R www-data:www-data /var/www/html

# Tell Apache to listen on the port Render expects
EXPOSE 80
