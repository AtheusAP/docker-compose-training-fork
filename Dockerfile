FROM php:7.0.30-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql
# добавил pdo pdo_mysql pdo_pgsql