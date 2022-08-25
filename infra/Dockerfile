#
#
# Base install
#
FROM php:8.0-apache as base

LABEL vendor="Supermetrics"

# Set common env variables
ENV TZ="UTC"
ENV APACHE_DOCUMENT_ROOT="/app/public"

RUN apt-get update -y \
    && apt-get upgrade -y \
    && apt-get install -y git memcached libmemcached-dev libmemcached-tools libzip-dev unzip

RUN pecl install memcached

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY --chown=root:root infra/config/php/php.ini /usr/local/etc/php/php.ini
COPY --chown=root:root infra/config/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY --chown=www-data:www-data /. /app

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /app

RUN composer install --no-interaction --no-ansi -o

#
# Build dev stuff
#
FROM base as local

ENV PHP_IDE_CONFIG="serverName=sm_assignment"
ENV APP_ENV="local"

RUN pecl install -f xdebug && \
    echo zend_extension=$(find /usr/local/lib/php/ | grep xdebug.so) >> /usr/local/etc/php/php.ini

