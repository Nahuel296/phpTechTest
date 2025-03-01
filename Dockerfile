FROM php:8.2-cli-bookworm

RUN apt-get update && apt-get install -y unzip git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

CMD ["php", "-a"]
