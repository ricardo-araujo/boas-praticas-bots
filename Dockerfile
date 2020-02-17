FROM php:7.2-fpm

MAINTAINER Ricardo Araujo

COPY . /www/boas-praticas-bots

WORKDIR /www/boas-praticas-bots

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    iputils-ping \
    vim \
    git \
    unzip \
    libpq-dev \
    libzip-dev

RUN docker-php-ext-install zip
