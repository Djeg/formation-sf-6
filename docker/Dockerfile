FROM php:8-fpm-alpine

RUN apk --no-cache update && apk --no-cache add bash icu icu-dev zlib-dev

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN symfony server:ca:install

WORKDIR /var/www/html