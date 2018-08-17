FROM php:7.2-apache
RUN docker-php-source extract \
  && docker-php-ext-install mysqli \
  && docker-php-source delete
RUN a2enmod rewrite
