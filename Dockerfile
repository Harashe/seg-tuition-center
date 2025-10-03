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

# Configure Apache to use Render's $PORT at runtime
RUN echo "Listen \${PORT}" > /etc/apache2/ports.conf && \
    sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

# Enable .htaccess overrides for /var/www/html
RUN echo '<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/allow-htaccess.conf \
    && a2enconf allow-htaccess

# Expose a dummy port for local runs (Render ignores EXPOSE)
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]
