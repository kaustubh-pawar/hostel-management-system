FROM php:8.2-apache

# Fix Apache MPM conflict properly
RUN apt-get update && apt-get install -y apache2-utils

RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true
RUN a2dismod mpm_prefork || true

RUN a2enmod mpm_prefork

# Set ServerName to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Clean Apache default configs that may conflict
RUN rm -f /etc/apache2/mods-enabled/mpm_event.load
RUN rm -f /etc/apache2/mods-enabled/mpm_worker.load

# Copy project
COPY . /var/www/html/

EXPOSE 80