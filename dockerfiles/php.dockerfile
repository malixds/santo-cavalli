FROM php:8.2-fpm-alpine

ARG UID=1000
ARG GID=1000

ENV UID=${UID}
ENV GID=${GID}

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout || true

RUN addgroup -S -g ${GID} laravel
RUN adduser -S -D -s /bin/sh -G laravel -u ${UID} laravel

RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Install Alpine packages and PHP extensions
RUN apk add --no-cache \
    librdkafka \
    libzip-dev \
    postgresql-dev \
    unzip \
    git \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS librdkafka-dev \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apk del .build-deps

USER laravel

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]