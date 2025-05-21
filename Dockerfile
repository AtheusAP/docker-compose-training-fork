# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Установка необходимых расширений PHP для работы с MySQL и PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

#RUN a2enmod rewrite