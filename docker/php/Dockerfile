FROM php:7.4-fpm-alpine3.13

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    curl-dev \
    libtool \
    libxml2-dev \
    sqlite-dev \

# Install production dependencies
&& apk add --no-cache \
    bash \
    shadow \
    nano \
    curl \
    gnu-libiconv \
    wget \
    freetype-dev \
    icu-dev \
    icu-libs \
    libc-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libpng-dev \
    libzip-dev \
    make \
    oniguruma-dev \
    openssh-client \
    mysql-client \
    rsync \
    jpegoptim optipng pngquant gifsicle \
    zlib-dev \

# Install PECL and PEAR extensions
&& pecl install \
    redis \

# Enable PECL and PEAR extensions
&& docker-php-ext-enable \
    redis \

# Configure php extensions
&& docker-php-ext-configure gd --with-freetype --with-jpeg \

# Install php extensions
&& docker-php-ext-install \
    gd \
    bcmath \
    calendar \
    curl \
    exif \
    iconv \
    intl \
    mbstring \
    opcache \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    pcntl \
    tokenizer \
    xml \
    zip

# Copy php.ini configuration
COPY php.ini /usr/local/etc/php/conf.d/40-custom.ini
# Copy opcache.ini configuration
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER="1" \
    COMPOSER_HOME="/tmp/composer"
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Cleanup dev dependencies
RUN apk del -f .build-deps && rm -rf /var/cache/apk/* && docker-php-source delete && rm -rf /tmp/pear

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

WORKDIR /var/www

USER 1000:1000

EXPOSE 9000

# The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD php-fpm
