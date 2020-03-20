FROM php:7.4-fpm-alpine
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN docker-php-ext-install pdo_mysql
ARG BUILDTIME_FIDELITY
ENV FIDELITY=$BUILDTIME_FIDELITY
WORKDIR /www
COPY ./src .
COPY ./images/$BUILDTIME_FIDELITY images/$BUILDTIME_FIDELITY