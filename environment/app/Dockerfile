FROM php:7.3.0-fpm-alpine3.8

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN chown -R www-data:www-data /var/www/html
USER root