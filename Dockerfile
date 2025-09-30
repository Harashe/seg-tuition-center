# Use the official PHP image with Apache
FROM php:8.2-apache

# Copy all website files into Apache's web root
COPY . /var/www/html/

# Expose port 10000 (Render uses this port)
EXPOSE 10000

# Start Apache in the foreground
CMD ["apache2-foreground"]
