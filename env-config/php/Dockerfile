FROM php:7.2.31-apache

# Installing dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    nano \
    git\
    curl \
    zip \
    unzip \
    libmcrypt-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libssl-dev \
    libxrender1 \
    libfontconfig1 \
    libx11-dev \
    libjpeg62 \
    libxtst6 \
    libssl-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    bcmath \
    soap \
    opcache \
    zip

# Install the PHP gd library
RUN docker-php-ext-configure gd \
    --with-gd \
    --with-jpeg-dir \
    --with-png-dir \
    --with-freetype-dir
RUN docker-php-ext-install gd

# Installing Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" >> /usr/local/etc/php/php.ini
RUN echo "xdebug.remote_port=9000" >> /usr/local/etc/php/php.ini
RUN echo "xdebug.remote_enable=on" >> /usr/local/etc/php/php.ini
RUN echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/php.ini
RUN echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/php.ini

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod 1777 /tmp
RUN mkdir /.composer
RUN chmod 775 /.composer

RUN a2enmod headers rewrite

RUN service apache2 restart 
