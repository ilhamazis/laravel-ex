########################COMPOSER
FROM composer:lts AS VENDOR
WORKDIR /app
ENV APP_ENV=local
ENV CACHE_DRIVER=file
COPY database/ app/database/
COPY composer.json /app
COPY composer.lock /app
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

COPY . .
RUN composer dump-autoload

######################NODE
FROM node:latest AS NODE
WORKDIR /app
COPY  artisan package.json vite.config.js /app/
COPY public/ /app/public/
RUN npm install
COPY resources /app/resources/
RUN npm install -g npm@latest
RUN npm run build

#######################BASE
FROM php:8.1-apache-bullseye AS BASE
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
ENV TZ="Asia/Jakarta"

WORKDIR /var/www/html/

COPY --from=VENDOR /app/vendor/ /var/www/html/vendor/
COPY --from=NODE /app/node_modules/ /var/www/html/node_modules/
COPY --from=NODE /app/public/build/ /var/www/html/public/build/
COPY --from=NODE /app/public/build/assets/ /var/www/html/public/build/assets/
########################Apache conf
RUN a2enmod rewrite
RUN a2enmod headers
COPY 000-default.conf /etc/apache2/sites-enabled/000-default.conf
RUN sed -i 's/%h/%{X-Forwarded-For}i %h/g' /etc/apache2/apache2.conf
###########################SECURITY
RUN sed -i 's/ServerTokens OS/ServerTokens Prod/' /etc/apache2/conf-enabled/security.conf
RUN sed -i 's/ServerSignature On/ServerSignature Off/' /etc/apache2/conf-enabled/security.conf
RUN sed -i '/ServerTokens Prod/ a\Header unset X-Powered-By' /etc/apache2/conf-enabled/security.conf
###########################Logging
RUN mkdir /log
RUN ln -s /log /var/log/apache2
############################USER
RUN useradd -ms /bin/bash opsec
############################CLEAN
RUN ls -la

##########################Install dependencies

RUN apt-get update

RUN apt-get install -y zlib1g-dev libpng-dev libfreetype6-dev libjpeg62-turbo-dev libonig-dev libxml2-dev zip curl libzip-dev libcurl4-openssl-dev

# Install extensions
RUN apt-get update
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN docker-php-ext-install exif pcntl bcmath gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

#RUN docker-php-ext-install sockets
RUN docker-php-ext-install mbstring xml zip curl

RUN apt-get install -y libz-dev libmemcached-dev && \
    pecl install memcached && \
    docker-php-ext-enable memcached

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY . .
###############################################################################33
RUN chown -R 33:33 /var/www/html/public/
RUN chown -R 33:33 /var/www/html/storage/
RUN chown -R 33:33 /var/www/html/bootstrap/
RUN chown -R 33:33 /var/www/html/vendor/
USER opsec
###########################################GENERATE KEY
#RUN php artisan key:generate
###########################################CLEAR CACHE
RUN php artisan optimize:clear
####################################PORT
EXPOSE 80

