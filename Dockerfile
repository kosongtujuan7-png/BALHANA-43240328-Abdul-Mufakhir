FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    nodejs \
    npm \
    libsqlite3-dev \
    libzip-dev \
    && docker-php-ext-install pdo_sqlite zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN npm install && npm run build

RUN mkdir -p /tmp/laravel \
    /tmp/laravel/cache \
    /tmp/laravel/sessions \
    /tmp/laravel/views \
    /tmp/apache2

RUN sed -i 's/Listen 80/Listen 3000/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:3000>/' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's#ErrorLog \${APACHE_LOG_DIR}/error.log#ErrorLog /dev/stderr#' /etc/apache2/apache2.conf \
    && sed -i 's#ErrorLog \${APACHE_LOG_DIR}/error.log#ErrorLog /dev/stderr#' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's#CustomLog \${APACHE_LOG_DIR}/access.log combined#CustomLog /dev/stdout combined#' /etc/apache2/sites-available/000-default.conf \
    && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' >> /etc/apache2/sites-available/000-default.conf

ENV APACHE_LOG_DIR=/tmp/apache2
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_KEY=base64:q+vzYue4jmDMm3HAqAE3BulJtUtgDtMqlaWScI1SXNE=
ENV DB_CONNECTION=sqlite
ENV SESSION_DRIVER=array
ENV CACHE_STORE=array
ENV LOG_CHANNEL=stderr
ENV VIEW_COMPILED_PATH=/tmp/laravel/views
ENV PORT=3000

EXPOSE 3000

CMD ["apache2-foreground"]
