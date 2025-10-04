# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache modules needed for .htaccess and headers
RUN a2enmod rewrite headers

# Install PostgreSQL extension for PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Optional: set server timezone
ENV TZ=Africa/Lusaka

# Copy all website files into Apache web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Use Render's dynamic $PORT or fallback to 8080
ENV PORT 8080
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf \
    && sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

# Expose port 8080 (Render will handle routing)
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]
