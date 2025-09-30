# Use official PHP + Apache image
FROM php:8.2-apache

# Install common PHP extensions (uncomment if needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy all website files into Apache web root
COPY . /var/www/html/

# Set permissions so Apache can read files
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Expose port 10000 (Render uses this)
EXPOSE 10000

# Start Apache in foreground
CMD ["apache2-foreground"]
