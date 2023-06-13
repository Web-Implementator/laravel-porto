FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    libwebp-dev \
    libxpm-dev \
    libgmp-dev \
    ssmtp  \
    mailutils \
    npm

RUN curl -sL https://deb.nodesource.com/setup_17.x | bash

RUN apt-get install -y nodejs

RUN npm install -g @vue/cli

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set up php sendmail config
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-xpm -with-freetype
RUN docker-php-ext-install gd
RUN docker-php-ext-install gmp

# BCMath:
RUN docker-php-ext-install bcmath

# Exif:
RUN docker-php-ext-install exif

# Redis
RUN pecl install -o -f redis && \
    rm -rf /tmp/pear && \
    docker-php-ext-enable redis

# Pcntl
RUN docker-php-ext-install pcntl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Download latest composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clean logs
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

USER www-data

# Copy the contents of the directory to the resources directory
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Set permissions for service folders
RUN chmod 775 /var/www/storage/app && \
    chmod 775 /var/www/storage/framework && \
    chmod 775 /var/www/storage/logs && \
    chmod 775 /var/www/bootstrap/cache

# In the container, open port 9000
EXPOSE 9000

# Starting the php server
CMD ["php-fpm"]
