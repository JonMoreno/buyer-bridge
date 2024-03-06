FROM php:8.2-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl;

RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install zip

RUN apk add --no-cache linux-headers
RUN apk add --no-cache nano

RUN docker-php-ext-install sockets
RUN apk update && apk add --no-cache supervisor

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files to the container
COPY . /var/www/html
RUN chmod +x start.sh

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 and run start script
EXPOSE 9000
CMD ["/var/www/html/start.sh"]
