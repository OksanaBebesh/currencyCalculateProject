FROM composer

FROM php:8.0-fpm

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y curl git && apt-get install -y libcurl4-openssl-dev
RUN docker-php-ext-install mysqli curl pdo pdo_mysql

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list
RUN apt update
RUN apt install -y symfony-cli

RUN apt-get -y install zip

# RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
#     && php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
#     && php composer-setup.php \
#     && php -r "unlink('composer-setup.php');" \
#     && mv composer.phar /usr/local/bin/composer

# RUN composer self-update

# WORKDIR /var/www/html/src

# RUN composer install \
#     && composer clearcache

# RUN composer dump-autoload --optimize

COPY local.ini /usr/local/etc/php/php.ini

CMD ["docker-php-entrypoint", "php-fpm"]