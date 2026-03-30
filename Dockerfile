# 1. Use the professional PHP + Apache image
FROM php:8.2-apache

# 2. FIX THE FATAL ERROR: This installs the missing mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# 3. Copy your project files into the server
COPY . /var/www/html/

# 4. Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# 5. Tell the server to use Port 80
EXPOSE 80
