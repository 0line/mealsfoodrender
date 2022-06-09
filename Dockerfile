FROM php:8.1-fpm

# Set working directory
WORKDIR /www/apialegra

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    locales \
    zip \
    nodejs \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    wget 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#Install PHP
RUN docker-php-source extract \
    # do important things \
    && docker-php-source delete

#COPY FROM github php extension
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions

#Install php extension
RUN install-php-extensions gd xdebug http bz2 mcrypt mysqli pdo_mysql zip xml pgsql pdo_pgsql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY ./app /www/apialegra
COPY ./php/local.ini /usr/local/etc/php/conf.d/local.ini

# Copy existing application directory permissions
COPY --chown=www-data:www-data ./app /www/apialegra

RUN composer install
# Change current user to www
USER www-data
USER root
RUN chown root:bind /www/apialegra ; chmod g+rwx /www/apialegra
# Expose port 80 and start php-fpm server
EXPOSE 80
#CMD ["php-fpm"]
CMD php -S 0.0.0.0:80 -t public
