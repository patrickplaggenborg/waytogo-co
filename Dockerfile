FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Enable Apache rewrite (WordPress permalinks)
RUN a2enmod rewrite

# Install required PHP extensions for WordPress
RUN docker-php-ext-install mysqli

# Copy WordPress (from your repo) into the container
COPY . /var/www/html/

# Fix baseline permissions during build (for non-persistent files)
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

# Add runtime permission fix script (for Coolify persistent volumes)
COPY fix-permissions.sh /usr/local/bin/fix-permissions.sh
RUN chmod +x /usr/local/bin/fix-permissions.sh

# Start container via our script (which then launches Apache)
ENTRYPOINT ["fix-permissions.sh"]
CMD ["apache2-foreground"]

EXPOSE 80
