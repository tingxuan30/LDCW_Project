FROM php:8.2-apache

# Copy all website files into the Apache document root
COPY . /var/www/html/

# Enable Apache mod_rewrite (optional, but helpful for routing)
RUN a2enmod rewrite

# Expose port 80 for Render to route traffic to
EXPOSE 80
