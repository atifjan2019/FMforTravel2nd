
# ----------------------------
# Stage 1: Composer dependencies
# ----------------------------
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader
COPY . .

# ----------------------------
# Stage 2: Build front-end assets (optional if public/build committed)
# ----------------------------
FROM node:20 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ----------------------------
# Stage 3: Runtime (PHP 8.2 + Nginx + Supervisor)
# ----------------------------
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx supervisor curl git zip unzip libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) pdo_mysql bcmath gd zip

WORKDIR /var/www

# Copy built app
COPY --from=vendor /app /var/www
COPY --from=frontend /app/public/build /var/www/public/build

# Add configs
COPY .docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY .docker/php.ini /usr/local/etc/php/conf.d/zz-app.ini
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
 && chmod -R ug+rw /var/www/storage /var/www/bootstrap/cache

EXPOSE 80
CMD ["/usr/bin/supervisord","-n","-c","/etc/supervisor/conf.d/supervisord.conf"]
