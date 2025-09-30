# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache modules needed for .htaccess
RUN a2enmod rewrite headers

# Optional: set server timezone (adjust if needed)
ENV TZ=Africa/Lusaka

# Copy all website files into Apache web root
COPY . /var/www/html/

# Set correct permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Expose port 10000 (Render uses this port)
EXPOSE 10000

# Start Apache in the foreground
CMD ["apache2-foreground"]
