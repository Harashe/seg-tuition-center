# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite headers

# Optional: set timezone
ENV TZ=Africa/Lusaka

# Copy files
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Set ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Force Apache to listen to Render's port
RUN sed -i "s/Listen 80/Listen 8080/" /etc/apache2/ports.conf && \
    sed -i "s/<VirtualHost \*:80>/<VirtualHost *:8080>/" /etc/apache2/sites-available/000-default.conf

# Expose 8080 (Render replaces this with $PORT automatically)
EXPOSE 8080

# Start Apache, dynamically replacing port with $PORT
CMD ["/bin/bash", "-c", "sed -i \"s/8080/${PORT}/\" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf && apache2-foreground"]
