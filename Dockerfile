FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    git curl unzip bash shadow supervisor \
    icu-dev libzip-dev oniguruma-dev \
    postgresql-libs

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS libpq-dev

RUN docker-php-ext-install intl mbstring zip opcache pdo_pgsql

RUN pecl install redis \
 && docker-php-ext-enable redis

RUN apk del .build-deps

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html
ENV COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_MEMORY_LIMIT=-1

CMD ["php-fpm", "-F"]
