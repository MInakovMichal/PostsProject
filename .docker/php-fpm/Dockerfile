FROM php:8.2-fpm

# Update packages
RUN apt-get update && \
    apt-get install -y \
        php8.2-gd \
        curl \
        git \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        zip \
        unzip && \
    apt-get install -y default-mysql-client && \
    apt-get install -y nodejs

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli opcache pdo_mysql zip intl

ADD .docker/php-fpm/entrypoint/docker-entrypoint.sh /opt/docker-entrypoint.sh
ADD .docker/php-fpm/conf.d/* /usr/local/etc/php/conf.d/

# Set working directory
WORKDIR /var/www

# Run composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
