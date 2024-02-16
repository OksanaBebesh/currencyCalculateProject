FROM composer

FROM php:8.0-fpm

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y curl git && apt-get install -y libcurl4-openssl-dev
RUN docker-php-ext-install mysqli curl pdo pdo_mysql

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list
RUN apt update
RUN apt install -y symfony-cli

RUN apt-get -y install zip

COPY local.ini /usr/local/etc/php/php.ini

CMD ["docker-php-entrypoint", "php-fpm"]