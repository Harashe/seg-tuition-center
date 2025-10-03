# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache modules needed for .htaccess and headers
RUN a2enmod rewrite headers

# Optional: set server timezone
ENV TZ=Africa/Lusaka

# Copy all website files into Apache web root
COPY . /var/www/html/

# Set correct permissions (recommended for security)
RUN chown -R www-data:www-data /var/www/html

# Configure Apache to use Render's dynamic $PORT, fallback to 8080
RUN sed -i "s/Listen 80/Listen \${PORT:-8080}/" /etc/apache2/ports.conf && \
    sed -i "s/:80/:${PORT:-8080}/" /etc/apache2/sites-available/000-default.conf

# Expose port 8080 for local testing (Render ignores this, but useful locally)
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]
