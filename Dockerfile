# Используем официальный PHP образ
FROM php:8.4-cli

# Устанавливаем необходимые пакеты
RUN apt-get update && apt-get install -y zip unzip mc git curl

# Установим зависимости для GD
RUN apt-get install -y libjpeg-dev libpng-dev libwebp-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install gd

# Устанавливаем Node.js и NPM
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Устанавливаем libsodium
RUN apt-get install -y libsodium-dev \
    && docker-php-ext-install sodium

# Устанавливаем libicu-dev для intl
RUN apt-get install -y  libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# Устанавливаем zip
RUN apt-get install -y libzip-dev \
    && docker-php-ext-install zip


# Устанавливаем расширения PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем рабочую директорию в контейнере
WORKDIR /var/www
