FROM php:7.4.1-fpm-buster

RUN apt-get update \
	&& apt-get -y install \
		zip unzip

RUN pecl install xdebug-2.9.1 \
	&& docker-php-ext-configure pdo_mysql --with-pdo-mysql \
	&& docker-php-ext-install mysqli opcache \
    && docker-php-ext-enable xdebug opcache mysqli

COPY --from=composer /usr/bin/composer /usr/bin/composer