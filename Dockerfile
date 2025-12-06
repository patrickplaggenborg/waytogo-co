FROM wordpress:php8.5-apache

# Set working directory
WORKDIR /var/www/html

# Copy all WordPress files from repository
COPY . /var/www/html/

# Set proper permissions for WordPress
# www-data is the default user for WordPress in the official image
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

# Ensure wp-content/uploads and other necessary directories are writable
# We create them if they don't exist and set permissions
RUN mkdir -p /var/www/html/wp-content/uploads \
    /var/www/html/wp-content/cache \
    /var/www/html/wp-content/upgrade \
    && chown -R www-data:www-data /var/www/html/wp-content \
    && chmod -R 775 /var/www/html/wp-content

# Expose port 80
EXPOSE 80


