FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y gcc make autoconf procps libc-dev pkg-config zlib1g-dev libpq-dev git libicu-dev libxml2-dev librabbitmq-dev libyaml-dev\
    && docker-php-ext-configure intl\
    && docker-php-ext-install intl\
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql\
    && docker-php-ext-install pdo pdo_pgsql pgsql\
    && docker-php-ext-install xml\

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

WORKDIR /var/www/public