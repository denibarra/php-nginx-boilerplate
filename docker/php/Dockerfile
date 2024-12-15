FROM php:8.3-fpm
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install mysql \
    RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
CMD ["php-fpm"]

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug