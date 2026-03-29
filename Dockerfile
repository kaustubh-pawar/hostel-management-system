FROM php:8.2-apache

# Disable conflicting MPMs and enable prefork
RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true
RUN a2enmod mpm_prefork

# Enable required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files
COPY . /var/www/html/

EXPOSE 80