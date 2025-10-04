# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite headers

# Install PostgreSQL extension for PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Optional: set server timezone
ENV TZ=Africa/Lusaka

# Copy website files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port (Render handles $PORT internally)
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]
