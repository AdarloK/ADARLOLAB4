ARG PHP_VERSION=8.5
FROM php:${PHP_VERSION}-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Serve the application through public/index.php
RUN sed -ri -e "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
	/etc/apache2/sites-available/000-default.conf \
	/etc/apache2/apache2.conf

# Allow .htaccess overrides
RUN sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copy app files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
&& chmod -R 755 /var/www/html

EXPOSE 80