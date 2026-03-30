# This tells Render to use a professional PHP + Apache server
FROM php:8.2-apache

# Copy all your website files into the server's web folder
COPY . /var/www/html/

# Make sure the server can read your files
RUN chown -R www-data:www-data /var/www/html
