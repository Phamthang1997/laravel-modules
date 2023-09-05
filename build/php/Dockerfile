FROM php:8.2.9-fpm

WORKDIR /var/www/app

# コンテナ内のサーバー環境変数の設定
# https://matsuand.github.io/docs.docker.jp.onthefly/engine/reference/builder/#env
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

# Install composer
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        vim \
        wget \
        libzip-dev \
        libicu-dev \
        libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring opcache\
    && docker-php-ext-install zip

COPY ./build/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY . /var/www/app
RUN composer install
RUN composer dump-autoload --optimize --classmap-authoritative

USER root

RUN chmod 777 -R /var/www/app/storage

#COPY ./build/php/startup.sh /usr/local/sbin/
#RUN chmod 755 /usr/local/sbin/startup.sh
#ENTRYPOINT ["/usr/local/sbin/startup.sh"]