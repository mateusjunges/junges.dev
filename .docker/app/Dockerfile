ARG PHP_VERSION

FROM php:${PHP_VERSION}

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    gnupg2

# Install PHP extensions (keep in sync them with composer.json required expentions [expect curl dom hash filter json libxml pdo])
RUN docker-php-ext-install pdo_mysql pcntl bcmath

RUN docker-php-ext-install sockets

RUN docker-php-ext-install exif
RUN docker-php-ext-enable exif

# Install ext-gd
RUN apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev
RUN docker-php-ext-configure gd \
    --with-webp=/usr/include/ \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# Install ext-zip
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

# Install ext-intl
RUN docker-php-ext-configure intl && docker-php-ext-install -j$(nproc) intl

# Install ext-redis
RUN pecl install redis && docker-php-ext-enable redis

# https://blog.denisbondar.com/post/phpstorm_docker_xdebug (RU)
RUN pecl install xdebug && docker-php-ext-enable xdebug

# https://www.hmazter.com/2019/04/speeding-up-php-docker-with-opcache/
RUN docker-php-ext-install opcache

# Install FFMPEG
RUN apt-get -y \
    -o Dpkg::Options::="--force-confdef" \
    -o Dpkg::Options::="--force-confold" \
    install ffmpeg

# Install MySQL Client to use mysqldump and mysql CLI tools (needed to prepare DBs for parallel testing)
RUN apt-get install -y default-mysql-client

# Install Blackfire CLI tool and PHP Probe
# Blackfire Probe collects the execution stats and sends it to the Blackfire Agent.
RUN curl --silent -o - https://packages.blackfire.io/gpg.key | apt-key add -
RUN echo "deb http://packages.blackfire.io/debian any main" | tee /etc/apt/sources.list.d/blackfire.list
RUN apt-get update && apt-get install -y blackfire-agent blackfire-php

# Clear cache
RUN apt-get -y autoremove && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Get Composer v2.3
COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

ARG USER_ID
ARG GROUP_ID
ARG USER_NAME

# Inspired by https://github.com/hexops/dockerfile#do-not-use-a-uid-below-10000 and https://github.com/hexops/dockerfile/blob/main/Dockerfile
# Non-root user for security purposes.
#
# UIDs below 10,000 are a security risk, as a container breakout could result
# in the container being ran as a more privileged user on the host kernel with
# the same UID.
#
# Static GID/UID is also useful for chown’ing files outside the container where
# such a user does not exist.
RUN addgroup --gid $GROUP_ID --system $USER_NAME \
 && adduser  --uid $USER_ID --system --ingroup $USER_NAME --home /home/$USER_NAME $USER_NAME

# Set working directory
WORKDIR /var/www

# Run all subsequent commands as nonroot user
USER ${USER_NAME}
