
FROM composer:1.9.1 as composer

################################################################################

FROM php:7.2-fpm as php

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN apt-get update \
    && apt-get install -y \
        zlib1g-dev \
        unzip \
        libicu-dev \
        g++

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-ext-install intl

RUN pecl install apcu-5.1.8 \
    && docker-php-ext-enable apcu

WORKDIR /app

COPY ./ /app/

RUN composer install --prefer-dist --no-scripts --no-dev \
    && composer clear-cache

# RUN php -d display_errors=on bin/console cache:warmup --env=prod

CMD ["php-fpm"]
