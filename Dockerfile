FROM php:7.0-cli-alpine

MAINTAINER Ricardo Araujo

COPY . /www/boas-praticas-bots

WORKDIR /www/boas-praticas-bots

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    iputils-ping \
    vim \
    git \
    libpq-dev \
    libzip-dev
