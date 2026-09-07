# ============================================================
# Stage 1: Install PHP dependencies
# ============================================================
FROM composer:2 AS composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts


# ============================================================
# Stage 2: Build frontend assets
# ============================================================
FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.* ./
COPY postcss.config.* ./
COPY tailwind.config.* ./ 2>/dev/null || true

RUN npm run build


# ============================================================
# Stage 3: Laravel application
# ============================================================
FROM php:8.3-cli-bookworm

WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        xml \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copy Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Copy Laravel application
COPY . .

# Copy Composer dependencies from Stage 1
COPY --from=composer /app/vendor ./vendor

# Copy compiled Vite assets from Stage 2
COPY --from=frontend /app/public/build ./public/build

# Laravel storage permissions
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Laravel optimizations
RUN php artisan config:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

# Render provides the PORT environment variable.
# Laravel will listen on 0.0.0.0 so Render can access it.
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
