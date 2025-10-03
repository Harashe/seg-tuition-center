# Use official PHP with Apache
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite headers

# Set timezone (optional)
ENV TZ=Africa/Lusaka

# Copy all website files to Apache root
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port Render expects (Render injects $PORT automatically)
EXPOSE 8080

# Start Apache in foreground
CMD ["apache2-foreground"]
